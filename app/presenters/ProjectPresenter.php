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

    public function actionDetail($id) {
        $this->template->project = $this->orm->project->getById($id);
    }

}
