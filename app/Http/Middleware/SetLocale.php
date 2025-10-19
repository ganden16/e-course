<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the locale from the URL first
        $locale = $request->segment(1);

        // Check if the first segment is a valid locale
        if (in_array($locale, ['id', 'en'])) {
            // Set the application locale
            App::setLocale($locale);

            // Store in session for future requests
            Session::put('locale', $locale);
        } else {
            // If no locale in URL, try to get from session
            $locale = Session::get('locale', 'id'); // Default to Indonesian

            // Set the application locale
            App::setLocale($locale);

            // Store in session
            Session::put('locale', $locale);
        }

        // Share the current locale with all views
        view()->share('currentLocale', App::getLocale());

        return $next($request);
    }
}
