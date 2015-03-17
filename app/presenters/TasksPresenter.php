<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Presenters;

use Nette;
use App\Model;
use Mesour\DataGrid\ArrayDataSource;
use Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Grid;

/**
 * Description of TasksPresenter
 *
 * @author Dominik
 */
class TasksPresenter extends BasePresenter {

    /** @var \App\Model\TasksModel  */
    public $tasks;
    private $userManager;

    /** @persistent */
    public $project;

    /*public function __construct(Model\UserManager $userManager) {
        $this->userManager = $userManager;
    }*/

    public function loadDefault($task = NULL) {
        return ($task) ? $this->tasks->getTask($task) : array('project' => $this->project);
    }

    public function createComponentMyTasksGrid($name) {
        $source = new ArrayDataSource($this->tasks->getTasksByUser($this->user->getId()));
        $source->setPrimaryKey('task_id');
        $grid = new Grid($this, $name);
        $grid->setDataSource($source);
        $grid->addText('task_id', '#ID');
        $grid->addText('task_name', 'Název');
        $grid->addtext('task_progress', 'Splněno')
                ->setCallback(function ($row) {
                    return $row['task_progress'] . '%';
                });
        $grid->addText('project_name', 'Projekt');
        $grid->addDate('end_date', 'Ukončení')
                ->setFormat('j. m. Y');
        $actions = $grid->addActions('Akce');
        $actions->addButton()
                ->setIcon('fa fa-pencil')
                ->setType('btn btn-primary')
                ->setTitle('Upravit')
                ->setAttribute('href', new Link('Tasks:edit', array(
                    'id' => '{' . 'task_id' . '}')
        ));
        $grid->setDefaultOrder('end_date');
        $grid->enablePager(20);
        return $grid;
    }

    public function createComponentLastFinishedTasksGrid($name) {
        $source = new ArrayDataSource($this->tasks->getLastFinishedTasks());
        $source->SetPrimaryKey('task_id');
        $grid = new Grid($this, $name);
        $grid->setDataSource($source);
        $grid->addText('task_id', '#ID');
        $grid->addText('task_name', 'Název');
        $grid->addText('project_name', 'Projekt');
        $grid->addDate('finish_date', 'Ukončeno')
                ->setFormat('j. m. Y');
        $actions = $grid->addActions('Akce');
        $actions->addButton()
                ->setIcon('fa fa-pencil')
                ->setType('btn btn-primary')
                ->setTitle('Upravit')
                ->setAttribute('href', new Link('Tasks:edit', array(
                    'id' => '{' . 'task_id' . '}')
        ));
        return $grid;
    }

    public function createComponentAddTask() {
        $form = new Nette\Application\UI\Form();
        $form->addText('name', 'Název')
                ->setRequired();
        $form->addSelect('project', 'Projekt', $this->tasks->getProjectsSelect())
                ->setPrompt('Vyberte projekt')
                ->setRequired();
        $form->addSelect('parent', 'Nadřazený úkol', $this->tasks->getPrimaryTasksSelect())
                ->setDisabled();
        $form->addSelect('progress', 'Splněno', $this->tasks->getProgressSelect());
        $form->addMultiSelect('users', 'Uživatelé', $this->tasks->getUsersSelect());
        $form->addSubmit('send', 'Přidat')
                ->setAttribute('class', 'btn btn-primary btn-block sweet-14');
        $form->addText('end_date', 'Datum ukončení')
                ->setAttribute('class', 'datetime-input');
        $form->onSuccess[] = array($this, 'formSucceeded');
        $this->BootstrapBasicForm($form);
        return $form;
    }

    public function createComponentEditTask() {
        $form = new Nette\Application\UI\Form();
        $mainTasks = $this->getMainTasks();
        $progress = $this->getProgressSelect();
        $form->addHidden('id');
        $form->addText('name', 'Název');
        $form->addSelect('progress', 'Splněno', $progress);
        $form->addSelect('parent', 'Nadřazený úkol', $mainTasks);
        $form->addSubmit('send', 'Upravit')
                ->setAttribute('class', 'btn btn-primary btn-block');
        $form->onSuccess[] = array($this, 'formSucceeded');
        $this->BootstrapBasicForm($form);
        return $form;
    }

    public function formSucceeded($form) {
        $values = $form->values;
        if (!isset($values->id)) {
            $this->tasks->addTask($values, $this->user->getIdentity(), $this->getHttpRequest()->getRemoteAddress());
            $this->flashMessage('Úkol byl úspěšně přidán', 'success');
            $this->redirect('this');
        } else {
            $this->tasks->editTask($values);
            $this->flashMessage('Úkol byl úspěšně upraven', 'success');
            $this->redirect('Project:tasks', $this->projectId);
        }
    }

    /** security link */
    public function handleDeleteTask($id) {
        $task = $this->tasks->getTask($id);
        $projectId = $task->project;
        $parent = $task->parent;
        $this->tasks->deleteTask($id);
        $this->flashMessage('Úkol byl úspěšně odstraněn', 'success');
        if ($parent == 0)
            $this->redirect('Project:tasks', $projectId);
        else {
            $this->redirect('Project:editTask', $parent);
        }
    }

    /**
     * Load values to second select
     * @param int
     */
    public function handleFirstChange($value) {
        if ($value != 0) {
            $secondItems = $this->tasks->getPrimaryTasksSelect($value);
            $this['addTask']['parent']
                    ->setItems($secondItems)
                    ->setDisabled(FALSE);
        } else {
            $this['addTask']['parent']->setDisabled(TRUE);
        }
        $this->invalidateControl('selectSnippet');
    }

    public function getUsersByTask($id) {
        return $this->tasks->getTaskUsers($id);
    }

    public function renderDefault($project) {
        $this->project = $project;
    }
    
    public function actionAdd(){
        $this['addTask']->setDefaults($this->loadDefault());
        $this->template->_form = $this['addTask'];
    }

}
