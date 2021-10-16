<?php

namespace SpaceCode\GoDesk\Fields;

class Files extends Images
{
    /**
     * @var array
     */
    protected $defaultValidatorRules = [];

    /**
     * @var array
     */
    public $meta = ['type' => 'file'];

    /**
     * @param $name
     * @param null $attribute
     * @param null $resolveCallback
     */
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
        $this->hideFromIndex();
    }
}