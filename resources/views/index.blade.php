@php (print '<?xml version="1.0" encoding="UTF-8" ?>' . PHP_EOL)
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
@if (!empty($sitemaps))
    @for ($page = 1; $page <= $sitemaps->lastPage(); ++$page)
        <sitemap>
            <loc>{{ sprintf('%s?%s=%d', $sitemaps->path(), $sitemaps->getPageName(), $page) }}</loc>
        </sitemap>
    @endfor
@endif
</sitemapindex>

