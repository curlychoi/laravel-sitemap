<?php


namespace Curlychoi\LaravelSitemap\Tests\Feature;


use Carbon\Carbon;
use Curlychoi\LaravelSitemap\Facades\Sitemap;
use Curlychoi\LaravelSitemap\Tests\TestCase;
use Curlychoi\LaravelSitemap\Models\Sitemap as SitemapModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class SitemapTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function put_full_url_to_sitemap()
    {
        Sitemap::put($this->loc());

        $this->assertCount(1, Sitemap::all());
        $this->assertEquals($this->loc(), Sitemap::first()->loc);
    }

    /** @test */
    public function put_twice_same_url_to_sitemap()
    {
        Sitemap::put($this->loc());
        $this->assertCount(1, Sitemap::all());

        Sitemap::put($this->loc());
        $this->assertCount(1, Sitemap::all());
        $this->assertEquals(now(), Sitemap::first()->updated_at->toDateTimeString());
    }

    /** @test */
    public function forget_url_from_sitemap()
    {
        Sitemap::put($this->loc());
        $this->assertCount(1, Sitemap::all());

        Sitemap::forget($this->loc());
        $this->assertCount(0, Sitemap::all());
    }

    /** @test */
    public function pagination_sitemap_xml_index()
    {
        factory(SitemapModel::class, 100)->create();
        $response = $this->get('/sitemap.xml?perPage=10');

        $contentType = Str::lower($response->headers->get('content-type'));

        $response->assertStatus(200);
        $this->assertStringContainsString('text/xml', $contentType);
        $response->assertSee('sitemap.xml?page=10');
    }

    /** @test */
    public function sitemap_xml_index_without_per_page()
    {
        $this->withoutExceptionHandling();

        factory(SitemapModel::class, 100)->create();
        $response = $this->get('/sitemap.xml');

        $contentType = Str::lower($response->headers->get('content-type'));

        $response->assertStatus(200);
        $this->assertStringContainsString('text/xml', $contentType);
        $response->assertSee('sitemap.xml?page=1');
    }

    /** @test */
    public function last_sitemap_is_latest_record()
    {
        factory(SitemapModel::class, 10)->create();

        Sitemap::put($this->loc());

        $this->assertEquals($this->loc(), Sitemap::last()->loc);
    }

    /** @test */
    public function oldest_sitemap_xml_pages()
    {
        factory(SitemapModel::class, 100)->create();

        Sitemap::put($this->loc());
        $this->assertCount(101, sitemap::all());

        $sitemap = Sitemap::get($this->loc());
        $sitemap->update(['updated_at' => now()->addSecond()]);

        $response = $this->get('/sitemap.xml?perPage=10&page=11');

        $contentType = Str::lower($response->headers->get('content-type'));
        $response->assertStatus(200);
        $this->assertStringContainsString('text/xml', $contentType);

        $response->assertSee($this->loc());
    }

    /** @test */
    public function lastmod_is_iso_8601()
    {
        $sitemap = Sitemap::put($this->loc());
        $this->assertEquals(Carbon::parse($sitemap->updated_at)->toIso8601String(), $sitemap->lastmod);
    }

    private function loc()
    {
        return 'https://www.google.com/';
    }
}


