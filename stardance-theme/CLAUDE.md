# Star Dance Studio — Claude Code Instructions

## CRITICAL: Always consult DESIGN-SYSTEM.md first

Before writing **any** HTML, CSS, or PHP for this project, read `stardance-theme/DESIGN-SYSTEM.md`. All UI work must follow the design system defined there.

---

## Project Location

- Theme: `stardance-theme/`
- CSS: `style.css` → `assets/css/components.css` → `assets/css/sections.css` → `assets/css/responsive.css` → `assets/css/pages/[page].css`
- PHP components: `inc/components.php`, `inc/class-detail-card.php`
- JS: `assets/js/`

---

## Non-Negotiable Rules

1. **Use render functions for all repeating UI.** Never write raw HTML for heroes, CTAs, cards, or FAQ items — use the PHP render functions in `inc/components.php` (and `inc/class-detail-card.php` for single-class detail cards).

2. **Use `.sd-grid--N` for all card grids.** Never write `grid-template-columns` inline in a template or page-specific CSS when the design system grid modifier covers it.

3. **Never use `.sd-btn--outline` or `.sd-btn--ghost` without the `.sd-btn` base class.** Always combine: `sd-btn sd-btn--outline`.

4. **All new CSS goes in the right file:**
   - Reusable component styles → `components.css`
   - Section/page-layout styles → `sections.css`
   - Responsive overrides → `responsive.css`
   - Page-specific one-off styles → `assets/css/pages/[page].css`
   - Never put layout or component styles in `style.css` (tokens/resets only).

5. **Use design tokens, not raw values.** Write `var(--sd-navy)` not `#00386D`. Write `var(--sd-space-lg)` not `40px`. For font size, use `var(--sd-type-*)` from `style.css` — each is a fluid `clamp()`; do not add breakpoint `font-size` in `responsive.css` unless there is a layout-specific exception.

6. **Animation classes.** Scroll-triggered fade-in: add `fade-in` + `fade-in-delay-N` (0–10) to elements. No inline `opacity` or `transform` on animated elements.

7. **Image base URL.** All uploaded media is at `http://stardance.com.cy/wp-content/uploads/2026/02/`. SVG icons are in `assets/images/`.

8. **BEM + `sd-` namespace.** All new classes follow `.sd-block__element--modifier`. Never introduce a class that doesn't follow this pattern.

9. **No Bricks Builder. No third-party sliders or lightboxes.** This theme uses a custom vanilla JS lightbox slider (`assets/js/gallery.js`) and a custom coach slider (`assets/js/about.js`). Do not introduce PhotoSwipe, Swiper, Glide, or any similar library. Lightbox styles live in `components.css` (`.sd-lightbox*`). Never use `.brx` classes or `bricks_` PHP hooks.

---

## Available Render Functions

| Function | Use for |
|---|---|
| `stardance_render_page_hero($args)` | Inner-page hero sections |
| `stardance_render_cta($args)` | Call-to-action bands |
| `stardance_render_overlay_card($args)` | Class cards (`--tall`) and competition cards (`--portrait`) |
| `stardance_render_icon_card($args)` | Icon + title + text cards |
| `stardance_render_class_detail_card($args)` | Single-class “Class Details” image cards |
| `stardance_render_event_card($args)` | Event listing cards |
| `stardance_render_faq_item($args)` | FAQ accordion items |

Full signatures and HTML output are documented in `DESIGN-SYSTEM.md`.

---

## Key Design Tokens (quick reference)

```
--sd-navy: #00386D
--sd-gold: #D4A054
--sd-gold-dark: #B8842A
--sd-white: #FFFFFF
--sd-light-blue: #d9f7fc
--sd-body-text: #3a3a3a
--sd-font-heading: 'Cormorant', serif
--sd-font-body: 'Libertinus Sans', sans-serif
--sd-type-body, --sd-type-section, --sd-type-display-home, --sd-type-display-page, --sd-type-lead, --sd-type-card-title, --sd-type-ui-md/sm, --sd-type-btn, --sd-type-caption, --sd-type-micro-* … (full fluid scale in style.css `:root`)
--sd-space-xs/sm/md/lg/xl: 8/16/24/40/60px
--sd-radius: 12px
--sd-section-padding: 80px 0
--sd-max-width: 1200px
--sd-grid-gap: 24px
--sd-transition: 0.3s ease
```

Breakpoints: 1920px+ · 991px · 767px · 478px
