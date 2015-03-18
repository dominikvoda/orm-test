<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Orm;

use Nextras\Orm\Repository\Repository;
use Nextras\Orm\Collection\ICollection;

/**
 * Description of Project
 *
 * @author Dominik
 */
class ProjectsRepository extends Repository {

    public function findDefaultView($filter, $order) {
        $data = $this->findAll();
        if (is_array($order)) {
            $direction = ($order[1] == 'ASC') ? ICollection::ASC : ICollection::DESC;
            return $data->orderBy($order[0], $direction);
        }
        return $data;
    }
    
    public function getMain(){
        return $this->findBy(array('parent' => 0));
    }

}
