# Twisted Roots — Blog / Learn Implementation Plan

**Status:** Plan only — **do not publish** until approved  
**Site:** https://trcannabis.ca/  
**Branch:** `cursor/blog-learn-seo-setup-8056`  
**Stack:** WordPress + WooCommerce + Breadstack/DeepKnead + SmartCrawl + Breeze  

---

## Decisions (locked)

| Decision | Choice | Why |
|----------|--------|-----|
| Public hub | Keep **`/education/`** and brand it **Learn** in nav | Already in header/footer; has SEO title; lists posts |
| Blog index URL | **`/blog/`** as WordPress **Posts page** | Cleanest native WP pattern; `/learn/` would duplicate Education |
| Post permalinks | Keep **`/%postname%/`** for now | Avoids breaking 3 live post URLs; add `/blog/` index without redirects |
| Local landing | Strengthen **`/locations/oshawa/`** + Learn hub local copy | Page already exists; no thin duplicate doorway |

**Nav label:** `Learn` → `https://trcannabis.ca/education/`  
**Also add:** `Blog` under Learn (child) **or** footer-only link to `/blog/` — recommendation: **both** header child + footer link.

---

## Current baseline (what exists today)

- **Posts:** 3 published, category `Blog` (id `1`), root URLs, **featured images already set**
- **Pages:** `/education/` (id **77**), no `/blog/` page
- **Tags:** none
- **Archives:** `/category/blog/` works; `/blog/` is **404**
- **SEO plugin:** SmartCrawl (sitemaps + Article schema already on posts)
- **Schema author noise:** `Breadstack Test` / `devops` — fix in SmartCrawl / user profile when editing

---

## Exact changes (checklist)

### A. WordPress admin — Reading & pages

| # | Action | Where | Exact values |
|---|--------|-------|----------------|
| A1 | Create page **Blog** | Pages → Add New | Title: `Blog`; Slug: `blog`; Template: default; Status: draft until go-live |
| A2 | Blog page content | Block editor | Short intro (see copy below) + optional heading only — WP will append the post loop automatically when set as Posts page |
| A3 | Assign Posts page | **Settings → Reading** | “Your homepage displays” = A static page; Homepage = existing Home (`77414`); **Posts page = Blog** |
| A4 | Resulting URLs | — | Index: `https://trcannabis.ca/blog/`; posts stay at `https://trcannabis.ca/{slug}/` |

**Do not change** Settings → Permalinks structure in this phase (no mass redirects).

---

### B. Categories & tags

**Create categories** (Posts → Categories):

| Name | Slug | Parent | Notes |
|------|------|--------|-------|
| Education | `education` | — | Product knowledge, regulations, responsible use |
| Strains & Products | `strains-products` | — | Factual format/type guides (flower, pre-rolls, vapes, etc.) |
| Local Events | `local-events` | — | 19+ in-store events, brand education days |
| Guides | `guides` | — | How-tos, label reading, visiting the store |
| Oshawa & Durham | `oshawa-durham` | — | Local SEO / serving Durham from Oshawa |

**Retire / remap old category `Blog` (id 1):**

| Post | New primary category | Optional 2nd |
|------|----------------------|--------------|
| THC/MG Limits | Education | Guides |
| What is Flow Through? | Education | Strains & Products |
| Rosin / Resin / Distillate | Strains & Products | Education |

After remap, delete or leave unused `Blog` category empty (prefer **rename** `Blog` → unused then delete once empty to avoid `/category/blog/` soft-404 confusion).  
**Recommended:** delete empty `Blog` category after reassignment so sitemap drops `/category/blog/`.

**Starter tags** (optional, create on first use):  
`thc-limits`, `concentrates`, `rosin`, `resin`, `distillate`, `flow-through`, `ocs`, `ontario`, `oshawa`, `durham-region`, `responsible-use`, `pre-rolls`, `dried-flower`, `vapes`, `edibles`

