<?php

namespace Roboc\Menu\Renderer;

use Roboc\Menu\Badge;
use Roboc\Menu\Item;
use Roboc\Menu\Menu;
use Roboc\Support\Interfaces\MenuItemInterface;

/**
 * Class JsonRenderer
 * @package Roboc\Menu\Renderer
 */
class JsonRenderer
{
    /**
     * @param Menu $menu
     * @return string
     */
    public function render( Menu $menu )
    {
        return json_encode( $this->renderMenu( $menu ) );
    }

    /**
     * @param Menu $menu
     * @return array
     */
    protected function renderMenu( Menu $menu )
    {
        $items = [ ];

        foreach( $menu->items() as $item )
        {
            $items[] = $this->renderItem( $item );
        }

        return $items;
    }

    /**
     * @param MenuItemInterface $item
     * @return array
     */
    protected function renderItem( MenuItemInterface $item )
    {
        /**
         * @var $item Item
         */
        $menuItem = [
            'title' => $item->getTitle(),
            'link' => $item->getLink(),
            'active' => $item->isActive(),
        ];

        if( $item->hasSubMenu() )
        {
            $menuItem['children'] = $this->renderMenu( $item->getSubMenu() );
        }

        if( $item->hasBadge() )
        {
            $menuItem['badge'] = $this->renderBadge( $item->getBadge() );
        }

        return array_filter( $menuItem );
    }

    /**
     * @param Badge $badge
     * @return array
     */
    protected function renderBadge( Badge $badge )
    {
        return [
            'value' => $badge->value(),
            'attributes' => $badge->attributes(),
        ];
    }
}
