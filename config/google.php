<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Google Analytics Measurement ID
    |--------------------------------------------------------------------------
    |
    | Get your Measurement ID from Google Analytics 4:
    | 1. Go to https://analytics.google.com
    | 2. Admin > Data Streams > Your Web Stream
    | 3. Copy Measurement ID (format: G-XXXXXXXXXX)
    |
    | Set this in your .env file as:
    | GA_MEASUREMENT_ID=G-XXXXXXXXXX
    |
    */

    'measurement_id' => env('GA_MEASUREMENT_ID', ''),

    /*
    |--------------------------------------------------------------------------
    | Google Search Console Verification
    |--------------------------------------------------------------------------
    |
    | Get your verification meta tag from Google Search Console:
    | 1. Go to https://search.google.com/search-console
    | 2. Add Property (Domain or URL Prefix)
    | 3. Choose "HTML tag" verification method
    | 4. Copy the content value (format: google-site-verification=XXXXX)
    |
    | Set this in your .env file as:
    | GOOGLE_SITE_VERIFICATION=XXXXX
    |
    */

    'site_verification' => env('GOOGLE_SITE_VERIFICATION', ''),
];
