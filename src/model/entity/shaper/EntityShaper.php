<?php
/**
 * Created by PhpStorm.
 * User: INFORMATIQUE
 * Date: 07/12/2016
 * Time: 11:12
 */

namespace base\model\entity\shaper;

use base\model\entity\Entity;


interface EntityShaper
{
    /**
     *
     * Ensure the entity gets everything it needs
     * ( id, attributes, validation rules, etc )
     *
     * @param Entity $entity
     * @return Entity
     */
    public function shape(Entity $entity);
}