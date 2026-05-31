<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Bootcamp;
use App\Models\Product;

class SeoService
{
    /**
     * Available languages for hreflang
     */
    protected array $locales = ['id', 'en'];

    /**
     * Get the site name for SEO
     */
    public function getSiteName(): string
    {
        $locale = app()->getLocale();
        $translations = include lang_path("{$locale}/landingPage.php");
        return $translations['site']['name'] ?? config('app.name', 'Healthcare Remote Circle');
    }

    /**
     * Get the site tagline
     */
    public function getSiteTagline(): string
    {
        $locale = app()->getLocale();
        $translations = include lang_path("{$locale}/landingPage.php");
        return $translations['site']['tagline'] ?? 'Digital Healthcare Learning Platform';
    }

    /**
     * Generate SEO title in format: "Page Title - Site Name"
     */
    public function generateTitle(?string $pageTitle = null, ?string $siteName = null): string
    {
        $name = $siteName ?? $this->getSiteName();

        if (empty($pageTitle)) {
            return $name;
        }

        return "{$pageTitle} - {$name}";
    }

    /**
     * Generate meta description (max 160 characters)
     */
    public function generateDescription(?string $description = null, int $maxLength = 160): string
    {
        if (empty($description)) {
            $locale = app()->getLocale();
            $translations = include lang_path("{$locale}/landingPage.php");
            $description = $translations['site']['description'] ?? 'Healthcare Remote Circle - Digital Healthcare Learning Platform';
        }

        return strlen($description) > $maxLength
            ? substr($description, 0, $maxLength - 3) . '...'
            : $description;
    }

    /**
     * Generate meta keywords
     */
    public function generateKeywords(?string $keywords = null): string
    {
        if (!empty($keywords)) {
            return $keywords;
        }

        return 'healthcare remote circle, medical virtual assistant, MVA, telehealth, digital healthcare, remote healthcare, healthcare bootcamp, medical admin, healthcare training, online healthcare courses';
    }

    /**
     * Get canonical URL for current page
     */
    public function getCanonicalUrl(): string
    {
        $locale = app()->getLocale();
        $path = request()->path();

        // Remove locale prefix if present
        if (in_array(explode('/', $path)[0] ?? '', $this->locales)) {
            $path = implode('/', array_slice(explode('/', $path), 1));
        }

        return url($locale . ($path && $path !== '/' ? '/' . $path : ''));
    }

    /**
     * Generate hreflang alternate URLs
     */
    public function getHreflangUrls(): array
    {
        $currentPath = request()->path();
        $urls = [];

        foreach ($this->locales as $locale) {
            // Remove current locale prefix
            $pathWithoutLocale = $currentPath;
            foreach ($this->locales as $loc) {
                if (str_starts_with($pathWithoutLocale, $loc . '/')) {
                    $pathWithoutLocale = substr($pathWithoutLocale, strlen($loc) + 1);
                    break;
                } elseif ($pathWithoutLocale === $loc) {
                    $pathWithoutLocale = '';
                    break;
                }
            }

            $urls[$locale] = url($locale . ($pathWithoutLocale ? '/' . $pathWithoutLocale : ''));
        }

        return $urls;
    }

    /**
     * Generate Open Graph meta tags data
     */
    public function getOpenGraphData(
        ?string $title = null,
        ?string $description = null,
        ?string $image = null,
        ?string $type = 'website',
        ?string $url = null
    ): array {
        $locale = app()->getLocale();
        $translations = include lang_path("{$locale}/landingPage.php");
        $logo = $translations['site']['logo'] ?? 'assets/images/logo1.png';

        return [
            'title' => $title ?? $this->getSiteName(),
            'description' => $this->generateDescription($description),
            'image' => $image ?? asset($logo),
            'type' => $type,
            'url' => $url ?? $this->getCanonicalUrl(),
            'site_name' => $this->getSiteName(),
            'locale' => $locale === 'id' ? 'id_ID' : 'en_US',
        ];
    }

