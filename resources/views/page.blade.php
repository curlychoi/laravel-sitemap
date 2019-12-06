@php (print '<?xml version="1.0" encoding="UTF-8" ?>' . PHP_EOL)
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
@if (!empty($sitemaps))
    @foreach ($sitemaps as $sitemap)
        <url>
            <loc>{{ $sitemap->loc }}</loc>
            <lastmod>{{ $sitemap->lastmod }}</lastmod>
            <changefreq>{{ $sitemap->changefreq }}</changefreq>
            <priority>{{ $sitemap->priority }}</priority>
        </url>
    @endforeach
@endif
</urlset>