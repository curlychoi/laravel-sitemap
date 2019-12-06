<?php


namespace Curlychoi\LaravelSitemap\Http\Controllers;


use Curlychoi\LaravelSitemap\Facades\Sitemap;
use Illuminate\Support\Facades\Response;

class SitemapController
{
    public function __construct()
    {
        set_time_limit(0);
        ini_set("memory_limit",-1);
    }

    public function index()
    {
        $view = view($this->getViewName(), [
            'sitemaps' => Sitemap::paginate(request()->get('perPage')),
        ]);

        return $this->responseXml($view);
    }

    private function getViewName()
    {
        return request()->get('page') ? 'sitemap::page' : 'sitemap::index';
    }

    private function responseXml($view)
    {
        return Response::make($view, 200)
            ->header('content-type', 'text/xml');
    }
}