    /**
     * Generate Twitter Card meta tags data
     */
    public function getTwitterCardData(
        ?string $title = null,
        ?string $description = null,
        ?string $image = null,
        string $cardType = 'summary_large_image'
    ): array {
        $locale = app()->getLocale();
        $translations = include lang_path("{$locale}/landingPage.php");
        $logo = $translations['site']['logo'] ?? 'assets/images/logo1.png';

        return [
            'card' => $cardType,
            'title' => $title ?? $this->getSiteName(),
            'description' => $this->generateDescription($description),
            'image' => $image ?? asset($logo),
            'site' => '@HealthcareRemoteCircle',
        ];
    }

    /**
     * Generate Organization structured data (JSON-LD)
     */
    public function getOrganizationStructuredData(): array
    {
        $locale = app()->getLocale();
        $landingTranslations = include lang_path("{$locale}/landingPage.php");
        $site = $landingTranslations['site'] ?? [];

        $contactTranslations = include lang_path("{$locale}/contact.php");
        $socialLinks = $contactTranslations['contact']['social_links'] ?? [];
        $sameAs = array_column($socialLinks, 'url');

        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $site['name'] ?? $this->getSiteName(),
            'description' => $site['description'] ?? $this->getSiteTagline(),
            'url' => url($locale),
            'logo' => asset($site['logo'] ?? 'assets/images/logo1.png'),
            'email' => $site['email'] ?? 'contact@hrcteam.com',
            'telephone' => $site['phone'] ?? '+6285704677707',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => $site['address'] ?? 'Surabaya',
                'addressCountry' => 'ID',
            ],
            'sameAs' => !empty($sameAs) ? $sameAs : [
                'https://www.facebook.com/',
                'https://www.instagram.com/',
                'https://www.linkedin.com/',
                'https://www.youtube.com/',
                'https://www.tiktok.com/',
            ],
        ];
    }

    /**
     * Generate Website structured data (JSON-LD)
     */
    public function getWebsiteStructuredData(): array
    {
        $locale = app()->getLocale();

        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $this->getSiteName(),
            'description' => $this->getSiteTagline(),
            'url' => url($locale),
            'inLanguage' => $locale === 'id' ? 'id' : 'en',
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => url($locale . '/blog') . '?q={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    /**
     * Generate Article structured data for blog posts (JSON-LD)
     */
    public function getArticleStructuredData(Blog $blog): array
    {
        $locale = app()->getLocale();
        $translations = include lang_path("{$locale}/landingPage.php");
        $logo = $translations['site']['logo'] ?? 'assets/images/logo1.png';

        return [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $blog->seo_title,
            'description' => $blog->seo_description,
            'image' => $blog->seo_image,
            'datePublished' => $blog->published_date_iso,
            'dateModified' => $blog->modified_date_iso,
            'author' => [
                '@type' => 'Person',
                'name' => $blog->author,
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => $this->getSiteName(),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset($logo),
                ],
            ],
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $blog->canonical_url,
            ],
            'inLanguage' => $locale === 'id' ? 'id' : 'en',
        ];
    }

    /**
     * Generate Course structured data for bootcamps (JSON-LD)
     */
    public function getCourseStructuredData(Bootcamp $bootcamp): array
    {
        $locale = app()->getLocale();

        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'Course',
            'name' => $bootcamp->seo_title,
            'description' => $bootcamp->seo_description,
            'image' => $bootcamp->seo_image,
            'url' => $bootcamp->canonical_url,
            'provider' => [
                '@type' => 'Organization',
                'name' => $this->getSiteName(),
                'sameAs' => url($locale),
            ],
            'educationalLevel' => $bootcamp->level ?? 'Beginner',
            'inLanguage' => $locale === 'id' ? 'id' : 'en',
        ];

        if ($bootcamp->price) {
            $data['offers'] = [
                '@type' => 'Offer',
                'price' => $bootcamp->price,
                'priceCurrency' => 'IDR',
                'availability' => 'https://schema.org/InStock',
                'url' => $bootcamp->canonical_url,
            ];
        }

        if ($bootcamp->duration) {
            $data['timeRequired'] = 'P' . $bootcamp->duration;
        }

        return $data;
    }

    /**
     * Generate Product structured data for products (JSON-LD)
     */
    public function getProductStructuredData(Product $product): array
    {
        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->seo_title,
            'description' => $product->seo_description,
            'image' => $product->seo_image,
            'url' => $product->canonical_url,
            'brand' => [
                '@type' => 'Brand',
                'name' => $this->getSiteName(),
            ],
        ];

        if ($product->price) {
            $data['offers'] = [
                '@type' => 'Offer',
                'price' => $product->price,
                'priceCurrency' => 'IDR',
                'availability' => 'https://schema.org/InStock',
                'url' => $product->canonical_url,
            ];

            if ($product->original_price && $product->original_price > $product->price) {
                $data['offers']['priceValidUntil'] = now()->addDays(30)->format('Y-m-d');
            }
        }

        if ($product->rating) {
            $data['aggregateRating'] = [
                '@type' => 'AggregateRating',
                'ratingValue' => $product->rating,
                'bestRating' => '5',
                'worstRating' => '1',
            ];
        }

        return $data;
    }

    /**
     * Generate BreadcrumbList structured data (JSON-LD)
     */
    public function getBreadcrumbStructuredData(array $items): array
    {
        $itemListElements = [];

        foreach ($items as $index => $item) {
            $itemListElements[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['name'],
                'item' => $item['url'],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $itemListElements,
        ];
    }

    /**
     * Generate FAQ structured data (JSON-LD)
     */
    public function getFaqStructuredData(array $questions): array
    {
        $mainEntities = [];

        foreach ($questions as $q) {
            $mainEntities[] = [
                '@type' => 'Question',
                'name' => $q['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $q['answer'],
                ],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $mainEntities,
        ];
    }

    /**
     * Generate sitemap XML for all content
     */
    public function generateSitemapXml(): string
    {
        $locale = app()->getLocale();
        $baseUrl = url($locale);

        // Build static pages
        $staticPages = [
            ['url' => $baseUrl, 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => $baseUrl . '/about-us', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => $baseUrl . '/community', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => $baseUrl . '/contact', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => $baseUrl . '/blog', 'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => $baseUrl . '/product', 'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => $baseUrl . '/bootcamp', 'priority' => '0.9', 'changefreq' => 'daily'],
        ];

        // Dynamic pages - Blogs
        $blogs = Blog::active()->latest()->get();
        foreach ($blogs as $blog) {
            $staticPages[] = [
                'url' => $baseUrl . '/blog/' . $blog->slug,
                'priority' => '0.7',
                'changefreq' => 'weekly',
                'lastmod' => $blog->updated_at->toAtomString(),
            ];
        }

        // Dynamic pages - Bootcamps
        $bootcamps = Bootcamp::active()->get();
        foreach ($bootcamps as $bootcamp) {
            $staticPages[] = [
                'url' => $baseUrl . '/bootcamp/' . $bootcamp->id,
                'priority' => '0.8',
                'changefreq' => 'weekly',
                'lastmod' => $bootcamp->updated_at->toAtomString(),
            ];
        }

        // Dynamic pages - Products
        $products = Product::active()->get();
        foreach ($products as $product) {
            $staticPages[] = [
                'url' => $baseUrl . '/product/' . $product->id,
                'priority' => '0.8',
                'changefreq' => 'weekly',
                'lastmod' => $product->updated_at->toAtomString(),
            ];
        }

        // Build XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">';

        foreach ($staticPages as $page) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($page['url']) . '</loc>';

            if (isset($page['lastmod'])) {
                $xml .= '<lastmod>' . $page['lastmod'] . '</lastmod>';
            }

            $xml .= '<changefreq>' . $page['changefreq'] . '</changefreq>';
            $xml .= '<priority>' . $page['priority'] . '</priority>';

            // Add hreflang alternates
            $pathWithoutLocale = str_replace($baseUrl, '', $page['url']);
            foreach ($this->locales as $loc) {
                $alternateUrl = url($loc . ($pathWithoutLocale && $pathWithoutLocale !== '/' ? $pathWithoutLocale : ''));
                $xml .= '<xhtml:link rel="alternate" hreflang="' . $loc . '" href="' . htmlspecialchars($alternateUrl) . '" />';
            }

            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return $xml;
    }
}
