# Twisted Roots (trcannabis.ca) bug fixes

## Mobile Pre-Roll freeze — jQuery `$` ReferenceError

### Symptom
On mobile, scrolling/viewing Pre-Rolls (category or homepage section) can freeze or break interactions.

### Root cause
Every frontend page includes this inline script immediately after WordPress jQuery:

```html
<script id="jquery-core-js-after">$ = $ || jQuery;</script>
```

WordPress runs jQuery in `noConflict()` mode, so bare `$` is **undeclared**. Evaluating `$` on the right-hand side throws:

`ReferenceError: $ is not defined`

That aborts subsequent JavaScript. Likely source: child theme `understrap-child-1.2.0` via `wp_add_inline_script( 'jquery-core', ... )` (file editing is disabled in wp-admin).

### Related issue
Breeze **JS minification** was compounding breakage (minified bundles + strict contexts). JS minify has been turned **OFF** in Breeze (HTML/CSS minify can stay on). Keep JS minify off until the inline script is fixed.

### Other console errors
- DeepKnead `location.js`: Google Maps API key missing (`Failed to load map: Google Maps API key is required`)

### Fix options (pick one)

#### A) Install plugin (recommended if theme editor blocked)
1. Upload folder `tr-jquery-dollar-fix/` to `/wp-content/plugins/` (SFTP/Cloudways File Manager), or zip it and upload under Plugins → Add New if allowed.
2. Activate **TR jQuery $ Fix**.
3. Purge Breeze cache.
4. Confirm page source no longer errors: `typeof $ === "function"` in console.

#### B) Edit the source snippet
In child theme PHP (likely `functions.php` or `inc/this-site/enqueue*.php`), change:

```php
wp_add_inline_script( 'jquery-core', '$ = $ || jQuery;' );
```

to:

```php
wp_add_inline_script( 'jquery-core', 'window.$ = window.jQuery;' );
```

Then purge Breeze.

#### C) Temporary head declare
Any header injection plugin:

```html
<script>var $;</script>
```

Must run in `<head>` **before** `jquery-core-js-after`.

### Verify
1. https://trcannabis.ca/product-category/pre-rolls/ on a phone or DevTools mobile viewport
2. Console: no `$ is not defined`
3. Scroll product grid smoothly
