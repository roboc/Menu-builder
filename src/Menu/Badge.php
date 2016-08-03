<?php

namespace Roboc\Menu;

/**
 * Class Badge
 * @package Roboc\Menu
 */
class Badge
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var array
     */
    protected $attributes = [ ];

    /**
     * Badge constructor.
     * @param $value
     * @param array $attributes
     */
    public function __construct( $value, array $attributes = [ ] )
    {
        $this->value = $value;
        $this->attributes = $attributes;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }

    /**
     * @return string
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return $this->attributes;
    }
}
