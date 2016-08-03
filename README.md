
# Menu builder
Easy way to build navigation menus

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/roboc/Menu-builder/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/roboc/Menu-builder/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/roboc/Menu-builder/badges/build.png?b=master)](https://scrutinizer-ci.com/g/roboc/Menu-builder/build-status/master)

## Example usage

### Create Menu
```php
$menu = new Menu('main-menu');
```

### Add menu items
```php
$menu->item('Home')->to('/');
```

### Use badges
```php
$menu->item('Inbox')->to('inbox')->badge(5);
```

### Create submenu
```php
$menu->item('Reports')
    ->subMenu( function ( Menu $menu )
    {
        $menu->item('Summary')->to('/reports/summary');
        $menu->item('Detailed')->to('/reports/detailed');
    } );
```


## Render menu
### Using JSON renderer
```php
$json = ( new \Roboc\Menu\Renderer\JsonRenderer )->render( $menu );
```

Output:
```
[
    {
        "title": "Home",
        "link": "\/"
    },
    {
        "title": "Inbox",
        "link": "inbox",
        "badge": {
            "value": 5,
            "attributes": []
        }
    },
    {
        "title": "Reports",
        "children": [
            {
                "title": "Summary",
                "link": "\/reports\/summary"
            },
            {
                "title": "Detailed",
                "link": "\/reports\/detailed"
            }
        ]
    }
]
```

### Using simple HTML renderer
```php
$html = ( new \Roboc\Menu\Renderer\HtmlRenderer )->render( $menu );
```

Output:
```html
<ul id="main-menu">
    <li><a href="/">Home</a></li>
    <li><a href="/inbox">Inbox <span class="badge">5</span></a></li>
    <li>Reports
        <ul>
            <li><a href="/reports/summary">Summary</a></li>
            <li><a href="/reports/detailed">Detailed</a></li>
        </ul>
    </li>
</ul>
```

### Other
You can create your own menu renderer or build menu output direclty in your code


