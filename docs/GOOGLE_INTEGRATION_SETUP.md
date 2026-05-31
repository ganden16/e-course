# Google Integration Setup Guide

## 1. Google Search Console

### Purpose
- Verify ownership of your website to Google
- Monitor search performance and indexing status
- Submit sitemap for faster indexing
- Get search analytics and reports

### Setup Steps

1. **Go to Google Search Console**
   - Visit: https://search.google.com/search-console
   - Sign in with your Google account

2. **Add Property**
   - Choose one of these methods:

   **Option A: Domain Property (Recommended)**
   - Enter: `healthcareremotecircle.com`
   - Requires DNS verification (add TXT record to your DNS)
   - Verifies ALL subdomains and protocols

   **Option B: URL Prefix Property (Easier)**
   - Enter: `https://healthcareremotecircle.com`
   - Choose verification method: **HTML tag**
   - Copy the content value (looks like: `google-site-verification=ABC123XYZ...`)

3. **Add Verification to Your App**

   Open `.env` file and add:
   ```env
   GOOGLE_SITE_VERIFICATION=ABC123XYZ...
   ```

4. **Verify in Search Console**
   - Click "Verify" button in Search Console
   - If successful, you'll see "Ownership verified"

5. **Submit Sitemap**
   - Go to: Sitemaps (left sidebar)
   - Enter: `sitemap.xml`
   - Click "Submit"
   - Do this for BOTH locales:
     - `https://healthcareremotecircle.com/id/sitemap.xml`
     - `https://healthcareremotecircle.com/en/sitemap.xml`

6. **Monitor**
   - Check "Performance" tab for search impressions/clicks
   - Check "Indexing" tab for indexed pages
   - Fix any errors in "Pages" section

---

## 2. Google Analytics 4 (GA4)

### Purpose
- Track website visitors and user behavior
- Monitor page views, sessions, and conversions
- Understand user demographics and traffic sources
- Track multilingual site performance (id vs en)

### Setup Steps

1. **Create Google Analytics Account**
   - Visit: https://analytics.google.com
   - Click "Start measuring"
   - Account name: `Healthcare Remote Circle`

2. **Create Property**
   - Property name: `Healthcare Remote Circle Website`
   - Reporting time zone: `Asia/Jakarta (UTC+7)`
   - Currency: `Indonesian Rupiah (IDR)`

3. **Create Data Stream**
   - Choose: **Web**
   - Website URL: `https://healthcareremotecircle.com`
   - Stream name: `Main Website`
   - Enable enhanced measurement: **ON** (tracks scrolls, outbound clicks, etc.)

4. **Get Measurement ID**
   - After creating stream, you'll see: **Measurement ID**
   - Format: `G-XXXXXXXXXX` (10 characters)
   - Copy this ID

5. **Add to Your App**

   Open `.env` file and add:
   ```env
   GA_MEASUREMENT_ID=G-XXXXXXXXXX
   ```

6. **Configure GA4 Settings**

   In Google Analytics:
   - Go to: Admin > Data Settings > Data Streams
   - Click your stream
   - Configure:
     - ✅ Enhanced measurement (scrolls, outbound clicks, site search, etc.)
     - ✅ Cross-domain tracking (if you have multiple domains)

7. **Create Conversions (Optional)**
   - Go to: Admin > Events > Mark as conversion
   - Mark important events:
     - `page_view` (default)
     - `scroll` (if >90% scroll depth)
     - `click` (on CTA buttons)
     - `form_submit` (contact form)

8. **Create Audiences (Optional)**
   - Go to: Admin > Audiences
   - Create:
     - `Indonesian Users` (language = id)
     - `English Users` (language = en)
     - `High Intent Users` (visited bootcamp pages)

---

## 3. Google Tag Manager (Optional - Advanced)

If you want more control over tags without code changes:

1. **Create GTM Account**
   - Visit: https://tagmanager.google.com
   - Account name: `Healthcare Remote Circle`
   - Container name: `Main Website`
   - Target platform: **Web**

