# LESS For Laravel 5.x Without Node.js

LESS with your Laravel. Using [Leafo.php](http://leafo.net)

# Features
- Can modify LESS variables on-the-fly
- Can parse custom CSS/LESS and append it to the resulting file
- Works with Twitter Bootstrap v3.3.5 (thanks to oyejorge/less.php)
- Caching support
# Installation 
 You need [composer](https://getcomposer.org/) to install.

```sh
$ composer require laravelless/lessphp
```

Add Provider,Facade to **config/app.php**

```php
    'providers' => [
        ...,
        Laravelless\Lessphp\LessphpServiceProvider::class,
    ];
    /**********/
    'aliases' => [
        ...,
        'Lessphp'   => Laravelless\Lessphp\LessphpFacade::class,
    ];
```


After that you need publish vendor.

```sh
$ php artisan vendor:publish
```

Now you must have **config/Lessphp.php** so you can edit that where is your LESS path and your file must be excute to  CSS

```php
    return array(
        'css_path'          => base_path('css'),
        'less_path'         => base_path('less'),
        'cache_extension'   => '.cache',
        'formatter'         => "compressed",
    );
```

# Functions
For execute to css is simple :
```php
    $filename = 'style.less';
    $less = \Lessphp::compile($filename);
```
**NOTE :** Lessphp return url("css/$filename.css") Will be fixed soon to dynamical path.

------------------

For execute cached less => css
```php
    $filename = 'style.less';
    $less = \Lessphp::cacheCompile($filename);
```

**NOTE :**  You can set output filename for cacheCompile as second parameter.
```php
    $less = \Lessphp::cacheCompile($filename,'style-min');
```
------------------

You can set variables before compile like this :

```php
    $data = [
                'myBorderRadius'=>'5px',
            ];
    $less = \Lessphp::setVariables($data)->compile($filename);
```

# License 
HRAFIEE

**_IT's Free , SO Enjoy your free World_**
