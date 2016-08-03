<?php

class MenuTestCase extends PHPUnit_Framework_TestCase
{
    public function testEmptyMenu()
    {
        $menu = new \Roboc\Menu\Menu('test');

        static::assertFalse( $menu->hasItems() );
        static::assertSame( [], $menu->items() );
        static::assertFalse( $menu->hasParent() );
    }

    public function testAddInterfaceItemToMenu()
    {
        $menu = new \Roboc\Menu\Menu('test');
        $item = $menu->add( new FakeMenuItem( $menu ) );

        static::assertInstanceOf( FakeMenuItem::class, $item );
    }

    public function testAddItemToMenu()
    {
        $menu = new \Roboc\Menu\Menu('test');
        $item = $menu->item('Home')->to('home');

        static::assertInstanceOf( Roboc\Support\Interfaces\MenuItemInterface::class, $item );
        static::assertSame( $item, $menu->items()[0] );
    }

    public function testMenuWithSingleLevelItems()
    {
        $menu = new \Roboc\Menu\Menu('test');
        $items[0] = $menu->item('Home')->to('home');
        $items[1] = $menu->item('Inbox')->to('inbox');
        $items[2] = $menu->item('Settings')->to('settings');

        static::assertTrue( $menu->hasItems() );
        static::assertCount( 3, $menu->items() );
        static::assertSame( $items, $menu->items() );
    }

    public function testActiveMenuItems()
    {
        $menu = new \Roboc\Menu\Menu( 'main-menu' );
        $menu->item( 'Home' )->to( '/home' );
        $inbox = $menu->item( 'Inbox' )->to( '/inbox' )->badge( 5, [ 'color' => 'red' ] );
        $reports = $menu->item( 'Reports' )
            ->subMenu( function ( \Roboc\Menu\Menu $menu )
            {
                $menu->item( 'Summary' )->to( '/reports/summary' );
                $menu->item( 'Detailed' )->to( '/reports/detailed' );
            } );
        $menu->item( 'Settings' )->to( '/settings' );

        $menu->setActive('/reports/summary');

        static::assertSame( $inbox, $menu->getItemByLink( '/inbox' ) );
        static::assertNull( $menu->getItemByLink( '/profile' ) );
        static::assertTrue( $menu->getItemByLink( '/reports/summary' )->isActive() );
        static::assertTrue( $reports->isActive() );




    }
}

class FakeMenuItem extends \Roboc\Menu\Item
{

}
