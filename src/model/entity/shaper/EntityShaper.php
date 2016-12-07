<?php
/**
 * Created by PhpStorm.
 * User: INFORMATIQUE
 * Date: 07/12/2016
 * Time: 11:12
 */

namespace base\model\entity\shaper;

use base\model\entity\Entity;


class EntityShaper implements EntityShaperInterface
{

    public function shape(Entity $entity)
    {
        return $entity;
    }
}