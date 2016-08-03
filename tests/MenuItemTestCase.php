<?php


class MenuItemTestCase extends PHPUnit_Framework_TestCase
{
    public function testMenuItem()
    {
        $menu = new \Roboc\Menu\Menu('test');
        $item = new \Roboc\Menu\Item( $menu );
        $item->title('Home');
        $item->to('home');

        static::assertEquals( 'Home', $item->getTitle() );
        static::assertEquals( 'home', $item->getLink() );
        static::assertFalse( $item->hasBadge() );
        static::assertNull( $item->getBadge() );
        static::assertFalse( $item->hasSubMenu() );
        static::assertNull( $item->getSubMenu() );
        static::assertFalse( $item->isActive() );

        $item->active( true );

        static::assertTrue( $item->isActive() );
    }

    public function testMenuItemWithBadge()
    {
        /**
         * @var $item Roboc\Menu\Item
         */

        $attributes = [ 'color' => 'red' ];

        $menu = new \Roboc\Menu\Menu('test');
        $item = new \Roboc\Menu\Item( $menu );
        $item->title('Inbox');
        $item->to('inbox');
        $item->badge( 5, $attributes );

        $badge = $item->getBadge();

        static::assertTrue( $item->hasBadge() );
        static::assertInstanceOf( Roboc\Menu\Badge::class, $item->getBadge() );
        static::assertEquals( '5', (string) $badge );
        static::assertEquals( 5, $badge->value() );
        static::assertTrue( is_array( $badge->attributes() ) );
        static::assertEquals( $attributes, $badge->attributes() );
    }

    public function testSubMenu()
    {
        $menu = new \Roboc\Menu\Menu('test');
        $item = $menu->item( 'Reports' )
            ->subMenu( function ( \Roboc\Menu\Menu $menu )
            {
                $menu->item( 'Summary' )->to( '/reports/summary' );
                $menu->item( 'Detailed' )->to( '/reports/detailed' );
            } );

        static::assertTrue( $item->hasSubMenu() );
        static::assertTrue( $item->getSubMenu()->hasItems() );
        static::assertCount( 2, $item->getSubMenu()->items() );
        static::assertInstanceOf( Roboc\Support\Interfaces\MenuItemInterface::class, $item->getSubMenu()->items()[0] );
        static::assertTrue( $item->getSubMenu()->hasParent() );
        static::assertSame( $item, $item->getSubMenu()->parent() );
    }
}
