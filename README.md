# Laravel Sitemap

This package helps you create a sitemap in your project.
The Laravel facade allows you to add or remove urls
from your sitemap at the location of your choice.

## Installation

First, install the package via composer:

``` bash
composer require curlychoi/laravel-sitemap
```

The package will automatically register a service provider and alias.

And to create a database to store sitemap urls,
publish the migration files and run the migrate.

``` bash
php artisan vendor:publish --provider="Curlychoi\LaravelSitemap\Providers\SitemapServiceProvider" --tag=migrations
php artisan migrate
```

## Usage

### Creating a sitemap url

``` php
$url = request()->getSchemeAndHttpHost() . '/posts/1';
Sitemap::put($url);
```

### Removing a sitemap url

``` php
$url = request()->getSchemeAndHttpHost() . '/posts/1';
Sitemap::forget($url);
```

### Sitemap url to provide in search engine webmaster tools

``` bash
https://your-domain.com/sitemap.xml
```

This sitemap.xml is compliant with the [sitemaps protocol](https://www.sitemaps.org/protocol.html).

## Testing

With the server running you can execute the tests:

``` bash
$ composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
