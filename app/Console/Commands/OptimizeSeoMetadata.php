<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\Blog;
use App\Models\Bootcamp;
use App\Models\Product;
use App\Services\SeoService;

class OptimizeSeoMetadata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:optimize {--force : Optimize all records even if they already have metadata}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically optimize and generate missing SEO metadata for all active blogs, bootcamps, and products, then refresh the sitemaps.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $force = $this->option('force');
        $this->info('Starting automated SEO metadata optimization...');

        $blogsCount = 0;
        $bootcampsCount = 0;
        $productsCount = 0;

        // 1. Optimize Blogs
        $this->info('Optimizing Blogs...');
        $blogs = Blog::active()->get();
        foreach ($blogs as $blog) {
            $dirty = false;

            if ($force || empty($blog->meta_title)) {
                $blog->meta_title = Str::limit($blog->title, 60, '');
                $dirty = true;
            }

            if ($force || empty($blog->meta_description)) {
                $rawDesc = $blog->excerpt ?: $blog->content;
                $blog->meta_description = $this->cleanAndLimitText($rawDesc, 155);
                $dirty = true;
            }

            if ($force || empty($blog->meta_keywords)) {
                $blog->meta_keywords = $this->generateKeywords($blog->title, $blog->tags->pluck('name')->toArray());
                $dirty = true;
            }

            if ($dirty) {
                $blog->save();
                $blogsCount++;
            }
        }
        $this->info("✓ Optimized {$blogsCount} blogs.");

        // 2. Optimize Bootcamps
        $this->info('Optimizing Bootcamps...');
        $bootcamps = Bootcamp::active()->get();
        foreach ($bootcamps as $bootcamp) {
            $dirty = false;

            if ($force || empty($bootcamp->meta_title)) {
                $blogTitle = $bootcamp->title;
                if (!str_contains(strtolower($blogTitle), 'bootcamp')) {
                    $blogTitle .= ' Bootcamp';
                }
                $bootcamp->meta_title = Str::limit($blogTitle, 60, '');
                $dirty = true;
            }

            if ($force || empty($bootcamp->meta_description)) {
                $bootcamp->meta_description = $this->cleanAndLimitText($bootcamp->description, 155);
                $dirty = true;
            }

            if ($force || empty($bootcamp->meta_keywords)) {
                $categoryName = $bootcamp->category ? $bootcamp->category->name : '';
                $bootcamp->meta_keywords = $this->generateKeywords($bootcamp->title, [$categoryName, 'bootcamp', 'course', 'medical', 'healthcare']);
                $dirty = true;
            }

            if ($dirty) {
                $bootcamp->save();
                $bootcampsCount++;
            }
        }
        $this->info("✓ Optimized {$bootcampsCount} bootcamps.");

        // 3. Optimize Products
        $this->info('Optimizing Products...');
        $products = Product::active()->get();
        foreach ($products as $product) {
            $dirty = false;

            if ($force || empty($product->meta_title)) {
                $product->meta_title = Str::limit($product->title, 60, '');
                $dirty = true;
            }

            if ($force || empty($product->meta_description)) {
                $product->meta_description = $this->cleanAndLimitText($product->description, 155);
                $dirty = true;
            }

            if ($force || empty($product->meta_keywords)) {
                $categoryName = $product->productCategory ? $product->productCategory->name : '';
                $product->meta_keywords = $this->generateKeywords($product->title, [$categoryName, 'online course', 'training', 'healthcare', $product->instructor]);
                $dirty = true;
            }

            if ($dirty) {
                $product->save();
                $productsCount++;
            }
        }
        $this->info("✓ Optimized {$productsCount} products.");

        // 4. Test Sitemap Generation
        $this->info('Testing Sitemap XML generation for all active locales...');
        $seoService = app(SeoService::class);

        // Test Indonesian sitemap
        app()->setLocale('id');
        $seoService->generateSitemapXml();
        $this->info('✓ Generated sitemap for ID locale.');

        // Test English sitemap
        app()->setLocale('en');
        $seoService->generateSitemapXml();
        $this->info('✓ Generated sitemap for EN locale.');

        // Restore default
        app()->setLocale('id');

        $this->info("SEO Metadata optimization successfully completed! Total records updated: " . ($blogsCount + $bootcampsCount + $productsCount));
    }

    /**
     * Clean HTML, double spaces, newlines, and limit text to a specific length.
     */
    private function cleanAndLimitText(?string $text, int $limit): string
    {
        if (empty($text)) {
            return '';
        }

        // Strip HTML tags and entities
        $cleaned = strip_tags($text);
        $cleaned = html_entity_decode($cleaned, ENT_QUOTES, 'UTF-8');

        // Replace multiple whitespace/newlines with a single space
        $cleaned = preg_replace('/\s+/', ' ', $cleaned);
        $cleaned = trim($cleaned);

        return Str::limit($cleaned, $limit, '...');
    }

    /**
     * Generate dynamic keywords from a title and custom terms.
     */
    private function generateKeywords(string $title, array $extraTerms = []): string
    {
        $baseKeywords = [
            'healthcare remote circle',
            'telehealth',
            'medical virtual assistant',
            'mva training',
            'hrc'
        ];

        // Extract key terms from the title (words longer than 3 chars)
        $cleanTitle = preg_replace('/[^a-zA-Z0-9\s]/', '', strtolower($title));
        $titleWords = explode(' ', $cleanTitle);
        $titleKeywords = array_filter($titleWords, function($word) {
            return strlen($word) > 3 && !in_array($word, ['with', 'from', 'your', 'that', 'this', 'about', 'their']);
        });

        // Merge all keywords together
        $merged = array_merge(
            $titleKeywords,
            array_map('strtolower', array_filter($extraTerms)),
            $baseKeywords
        );

        // Remove duplicates and empty values
        $unique = array_unique(array_filter($merged));

        // Limit to top 10 keywords for optimal density
        $limited = array_slice($unique, 0, 10);

        return implode(', ', $limited);
    }
}
