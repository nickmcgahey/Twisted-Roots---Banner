# trcannabis.ca — Performance & SEO Audit

**Date:** 2026-08-08  
**Site:** https://trcannabis.ca/  
**Stack:** WordPress + WooCommerce + Understrap child + DeepKnead + SmartCrawl Pro + Breeze + Smush Pro + Cloudflare/Cloudways

## Baseline (Lighthouse mobile, before)

| Category | Score |
|----------|------:|
| Performance | 50 |
| SEO | 83 |
| Accessibility | 69 |
| Best Practices | 93 |

Key baseline issues:
- **TTFB ~2.6s** (Breeze page cache was disabled)
- No homepage `<h1>`
- Render-blocking CSS/JS, large unoptimized images, heavy third parties (GTM ×2, Hotjar, chat widget)
- SmartCrawl warning: conflict with **Redirection** plugin
- Generic “View All” link text; heading-order issues

## Changes applied (live WordPress)

### Performance
1. **Enabled Breeze Cache System** (was off) + gzip + browser cache  
   - Live TTFB improved to **~100–200ms** with `x-cache: HIT` / Cloudways cache
2. **Enabled Breeze file optimization:** HTML/CSS/JS minify + `font-display`  
   - Left **combine CSS/JS off** (safer for WooCommerce/age gate)  
   - Excluded critical JS keywords: `agegate`, jQuery, WooCommerce, DeepKnead
3. **Preload:** link preload on; DNS prefetch for GTM/Hotjar/CDNs; cache warmup URLs
4. Kept Breeze **image lazy-load off** (Smush Pro already handles lazy-load; avoids LCP regressions)
5. Hero cover uses `loading="eager"`; WP also applies LCP `fetchpriority` on render

### SEO
1. Homepage H1 was briefly added for SEO, then **removed on request** (it showed as unwanted text/white bar on mobile). Prefer a design-approved brand H1 later if needed.
2. Improved product-category **“View All”** anchors to descriptive text where present
3. SmartCrawl: **disabled URL Redirection module** (keeps the separate Redirection plugin as source of truth)
4. SmartCrawl: hide generator meta + redundant canonical options confirmed on
5. **robots.txt** expanded (cart/checkout/account, admin, noisy query params) + sitemap
6. SmartCrawl Schema Types: **Local Business** type added for **Homepage**

## After (Lighthouse mobile)

| Category | Before | After |
|----------|-------:|------:|
| Performance | 50 | ~53 |
| SEO | 83 | ~82 |
| Accessibility | 69 | 69 |
| Best Practices | 93 | 93 |

Notable metric moves:
- **Server response:** 2,610ms → **~140–200ms**
- **TBT:** improved (~400ms → ~270ms in last run)
- **CLS:** improved to ~0 in last run
- Lab FCP/LCP remain volatile (age gate, hero image weight, third-party JS dominate LCP)

## Remaining recommendations (need admin/plugin access or design work)

1. **Finish Smush Pro bulk optimize** — dashboard showed ~503 images still to optimize; large homepage PNGs/JPGs still cost 1MB+ in Lighthouse.
2. **Defer/delay Hotjar + duplicate GA/GTM** — two gtag IDs and Hotjar block main thread; load after consent/interaction if possible.
3. **Age-gate heading** — `ARE YOU 19+?` is an `<h2>` before the page `<h1>`, which fails heading-order. Change age-gate copy to a `<p>`/`<div>` in DeepKnead/age-gate settings if available.
4. **Featured category titles** use `<h5>` under `<h2>` (skip levels) — adjust ACF/block markup when theme access allows.
5. **Font Awesome full CSS** from CDN is mostly unused — switch to subset/inline critical icons.
6. **Cloudflare HTML caching** stays `DYNAMIC` because of location cookies; origin/Breeze cache is the main win unless CF cache rules ignore those cookies for anonymous HTML.
7. **Plugin conflict notice** may still show while Redirection remains installed; that is expected after disabling SmartCrawl’s redirect module.
8. Nick’s WP user cannot open **Plugins** / some Smush subpages — an Administrator should apply plugin-level cleanups.

## Verify anytime

```bash
curl -sI https://trcannabis.ca/ | egrep -i 'x-cache|age|cache-provider'
curl -sL https://trcannabis.ca/robots.txt
# Homepage should include:
# <h1 ...>Twisted Roots Cannabis — Oshawa Dispensary</h1>
```
