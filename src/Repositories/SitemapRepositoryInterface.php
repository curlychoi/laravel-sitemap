<?php


namespace Curlychoi\LaravelSitemap\Repositories;


interface SitemapRepositoryInterface
{
    public function put(string $loc, string $changefreq = 'daily', float $priority = 0.8);

    public function get(string $loc);

    public function all();

    public function first();

    public function last();

    public function forget(string $loc);

    public function paginate(?int $perPage);
}
