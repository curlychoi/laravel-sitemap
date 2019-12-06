<?php

use Curlychoi\LaravelSitemap\Http\Controllers\SitemapController;

Route::get('/sitemap.xml', [SitemapController::class, 'index']);