---

### C. Improve Learn landing — page id `77` `/education/`

**SmartCrawl / meta (draft values):**

- **SEO title:** `Cannabis Education & Guides in Oshawa | Twisted Roots`
- **Meta description:** `Educational cannabis guides for adults 19+ from Twisted Roots at 191 Bloor St E, Oshawa. Learn about products, Ontario rules, and shopping in Durham Region.`

**On-page structure (Gutenberg blocks — replace/extend current thin listing):**

1. **H1:** `Cannabis Education & Guides` (keep or tighten)
2. **Intro (local SEO, compliant):** 2 short paragraphs — Oshawa store, 191 Bloor St E, adults 19+, Durham communities served (Whitby, Ajax, Pickering, Courtice, Bowmanville, Clarington), factual/educational mission
3. **H2:** `Browse by topic` — 5 cards/links to new category archives  
4. **H2:** `Latest from the blog` — links to `/blog/` + manual list or latest 3 post links (until a query block is available)
5. **H2:** `Shop by category` — internal links (see section F)
6. **H2:** `Visit our Oshawa dispensary` — NAP + link to `/locations/oshawa/` + Contact
7. **H2:** `FAQ` — 3–4 questions (ID 19+, address, what education covers, nearby cities)

**Compliance:** no “best/top,” no youth appeal, no glamour/lifestyle intoxication claims.

---

### D. Blog index page — `/blog/` (Posts page)

When assigned as Posts page, theme renders the post loop. Add **above-loop** content via the Blog page editor if the theme supports it; otherwise rely on archive title + SmartCrawl meta:

- **SEO title:** `Twisted Roots Blog | Cannabis Guides for Oshawa & Durham`
- **Meta description:** `Articles and guides for adults 19+ about cannabis products, Ontario regulations, and visiting Twisted Roots Cannabis in Oshawa.`
- **H1:** `Blog` or `Learn with Twisted Roots`

Confirm theme archive template shows: featured image, title, excerpt, category, date (Understrap child typically does).

---

### E. Navigation & footer

**Appearance → Menus** (likely “Primary” / header utility menu that includes Home…Education):

| Item | URL | Parent | Label |
|------|-----|--------|-------|
| Update existing Education | `/education/` | — | **Learn** |
| Add Blog | `/blog/` | Learn | **Blog** |

**Footer menu** (product/legal footer column that already has Education):

| Item | URL | Label |
|------|-----|-------|
| Rename Education → Learn | `/education/` | Learn |
| Add Blog | `/blog/` | Blog |

Exact menu names to locate in admin: inspect **Appearance → Menus** for the menu containing “Education”, “About Us”, “Contact Us”.

---

### F. Internal linking map (posts ↔ shop ↔ location)

Add a reusable closing block on each post (and future posts), titled **Continue exploring**:

| Anchor text | URL |
|-------------|-----|
| Twisted Roots Oshawa location | `/locations/oshawa/` |
| Contact / hours | `/contact-us/` |
| Dried flower | `/product-category/dried-flower/` |
| Pre-rolls | `/product-category/pre-rolls/` |
| Infused pre-rolls | `/product-category/infused-pre-roll/` |
| Vapes | `/product-category/vapes/` |
| Edibles | `/product-category/edibles/` |
| Extracts | `/product-category/extracts/` |
| Oils & capsules | `/product-category/oilscapsules/` |
| All education guides | `/education/` |
| Blog | `/blog/` |

**Per-post extras (existing articles):**

| Post | Add links to |
|------|----------------|
| Concentrates overview | `/product-category/extracts/` (+ resin/rosin subcats if useful), `/education/` |
| THC/MG Limits | `/education/`, `/locations/oshawa/`, responsible-use wording only |
| Flow Through | `/shop/` or featured categories, `/locations/oshawa/` |

Optional: create a **reusable block** or Shortcode/HTML snippet in WordPress named `TR Learn footer links` for editors.

