<?php


use Roboc\Menu\Menu;

class JsonMenuRendererTestCase extends PHPUnit_Framework_TestCase
{
    public function testJsonMenuRenderer()
    {
        $expectedJson = '[{"title":"Home","link":"\/"},{"title":"Inbox","link":"\/inbox","badge":{"value":5,"attributes":{"color":"red"}}},{"title":"Reports","children":[{"title":"Summary","link":"\/reports\/summary"},{"title":"Detailed","link":"\/reports\/detailed"}]},{"title":"Settings","link":"\/settings"}]';

        $menu = new Menu( 'main-menu' );
        $menu->item( 'Home' )->to( '/' );
        $menu->item( 'Inbox' )->to( '/inbox' )->badge( 5, [ 'color' => 'red' ] );
        $menu->item( 'Reports' )
            ->subMenu( function ( Menu $menu )
            {
                $menu->item( 'Summary' )->to( '/reports/summary' );
                $menu->item( 'Detailed' )->to( '/reports/detailed' );
            } );
        $menu->item( 'Settings' )->to( '/settings' );

        static::assertEquals( $expectedJson, ( new \Roboc\Menu\Renderer\JsonRenderer )->render( $menu ) );
    }
}
