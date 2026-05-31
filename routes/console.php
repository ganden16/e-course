<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Scheduled Tasks for SEO
Schedule::command('cache:prune-stale-tags')->hourly();
Schedule::command('seo:optimize --force')->dailyAt('01:00')->name('seo_optimize_metadata')->withoutOverlapping();


// Clear expired cache entries daily
Schedule::command('cache:clear')->dailyAt('03:00')->when(fn () => config('app.env') === 'local');

// Optimize application daily
Schedule::command('optimize:clear')->dailyAt('02:00');
