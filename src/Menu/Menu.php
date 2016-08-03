<?php

namespace Roboc\Menu;

use Roboc\Support\Interfaces\MenuItemInterface;

/**
 * Class Menu
 * @package Roboc\Menu
 */
class Menu
{
    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var array
     */
    protected $items = [];

    /**
     * @var \Roboc\Support\Interfaces\MenuItemInterface
     */
    protected $parent;

    /**
     * Menu constructor.
     * @param string $identifier
     */
    public function __construct( $identifier )
    {
        $this->identifier = $identifier;
    }

    /**
     * @param MenuItemInterface $item
     * @return \Roboc\Support\Interfaces\MenuItemInterface
     */
    public function add( MenuItemInterface $item )
    {
        $this->items[] = $item;

        return $item;
    }

    /**
     * @param string $title
     * @return Item
     */
    public function item( $title )
    {
        return $this->add( new Item( $this ) )->title( $title );
    }

    /**
     * @return MenuItemInterface[]
     */
    public function items()
    {
        return $this->items;
    }

    /**
     * @return MenuItemInterface
     */
    public function parent()
    {
        return $this->parent;
    }

    /**
     * @return bool
     */
    public function hasParent()
    {
        return $this->parent !== null;
    }

    /**
     * @param $link
     * @return MenuItemInterface
     */
    public function getItemByLink( $link )
    {
        foreach( $this->items() as $item )
        {
            if( $item->getLink() === $link )
            {
                return $item;
            }

            if( $item->hasSubMenu() )
            {
                 $item = $item->getSubMenu()->getItemByLink( $link );

                if( $item )
                {
                    return $item;
                }
            }
        }

        return null;
    }

    /**
     * @param $link
     */
    public function setActive( $link )
    {
        $item = $this->getItemByLink( $link );

        if( $item )
        {
            $item->active( true );
        }
    }

    /**
     * @param MenuItemInterface $item
     */
    public function setParent( MenuItemInterface $item )
    {
        $this->parent = $item;
    }

    /**
     * @return bool
     */
    public function hasItems()
    {
        return (bool) count( $this->items );
    }
}
