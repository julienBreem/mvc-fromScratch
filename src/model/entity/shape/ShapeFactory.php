<?php
/**
 * Created by PhpStorm.
 * User: INFORMATIQUE
 * Date: 08/12/2016
 * Time: 12:31
 */

namespace base\model\entity\shape;

use base\model\dataMapper\DataMapper;

class ShapeFactory
{
    /**
     * @return Shape
     */
    public function getShape($shapingTool,$repositoryName)
    {
        $shape = new Shape();
        if ($shapingTool instanceof DataMapper) {
            $shape->attributes = $shapingTool->fetchColumns($repositoryName);
        }
        return $shape;
    }

}