---

### G. Featured images, categories, tags, schema

| Requirement | Status / action |
|-------------|-----------------|
| Featured images | **Already supported**; all 3 posts have `featured_media`. Keep requiring on new posts. |
| Categories | Create 5 above; assign on edit |
| Tags | Enable via post editor (native); seed as needed |
| Article schema | **Already output** by SmartCrawl on posts (`Article`, breadcrumbs). Verify after `/blog/` goes live |
| Author schema | Change display name from “Breadstack Test” → e.g. `Twisted Roots` (Users → Profile or SmartCrawl schema author settings) |
| CollectionPage on `/blog/` | Should appear automatically as posts archive |

**SmartCrawl checks after publish:**  
Sitemaps include `/blog/`, new category URLs; remove dead `/category/blog/` if category deleted; purge Breeze.

---

### H. Strengthen local SEO on `/locations/oshawa/` (content only, same phase)

Add sections (compliant, factual):

- Clear H1/H2 mentioning Oshawa cannabis retail storefront  
- NAP consistency: `191 Bloor St E, Oshawa, ON L1H 3M3`, `(905) 240-1782`  
- “Serving Durham Region” paragraph (Whitby, Ajax, Pickering, Courtice, Bowmanville, Clarington) — travel to Oshawa store, not fake branches  
- Link to `/education/` and `/blog/`  
- FAQ: parking/ID 19+/hours  

(Schema address/hours cleanup can be a follow-up in SmartCrawl Local Business if fields are available.)

---

### I. Cache / SEO hygiene on go-live

1. SmartCrawl → rebuild sitemaps  
2. Breeze → Purge All  
3. Spot-check: `/blog/` 200, `/education/` updated, nav Learn + Blog, category archives 200  
4. Confirm old post URLs still 200 (no permalink change)

---

## Files / artifacts in this repo

This repository does **not** contain the live Understrap child theme. Implementation is **WordPress admin / content**, not theme PR files.

| Repo path | Purpose |
|-----------|---------|
| `BLOG-LEARN-IMPLEMENTATION-PLAN.md` | This plan (approval artifact) |
| `blog-content/learn-page-draft.md` | Draft copy blocks for `/education/` |
| `blog-content/blog-page-draft.md` | Draft copy for Posts page `/blog/` |
| `blog-content/internal-linking-snippet.html` | Reusable HTML for post footers |
| `blog-content/category-setup.md` | Category slugs + post remaps |

**No live theme PHP changes required** for Phase 1 if Understrap archives already show featured images (they do on current post templates).

**Only if** `/blog/` archive lacks featured images or excerpt after assigning Posts page: then add a child-theme template override via SFTP (`understrap-child-1.2.0/archive.php` or `home.php`) — out of scope until verified.

---

## Out of scope for this approval pass

- Publishing the pages/menus live (waiting on your OK)  
- Writing new monthly articles beyond restructuring existing 3  
- Changing permalinks to `/blog/%postname%/`  
- Homepage hero redesign  
- Fixing LocalBusiness schema currency/hours (separate SEO ticket)  
- Medical claims or promotional “best dispensary” copy

---

## Go-live order (when you say publish)

1. Create categories + remap 3 posts + tags  
2. Create Blog page (draft) → set Reading → Posts page  
3. Update Education page content + SmartCrawl meta  
4. Update menus/footer  
5. Add internal linking blocks to 3 posts  
6. Touch `/locations/oshawa/` local section  
7. SmartCrawl sitemap + Breeze purge  
8. QA on mobile/desktop  

---

## Approval needed from you

Reply **approve publish** (or request edits) on:

1. Nav label **Learn** → `/education/` with child **Blog** → `/blog/`  
2. Keep post URLs at root `/%postname%/`  
3. Delete empty legacy category `Blog` after remapping  
4. Draft copy in `blog-content/*` (next files) as the source text to paste into WP  

No changes will be published until you confirm.
