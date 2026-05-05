# Performance and loading (Star Dance theme)

This document lists **loading and front-end performance patterns that are implemented in code** in `stardance-theme/`. Actual Core Web Vitals and perceived speed on production also depend on **hosting**, **HTTP caching**, **image compression**, **CDN**, **WordPress object caching**, **third-party plugins**, and **editor content** — those are not fully knowable from the theme alone.

---

## Summary table

| Technique | Where in theme |
|-----------|----------------|
| **No frontend jQuery** for theme bundles — scripts register with **empty dependency arrays** | `stardance_enqueue_assets()` in `stardance-theme/functions.php` |
| **No heavy carousel / lightbox libraries** — small custom JS | `assets/js/gallery.js`, `assets/js/about.js`; policy in `stardance-theme/CLAUDE.md` |
| **Scripts loaded in the footer** (`in_footer` true) | `wp_enqueue_script(..., true)` in `stardance_enqueue_assets()` |
| **Cache-busting via `filemtime`** on theme assets | `stardance_asset_version()` in `functions.php` |
| **Google Fonts with `display=swap`** | Fonts URL in `stardance_enqueue_assets()` |
| **Native lazy-loading on many images** (`loading="lazy"`) | e.g. `stardance_render_gallery_item()`, templates under `template-parts/`, pages |
| **`decoding="async"`** on some images | e.g. class detail card markup |
| **IntersectionObserver for scroll-triggered fades** — avoids animating off-screen elements immediately | `assets/js/animations.js` (`.fade-in` + `.visible`) |
| **Page-scoped stylesheets** — extra CSS only when the template matches | `is_page_template(...)`, `is_front_page()`, `is_singular(...)` in `stardance_enqueue_assets()` |
| **Gallery: paginated SSR + AJAX append** — initial HTML includes **12** items, not the full collection | `page-gallery.php`, `gallery.js`, `stardance_get_gallery_query_payload()` |
| **Responsive hero background images** — breakpoint-specific CSS variables reduce oversized hero downloads | `stardance_get_responsive_hero_images()` in `inc/acf-responsive-images.php`; consumed by `stardance_render_page_hero()` in `inc/components.php` |
| **Fluid typography and layout tokens** (`clamp`, CSS variables) | `stardance-theme/style.css` `:root` tokens |

---

## Scripts and dependencies

Theme front scripts include **`stardance-navigation`**, **`stardance-animations`**, **`stardance-faq`**, **`stardance-gallery`**, **`stardance-contact-form`**. They are **small, vanilla bundles** and do not list `jquery` as a dependency in the front-end enqueue (contrast: admin screens may still use jQuery).

**Caveat:** Several of these files are **enqueued on every page**. If you need to shave bytes further, a future refactor could **conditionally enqueue** e.g. FAQ or gallery only where the matching hooks exist in the DOM.

---

## Stylesheets

The cascade is intentional and ordered in `stardance_enqueue_assets()`:

`style.css` → `components.css` → `sections.css` → `responsive.css` → optional **page** CSS.

Page-specific files (classes, events, about, schedule, **gallery**, contact, single-class, single-event) load **only** when the relevant template or post type matches, which limits unused CSS on unrelated routes.

---

## Images and media

- **Grid thumbnails** use the **`large`** WordPress size; lightbox uses **`full`** (`stardance_render_gallery_item()`).
- **Lazy loading** defers off-screen image fetch in supporting browsers.
- **`iframe loading="lazy"`** appears where maps or embeds are inserted (e.g. single class template).
- **Hero / CTA imagery** can be assigned per breakpoint via ACF fields so CSS picks an appropriate background without sending one huge asset to all viewports.

---

## Gallery as a case study in smaller first payload

The Gallery page does not render every `gallery_item` on first paint. It renders **one page** of posts server-side, then loads more through **`admin-ajax.php`**. That keeps the initial HTML and image count bounded for large libraries.

---

## Related handoff docs

- [gallery-overview-and-data-model.md](./gallery-overview-and-data-model.md)
- [gallery-filters-ajax-show-more.md](./gallery-filters-ajax-show-more.md)
