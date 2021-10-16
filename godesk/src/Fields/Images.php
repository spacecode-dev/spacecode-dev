<?php

namespace SpaceCode\GoDesk\Fields;

class Images extends Media
{
    /**
     * @var array
     */
    protected $defaultValidatorRules = ['image'];

    /**
     * @param $name
     * @param null $attribute
     * @param callable|null $resolveCallback
     */
    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
        $this->croppable();
    }

    /**
     * @param $singleImageRules
     * @return $this
     */
    public function singleImageRules($singleImageRules): self
    {
        $this->singleMediaRules = $singleImageRules;
        return $this;
    }

    /**
     * @param bool $croppable
     * @return $this
     */
    public function croppable(bool $croppable = true): self
    {
        return $this->withMeta(compact('croppable'));
    }

    /**
     * @param array $configs
     * @return $this
     */
    public function croppingConfigs(array $configs): self
    {
        return $this->withMeta(['croppingConfigs' => $configs]);
    }

    /**
     * @param bool $showStatistics
     * @return $this
     */
    public function showStatistics(bool $showStatistics = true): self
    {
        return $this->withMeta(compact('showStatistics'));
    }

    /**
     * @param bool $showDimensions
     * @return $this
     */
    public function showDimensions(bool $showDimensions = true): self
    {
        return $this->showStatistics();
    }
}