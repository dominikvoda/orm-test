<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Orm;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasMany;

/**
 * Contact
 * @property string $post
 * @property string $name
 * @property string $email
 * @property string $email2
 * @property string $telephone
 * @property ManyHasMany|Project[] $projects {m:n ProjectsRepository}
 */

/**
 * Description of Contact
 *
 * @author Dominik
 */
class Contact extends Entity{
    //put your code here
}
