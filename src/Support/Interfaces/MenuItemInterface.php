<?php

namespace Roboc\Support\Interfaces;

use Closure;
use Roboc\Menu\Menu;

/**
 * Interface MenuItemInterface
 * @package Roboc\Support\Interfaces
 */
interface MenuItemInterface
{
    /**
     * MenuItemInterface constructor.
     * @param Menu $menu
     */
    public function __construct( Menu $menu );

    /**
     * @param string $link
     * @return $this
     */
    public function to( $link );

    /**
     * @param string $title
     * @return $this
     */
    public function title( $title );

    /**
     * @param Closure $callback
     * @return $this
     */
    public function subMenu( Closure $callback );

    /**
     * @param bool $isActive
     * @return $this
     */
    public function active( $isActive );

    /**
     * @return string
     */
    public function getLink();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return Menu
     */
    public function getSubMenu();

    /**
     * @return bool
     */
    public function hasSubMenu();

    /**
     * @return bool
     */
    public function isActive();

}
