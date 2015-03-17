<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Orm;

use Nextras\Orm\Mapper\Mapper;

/**
 * Description of BaseMapper
 *
 * @author Dominik
 */
class BaseMapper extends Mapper {

    protected function createStorageReflection() {
        $reflection = parent::createStorageReflection();
        $reflection->manyHasManyStorageNamePattern = '%s_x_%s';
        return $reflection;
    }

}
