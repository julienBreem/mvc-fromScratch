<?php
/**
 * Created by PhpStorm.
 * User: INFORMATIQUE
 * Date: 07/12/2016
 * Time: 11:12
 */

namespace base\model\entity;


interface EntityShaper
{
    public function shape(Entity $entity);
}