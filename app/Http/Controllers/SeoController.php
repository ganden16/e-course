<?php

namespace App\Http\Controllers;

use App\Services\SeoService;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    protected SeoService $seoService;

    public function __construct(SeoService $seoService)
    {
        $this->seoService = $seoService;
    }

    /**
     * Generate and return sitemap.xml
     */
    public function sitemap()
    {
        $xml = $this->seoService->generateSitemapXml();

        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Return robots.txt
     */
    public function robots()
    {
        $locale = app()->getLocale();
        $baseUrl = url($locale);
        $enUrl = url('/en');
        $idUrl = url('/id');

        $content = <<<ROBOTS
# Robots.txt for Healthcare Remote Circle
# Generated on {$locale} locale

User-agent: *
Allow: /

# Sitemaps
Sitemap: {$baseUrl}/sitemap.xml
Sitemap: {$enUrl}/sitemap.xml
Sitemap: {$idUrl}/sitemap.xml

# Disallow admin and auth routes
Disallow: /admin/
Disallow: /mentor/
Disallow: /login
Disallow: /logout
Disallow: /lang/

# Allow all public content
Allow: /id/
Allow: /en/
Allow: /id/blog/
Allow: /en/blog/
Allow: /id/product/
Allow: /en/product/
Allow: /id/bootcamp/
Allow: /en/bootcamp/
Allow: /id/community
Allow: /en/community
Allow: /id/about-us
Allow: /en/about-us
Allow: /id/contact
Allow: /en/contact

# Crawl-delay for better server performance
Crawl-delay: 1
ROBOTS;

        return response($content, 200)
            ->header('Content-Type', 'text/plain');
    }

    /**
     * Return health check endpoint for monitoring
     */
    public function health()
    {
        return response()->json([
            'status' => 'ok',
            'timestamp' => now()->toIso8601String(),
            'app' => config('app.name'),
            'environment' => config('app.env'),
        ]);
    }
}
