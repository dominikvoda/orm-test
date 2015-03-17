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
 * @property string $url
 * @property ManyHasMany|Contact[] $contacts {m:n ContactsRepository primary}
 */
class Project extends Entity {
    //put your code here
}
