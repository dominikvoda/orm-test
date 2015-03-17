<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Presenters;

use Nextras\Datagrid\Datagrid;
use Orm\Orm;
use Nette;

/**
 * Description of UsersPresenter
 *
 * @author Dominik
 */
class UsersPresenter extends BasePresenter {

    /** @var Orm @inject */
    public $orm;

    public function createComponentUsersGrid($name) {
        $grid = new Datagrid;
        $grid->addColumn('id', '#ID')->enableSort();
        $grid->addColumn('name', 'Jméno')->enableSort();
        $grid->addColumn('username', 'Uživatelské jméno')->enableSort();
        $grid->addColumn('email', 'E-mail')->enableSort();

        $grid->setDatasourceCallback(function($filter, $order) {
            return $this->orm->user->findAll();
        });

        $grid->addCellsTemplate(__DIR__ . '/templates/Grid.latte');
        $grid->addCellsTemplate(getNextrasDemosSource('datagrid/bootstrap-style/@bootstrap3.datagrid.latte'));
        return $grid;
    }

    public function actionDetail($id) {
        $this->userId = $id;
        $this->template->info = $this->users->getUser($id);
        $this->template->totalTasks = $this->tasks->countTasksByUser($id);
        $this->template->totalFinishedTasks = $this->tasks->countFinishedTasksByUser($id);
    }

    public function actionEdit($id) {
        
    }

}
