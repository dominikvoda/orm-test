<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Orm;

use Nextras\Orm\Entity\Entity;
use Nextras\Dbal\Utils\DateTime;
use Nextras\Orm\Relationships\ManyHasMany;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * Description of Project
 *
 * @author Dominik
 */

/**
 * Project
 * @property string $name
 * @property DateTime $createdAt
 * @property float $progress
 * @property ManyHasMany|Contact[] $contacts {m:n ContactsRepository primary} 
 * @property OneHasMany|Task[] $allTasks {1:m TasksRepository}
 * @property-read Task[] $tasks {virtual}
 */
class Project extends Entity {
    public function getterTasks(){
        return $this->allTasks->get()->findBy(['deletedAt' => NULL]);
    }
}
