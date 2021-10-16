<?php

namespace SpaceCode\GoDesk\Traits;

trait CoverHelpers
{
    /**
     * @var bool
     */
    public $rounded = false;

    /**
     * @return $this
     */
    public function rounded()
    {
        $this->rounded = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function squared()
    {
        $this->rounded = false;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRounded()
    {
        return $this->rounded == true;
    }

    /**
     * @return bool
     */
    public function isSquared()
    {
        return $this->rounded == false;
    }
}