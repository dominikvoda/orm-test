<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model;

use Nette;
use App\Model;
use Nette\Security\User;

/**
 * Description of TaskModel
 *
 * @author Dominik
 */
class TasksModel extends \Nette\Object {

    const TABLE_NAME = 'tasks';
    const TABLE_PROJECTS = 'projects';
    const TABLE_USERS = 'users';
    const TABLE_USERSTASKS = 'users_tasks';
    
    /** @var App\Model\LogModel @inject */
    public $log;

    private $database;

    public function __construct(\Nette\Database\Context $database) {
        $this->database = $database;
    }

    public function getProjectsSelect() {
        $projects = $this->database->table(self::TABLE_PROJECTS);
        $array = array();
        foreach ($projects as $project) {
            $array[$project->id] = $project->name;
        }
        return $array;
    }

    public function getPrimaryTasksSelect($projectId = NULL) {
        $tasks = (!$projectId) ? $this->getPrimaryTasks() : $this->getPrimaryTasksByProject($projectId);
        $array = array();
        $array[0] = 'Toto je primární úkol';
        foreach ($tasks as $task) {
            $array[$task->id] = $task->name;
        }
        return $array;
    }

    public function getProgressSelect() {
        for ($i = 0; $i <= 100; $i += 20) {
            $array[$i] = $i . "%";
        }
        return $array;
    }
    
    public function getUsersSelect(){
        $users = $this->database->table(self::TABLE_USERS);
        $array = array();
        foreach ($users as $user) {
            $array[$user->id] = $user->name;
        }
        return $array;
    }

    public function getPrimaryTasks() {
        return $this->database->table(self::TABLE_NAME)->where('parent', 0);
    }

    public function getPrimaryTasksByProject($projectId) {
        return $this->getPrimaryTasks()->where('project', $projectId);
    }

    public function getTask($id) {
        return $this->database->table(self::TABLE_NAME)->get($id);
    }

    public function getSubTasks($mainTaskId) {
        return $this->database->table(self::TABLE_NAME)->where('parent', $mainTaskId);
    }

    public function getLastFinishedTasks() {
        $query = 'Select t.project, p.id AS project_id, t.id AS task_id, finish_date, t.progress, t.name AS task_name, p.name AS project_name '
                . 'FROM tasks t, projects p '
                . 'WHERE t.project = p.id AND t.progress = 100';
        return $this->database->query($query)->fetchAssoc('task_id');
    }

    public function getUsersByTask($taskId) {
        $rows = $this->database->table('users_tasks')->where('task_id', $taskId);
        $array = array();
        foreach ($rows as $row) {
            $array[] = $row->ref('users', 'user_id');
        }
        return $array;
    }

    public function getTasksByUser($userId) {
        $query = 'SELECT t.project, t.progress, p.name AS project_name, t.name AS task_name, t.id AS task_id, t.progress AS task_progress, end_date '
                . 'FROM users_tasks, tasks t, projects p '
                . 'WHERE user_id = ' . $userId . ' AND task_id = t.id AND p.id = t.project';
        return $this->database->query($query)->fetchAssoc('task_id');
    }

    public function countTasks($object) {
        return $object->count('progress');
    }

    public function countTasksByUser($userId) {
        return $this->database->table('users_tasks')->where('user_id', $userId)->count();
    }

    public function countFinishedTasksByUser($userId) {
        $query = "SELECT COUNT(*) AS rows "
                . "FROM users_tasks, tasks t "
                . "WHERE user_id = " . $userId . " AND task_id = t.id AND progress = 100";
        return $this->database->query($query)->fetch()->rows;
    }

    public function addTask($values, $creator, $ip) {
        $users = $values->users;
        unset($values->users);
        $record = $this->database->table(self::TABLE_NAME)->insert($values);
        foreach($users as $user){
            $userstasks = $this->database->table(self::TABLE_USERSTASKS)->insert(array('user_id' => $user, 'task_id' => $record->id));
        }
        $this->log->addRecord($creator, "Uživatel $creator->name přidal úkol $record->name", $ip);
        if ($values->parent != 0) {
            $this->recountProgress($values->parent);
        }
        $this->recountProjectProgress($values->project);
    }

    public function editTask($values) {
        $this->database->table(self::TABLE_NAME)->get($values->id)->update($values);
        if ($values->parent != 0) {
            $this->recountProgress($values->parent);
        }
        $this->recountProjectProgress($values->project);
    }

    public function recountProgress($id) {
        $subtaskCounter = 0;
        $subtaskProgress = 0;
        $subtasks = $this->getSubTasks($id);
        foreach ($subtasks as $subtask) {
            $subtaskCounter++;
            $subtaskProgress += $subtask->progress;
        }
        if ($subtaskCounter != 0)
            $newProgress = round(($subtaskProgress / $subtaskCounter), 2);
        else
            $newProgress = 0;
        $this->getTask($id)->update(array('progress' => $newProgress));
    }

    public function recountProjectProgress($id) {
        $project = $this->database->table(self::TABLE_PROJECTS)->get($id);
        $tasks = $this->getTasks($id);
        $tasksCounter = 0;
        $tasksProgress = 0;
        foreach ($tasks as $task) {
            $tasksCounter++;
            $tasksProgress += $task->progress;
        }
        if ($tasksCounter != 0)
            $newProgress = round(($subtaskProgress / $subtaskCounter), 2);
        else
            $newProgress = 0;
        $project->update(array('progress' => $newProgress));
    }

    public function deleteTask($id) {
        $task = $this->getTask($id);
        if ($task->parent != 0) {
            $mainTaskId = $task->parent;
            $this->getTask($id)->delete();
            $this->recountProgress($mainTaskId);
            return;
        }
        if ($task->parent == 0) {
            $subtasks = $this->getSubTasks($task->id)->delete();
            $projectId = $task->project;
            $task->delete();
            $this->recountProjectProgress($projectId);
        }
    }

}
