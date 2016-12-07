<?php
/**
 * Created by PhpStorm.
 * User: INFORMATIQUE
 * Date: 07/12/2016
 * Time: 10:34
 */

namespace base\model\entity;

use base\model\dataMapper\DataMapper;

class EntityShaperFactory
{
    protected $shapingTool;

    public function __construct($shapingTool)
    {
        $this->shapingTool = $shapingTool;
    }

    /**
     * @return DataMappingEntityShaper
     */
    public function getEntityShaper()
    {
        if ($this->shapingTool instanceof DataMapper) {
            return new DataMappingEntityShaper($this->shapingTool);
        }
    }
}