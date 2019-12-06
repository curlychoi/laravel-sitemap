<?php


namespace Curlychoi\LaravelSitemap\Tests\Unit;


use Curlychoi\LaravelSitemap\Models\Sitemap as SitemapModel;
use Curlychoi\LaravelSitemap\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SitemapModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function sitemap_can_be_created_with_the_factory()
    {
        factory(SitemapModel::class, 10)->create();
        $this->assertCount(10, SitemapModel::all());
    }
}