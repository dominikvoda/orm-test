<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Orm;

use Nextras\Orm\Entity\Entity;
use Nette\Utils\DateTime;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * Description of User
 *
 * @author Dominik
 */

/**
 * User
 * @property int $id User identificator
 * @property string $username 
 * @property string $role
 * @property string $name
 * @property string $email
 * @property DateTime $lastLogin
 * @property OneHasMany|Task[] $tasks {1:m TasksRepository}
 */
class User extends Entity{
    //put your code here
}
