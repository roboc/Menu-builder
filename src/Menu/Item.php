<?php

namespace Roboc\Menu;

use Closure;
use Roboc\Support\Interfaces\MenuItemInterface;

/**
 * Class Item
 * @package Roboc\Menu
 */
class Item implements MenuItemInterface
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $link;

    /**
     * @var bool
     */
    protected $active = false;

    /**
     * @var Badge
     */
    protected $badge;

    /**
     * Parent Menu instance
     *
     * @var Menu
     */
    protected $menu;

    /**
     * Sub menu instance
     *
     * @var Menu
     */
    protected $subMenu;

    /**
     * Item constructor.
     * @param Menu $menu
     */
    public function __construct( Menu $menu )
    {
        $this->menu = $menu;
    }

    /**
     * @param string $link
     * @return $this
     */
    public function to( $link )
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function title( $title )
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $value
     * @param array $attributes
     * @return $this
     */
    public function badge( $value, array $attributes = [ ] )
    {
        $this->badge = new Badge( $value, $attributes );

        return $this;
    }

    /**
     * @param Closure $callback
     * @return $this
     */
    public function subMenu( Closure $callback )
    {
        $this->subMenu = new Menu( null );
        $this->subMenu->setParent( $this );

        $callback( $this->subMenu );

        return $this;
    }

    /**
     * @param $isActive
     * @return $this
     */
    public function active( $isActive )
    {
        $this->active = $isActive;

        if( $this->menu->hasParent() )
        {
            $this->menu->parent()->active( true );
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return Badge|null
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * @return Menu
     */
    public function getSubMenu()
    {
        return $this->subMenu;
    }

    /**
     * @return bool
     */
    public function hasSubMenu()
    {
        return $this->subMenu !== null && $this->subMenu->hasItems();
    }

    /**
     * @return bool
     */
    public function hasBadge()
    {
        return $this->badge !== null;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return (bool) $this->active;
    }
}
