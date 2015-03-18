<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Orm;

use Nette\Utils\DateTime;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\OneHasMany;
use Nextras\Orm\Relationships\ManyHasOne;


/**
 * Description of Task
 *
 * @author Dominik
 */

/**
 * Task
 * @property string $name
 * @property float $progress 
 * @property DateTime $addDate
 * @property DateTime|null $finishDate
 * @property DateTime|null $endDate
 * @property DateTime|null $deletedAt
 * @property Project $project {m:1 ProjectsRepository $allTasks} 
 * @property Task|NULL $parent {m:1 TasksRepository $subtasks}
 * @property OneHasMany|Task[] $subtasks {1:m TasksRepository $parent}
 */
class Task extends Entity{
}
