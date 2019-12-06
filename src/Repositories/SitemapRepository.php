<?php


namespace Curlychoi\LaravelSitemap\Repositories;


use Curlychoi\LaravelSitemap\Models\Sitemap;


class SitemapRepository implements SitemapRepositoryInterface
{
    protected $perPage = 10000;

    public function put(string $loc, string $changefreq = 'daily', float $priority = 0.8)
    {
        return tap(Sitemap::updateOrCreate([
            'loc' => $loc
        ], [
            'changefreq' => $changefreq,
            'priority' => $priority,
        ]))->touch();
    }

    public function get(string $loc)
    {
        return Sitemap::where('loc', $loc)->first();
    }

    public function all()
    {
        return Sitemap::all();
    }

    public function first()
    {
        return Sitemap::first();
    }

    public function last()
    {
        return Sitemap::latest('created_at')->latest('id')->first();
    }

    public function forget(string $loc)
    {
        return Sitemap::where('loc', $loc)->delete();
    }

    public function paginate(?int $perPage)
    {
        return Sitemap::paginate($perPage ?? $this->perPage);
    }
}