2. **Get Container IDs**
   - You'll get: `GTM-XXXXXXX`

3. **Replace GA4 Script**

   In `resources/views/components/google-analytics.blade.php`, replace with:

   ```blade
   @if(config('app.env') === 'production')
       <!-- Google Tag Manager -->
       <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
       new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
       j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
       'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
       })(window,document,'script','dataLayer','{{ config('services.google.tag_manager_id') }}');</script>
       <!-- End Google Tag Manager -->
   @endif
   ```

   And in `<body>` tag add:
   ```blade
   <!-- Google Tag Manager (noscript) -->
   <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ config('services.google.tag_manager_id') }}"
   height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
   <!-- End Google Tag Manager (noscript) -->
   ```

---

## 4. Testing Your Setup

### Test Google Analytics

1. Open your website in a browser
2. Open Google Analytics > Reports > Realtime
3. You should see your visit in real-time
4. Check:
   - Active users: 1
   - Page views: your current page
   - Language: id or en (depending on URL)

### Test Search Console

1. Go to Search Console > URL Inspection
2. Enter your homepage URL
3. Click "Test Live URL"
4. Should show: **URL is available to Google**

### Verify Meta Tags

1. Open your website
2. Right-click > View Page Source
3. Search for:
   - `google-site-verification` → should show your verification code
   - `gtag/js?id=G-` → should show your GA4 script
   - `application/ld+json` → should show structured data

### Use Online Tools

- **Google Rich Results Test**: https://search.google.com/test/rich-results
  - Enter your URL to check structured data
- **Meta Tags Checker**: https://www.metatags.io
  - Check if OG tags, Twitter cards, and meta are correct

---

## 5. Environment Configuration

### Development (.env.local)
```env
APP_ENV=local
APP_DEBUG=true
GA_MEASUREMENT_ID=          # Leave empty for local
GOOGLE_SITE_VERIFICATION=   # Leave empty for local
```

### Production (.env.production)
```env
APP_ENV=production
APP_DEBUG=false
GA_MEASUREMENT_ID=G-XXXXXXXXXX
GOOGLE_SITE_VERIFICATION=ABC123XYZ
```

The analytics script **only loads in production** to avoid polluting your analytics with test data.

---

## 6. What Happens After Setup

### Google Search Console
- ✅ Google starts crawling your sitemap automatically
- ✅ You get indexed within 1-4 days
- ✅ You receive email alerts for indexing issues
- ✅ You can see search queries that bring traffic

### Google Analytics
- ✅ Every page view is tracked
- ✅ You see visitor demographics, location, device
- ✅ You can track conversion goals (e.g., bootcamp signups)
- ✅ You get automatic insights on traffic spikes

### SEO Impact
- 📈 Faster indexing = faster ranking
- 📊 Data-driven content strategy
- 🔍 Identify high-performing pages
- 🎯 Optimize based on real user behavior

---

## 7. Troubleshooting

### Analytics Not Tracking
- Check `.env` has correct `GA_MEASUREMENT_ID`
- Clear browser cache
- Disable ad blocker
- Check browser console for errors

### Search Console Verification Failed
- Ensure `GOOGLE_SITE_VERIFICATION` is in `.env`
- Clear Laravel cache: `php artisan config:clear`
- Verify meta tag appears in page source

### Sitemap Not Indexed
- Submit sitemap manually in Search Console
- Check sitemap URL is accessible: `https://yoursite.com/sitemap.xml`
- Ensure all pages have `canonical` URL
- Check `robots.txt` allows crawling

---

## 8. Advanced: Custom Events Tracking

To track specific actions (e.g., CTA clicks):

```javascript
// In your blade template
<button onclick="trackCTAClick('bootcamp')">
    Join Bootcamp
</button>

<script>
function trackCTAClick(action) {
    if (typeof gtag !== 'undefined') {
        gtag('event', 'cta_click', {
            'event_category': 'engagement',
            'event_label': action,
            'value': 1
        });
    }
}
</script>
```

These events will appear in GA4 under: **Reports > Engagement > Events**
