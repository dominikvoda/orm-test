<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Presenters;

use Nextras;
use Nextras\Datagrid\Datagrid;
use Nextras\Orm\Entity\IEntity;
use Orm\Orm;

/**
 * Description of ProjectPresenter
 *
 * @author Dominik
 */
class ProjectPresenter extends BasePresenter {

    /** @var Orm @inject */
    public $orm;
    private $projectId;

    public function createComponentProjectsGrid() {
        $grid = new Datagrid;
        $grid->addColumn('id', '#ID')->enableSort();
        $grid->addColumn('projects', 'Název')->enableSort();
        $grid->addColumn('date', 'Datum')->enableSort();

        $grid->setDatasourceCallback(function($filter, $order) {
            return $this->orm->project->findDefaultView($filter, $order);
        });

        $grid->addCellsTemplate(__DIR__ . '/templates/Grid.latte');
        $grid->addCellsTemplate(getNextrasDemosSource('datagrid/bootstrap-style/@bootstrap3.datagrid.latte'));
        return $grid;
    }

    public function renderDefault() {
        //dump($this->orm->project->findDefaultView());
    }
    
    public function countSubTasks($param){
        return false;
    }

    public function actionDetail($id) {
        $this->template->project = $this->orm->project->getById($id);
        //$this->template->ftp = $this->project->getFtp($id);
        //$this->template->database = $this->project->getDatabase($id);
        //$this->template->contacts = $this->orm->;
        //$this->template->webhosting = $this->project->getWebhosting($id);
        //$this->template->tasks = $this->tasks->getTasks($id);
    }

    /* public function actionTasks($id) {
      $this->projectId = $id;
      $this->template->project = $this->project->getProject($id);
      $this->template->tasks = $this->tasks->getTasks($id);
      }

      public function actionEditTask($id) {
      $task = $this->tasks->getTask($id);
      $this->projectId = $task->project;
      $this->template->project = $this->project->getProject($this->projectId);
      $this->template->task = $task;
      $this->template->subtasks = $this->tasks->getSubTasks($id);
      if ($task->parent != 0) {
      $this['editTask']->setDefaults($task);
      }
      }

      public function actionInfo($id) {

      }

      public function actionContacts($id) {

      }

      public function actionFiles($id) {

      }

      public function actionWebhosting($id) {

      }

      public function actionFtp($id) {

      }

      public function actionDatabase($id) {

      }

      public function getSubTasks($parentTask) {
      return $this->tasks->getSubTasks($parentTask);
      }

      public function countSubTasks($tasks) {
      return $this->tasks->countTasks($tasks);
      }

      public function getMainTasks() {
      $tasks = $this->tasks->getTasks($this->projectId);
      $array[0] = 'Toto je primární úkol';
      foreach ($tasks as $task) {
      $array[$task->id] = $task->name;
      }
      return $array;
      } */
}
