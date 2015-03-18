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
 * Description of TasksRepository
 *
 * @author Dominik
 */
class TasksRepository extends Repository{
    public function getMain(){
        return $this->findBy(array('parent' => 0));
    }
}
