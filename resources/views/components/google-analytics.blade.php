{{-- Google Analytics 4 (GA4) --}}
{{-- Place this in <head> or just before </body> --}}
@if(config('app.env') === 'production' && config('google.measurement_id'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('google.measurement_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{ config('google.measurement_id') }}', {
            'anonymize_ip': true,
            'send_page_view': true,
            'cookie_flags': 'SameSite=None;Secure'
        });

        // Track locale changes for multilingual site
        document.addEventListener('DOMContentLoaded', function() {
            const locale = document.documentElement.lang;
            gtag('set', 'language', locale);
            gtag('set', 'country', locale === 'id' ? 'ID' : 'US');
        });
    </script>
@endif
