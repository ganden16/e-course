<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch language and redirect back to previous page
     *
     * @param string $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switch($locale)
    {
        // Validate the locale
        if (!in_array($locale, ['id', 'en'])) {
            abort(404);
        }

        // Store the locale in session
        Session::put('locale', $locale);

        // Get the previous URL and replace the language prefix if exists
        $previousUrl = url()->previous();
        $parsedUrl = parse_url($previousUrl);
        $path = $parsedUrl['path'] ?? '';

        // Extract query string if exists
        $query = isset($parsedUrl['query']) ? '?' . $parsedUrl['query'] : '';

        // Check if the URL already has a language prefix
        if (preg_match('/^\/(id|en)\//', $path, $matches)) {
            // Replace the existing language prefix
            $newPath = preg_replace('/^\/(id|en)\//', '/' . $locale . '/', $path);
        } else {
            // Check if the path is just '/' (root)
            if ($path === '/') {
                // For root path, just add the language prefix
                $newPath = '/' . $locale;
            } else {
                // Add new language prefix after the base URL
                $newPath = '/' . $locale;
            }
        }

        // Build the new URL
        $newUrl = url($newPath . $query);

        // Redirect to the same page with new language
        return redirect($newUrl);
    }

    /**
     * Get current language
     *
     * @return string
     */
    public static function getCurrentLanguage()
    {
        return Session::get('locale', 'id'); // Default to Indonesian
    }

    /**
     * Get available languages
     *
     * @return array
     */
    public static function getAvailableLanguages()
    {
        return [
            'id' => [
                'name' => 'Bahasa Indonesia',
                'flag' => '🇮🇩',
                'code' => 'id'
            ],
            'en' => [
                'name' => 'English',
                'flag' => '🇺🇸',
                'code' => 'en'
            ]
        ];
    }

    /**
     * Get language switcher HTML
     *
     * @return string
     */
    // public static function getLanguageSwitcher()
    // {
    //     $currentLang = self::getCurrentLanguage();
    //     $availableLangs = self::getAvailableLanguages();

    //     $html = '<div class="relative" x-data="{ open: false }">';
    //     $html .= '<button @click="open = !open" class="flex items-center space-x-2 bg-white border border-gray-300 rounded-lg px-3 py-2 text-sm hover:bg-gray-50 transition-colors">';
    //     $html .= '<span>' . $availableLangs[$currentLang]['flag'] . '</span>';
    //     $html .= '<span class="hidden sm:inline">' . $availableLangs[$currentLang]['name'] . '</span>';
    //     $html .= '<i class="fas fa-chevron-down text-xs"></i>';
    //     $html .= '</button>';

    //     $html .= '<div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">';

    //     foreach ($availableLangs as $code => $lang) {
    //         if ($code !== $currentLang) {
    //             $currentPath = request()->path();

    //             // Check if the URL already has a language prefix
    //             if (preg_match('/^(id|en)\//', $currentPath, $matches)) {
    //                 // Replace the existing language prefix
    //                 $newPath = preg_replace('/^(id|en)\//', $code . '/', $currentPath);
    //             } else {
    //                 // Add new language prefix
    //                 $newPath = $code . '/' . $currentPath;
    //             }

    //             $html .= '<a href="/lang/' . $code . '" class="flex items-center space-x-3 px-4 py-3 text-sm hover:bg-gray-50 transition-colors">';
    //             $html .= '<span>' . $lang['flag'] . '</span>';
    //             $html .= '<span>' . $lang['name'] . '</span>';
    //             $html .= '</a>';
    //         }
    //     }

    //     $html .= '</div>';
    //     $html .= '</div>';

    //     return $html;
    // }
}
