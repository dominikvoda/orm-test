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
 * @property Project|ManyHasOne $projects {m:1 ProjectsRepository}
 * @property DateTime $addDate
 * @property DateTime|null $finishDate
 * @property DateTime|null $endDate
 * @property User|OneHasMany $users {1:m UsersRepository}
 */
class Task extends Entity{
    //put your code here
}
