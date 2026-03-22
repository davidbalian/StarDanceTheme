# Star Dance Studio — Design System Reference

**Theme location:** `stardance-theme/`
**Last updated:** 2026-03-22

---

## Architecture Overview

CSS loads in strict cascade order:

```
style.css           ← Design tokens + resets
  ↓
components.css      ← ALL reusable component classes (buttons, cards, forms, layout)
  ↓
sections.css        ← Homepage-only section layouts (header, hero, coaches, contact, footer)
  ↓
responsive.css      ← All media query overrides
  ↓
assets/css/pages/   ← Page-specific CSS (conditionally enqueued)
  classes.css | events.css | about.css | schedule.css | gallery.css | single-class.css
```

PHP component functions live in `inc/components.php` (required at top of `functions.php`).
New JS for FAQ accordion: `assets/js/faq.js`.

---

## Design Tokens (`style.css` `:root`)

### Colors
| Variable | Value | Usage |
|---|---|---|
| `--sd-gold` | `#EABE81` | Light gold accent |
| `--sd-gold-dark` | `#BE6D2B` | Dark gold, hover states |
| `--sd-gold-border` | `#DC9A72` | Borders, icon strokes |
| `--sd-gold-gradient` | `linear-gradient(65deg, #E4AF78, #DC9A72, #BE6D2B, #EABE81)` | Primary buttons, active states |
| `--sd-navy` | `#00386D` | Headings, dark text |
| `--sd-light-blue` | `#d9f7fc` | Section backgrounds, outline button color |
| `--sd-body-text` | `#2D292A` | Body copy |
| `--sd-white` | `#FFFFFF` | Text on dark, card text |
| `--sd-form-bg` | `rgba(0,56,109,0.6)` | Form input backgrounds |
| `--sd-overlay-dark` | `rgba(0,0,0,0.35)` | Hero overlays |
| `--sd-gradient-card` | `linear-gradient(to top, rgba(0,0,0,0.7)…)` | Competition card gradient |

### Typography
| Variable | Value |
|---|---|
| `--sd-font-heading` | `'Cormorant', serif` |
| `--sd-font-body` | `'Libertinus Sans', sans-serif` |

### Layout
| Variable | Value | Usage |
|---|---|---|
| `--sd-max-width` | `1200px` (1400px at 1920px+) | Container max-width |
| `--sd-section-padding` | `80px 0` (60px at mobile) | Section vertical padding |
| `--sd-grid-gap` | `24px` | Grid gap |
| `--sd-radius` | `12px` | Card/image border-radius |
| `--sd-radius-pill` | `500px` | Button border-radius |

### Spacing Scale
| Variable | Value |
|---|---|
| `--sd-space-xs` | `8px` |
| `--sd-space-sm` | `16px` |
| `--sd-space-md` | `24px` |
| `--sd-space-lg` | `40px` |
| `--sd-space-xl` | `60px` |

### Effects
| Variable | Value |
|---|---|
| `--sd-shadow-sm` | `0 2px 8px rgba(0,0,0,0.08)` |
| `--sd-shadow-md` | `0 4px 16px rgba(0,0,0,0.1)` |
| `--sd-transition` | `0.3s ease` |

### Responsive Breakpoints
| Name | Value |
|---|---|
| XL Upscale | `min-width: 1920px` |
| Tablet | `max-width: 991px` |
| Mobile | `max-width: 767px` |
| Small Mobile | `max-width: 478px` |

---

## Naming Convention

**BEM with `sd-` namespace prefix:**
- Block: `sd-card`, `sd-btn`, `sd-hero`
- Element: `sd-card__title`, `sd-btn__icon`
- Modifier: `sd-btn--outline`, `sd-card--featured`
- State: `is-active`, `is-open`, `visible` (no prefix)

---

## PHP Render Functions (`inc/components.php`)

Always use these functions instead of copy-pasting HTML. Every function uses `wp_parse_args()` so all parameters are optional unless noted.

---

### `stardance_render_page_hero( $args )`

Inner-page hero section. Used on all non-homepage page templates.

```php
stardance_render_page_hero(array(
    'title'         => 'Page Title',          // required
    'description'   => 'Subtitle text.',      // optional
    'modifier'      => 'classes',             // optional — BEM modifier e.g. 'classes', 'events'
    'tag'           => 'h1',                  // optional — 'h1' | 'h2' | 'h3'. Default: 'h1'
    'thumbnail_url' => 'https://...',         // optional — adds .sd-page-hero__thumbnail
    'button_text'   => 'Book a Trial',        // optional — adds CTA button
    'button_url'    => home_url('/#contact'), // optional — required if button_text is set
));
```

**Output structure:**
```html
<section class="sd-page-hero sd-page-hero--{modifier} sd-section">
    <div class="sd-container">
        [.sd-page-hero__thumbnail if thumbnail_url]
        [.sd-page-hero__content wrapper if thumbnail or button]
        <h1 class="sd-heading sd-page-hero__title fade-in fade-in-delay-0">…</h1>
        <p class="sd-text sd-page-hero__desc fade-in fade-in-delay-1">…</p>
        [<a class="sd-btn fade-in fade-in-delay-2"> if button]
    </div>
</section>
```

---

### `stardance_render_cta( $args )`

Full-width call-to-action section. Used at the bottom of most pages.

```php
stardance_render_cta(array(
    'title'       => 'Ready to Start Dancing?', // required
    'description' => 'Book a trial lesson.',    // optional
    'button_text' => 'Get in Touch',            // optional. Default: 'Get in Touch'
    'button_url'  => home_url('/#contact'),     // optional
    'id'          => 'cta',                     // optional. Default: 'cta'
));
```

---

### `stardance_render_overlay_card( $args )`

Background-image card with bottom-aligned content overlay. Two variants:

| Variant | CSS Class | Use Case |
|---|---|---|
| `'tall'` | `.sd-overlay-card--tall` | Dance class cards (fixed 390px height, no gradient) |
| `'portrait'` | `.sd-overlay-card--portrait` | Competition cards (2:3 ratio, dark gradient, gold border) |

```php
stardance_render_overlay_card(array(
    'image_url'   => 'https://…/image.jpg', // required
    'title'       => 'Card Title',          // required
    'description' => 'Short description.',  // optional
    'meta'        => '21.01.2026',          // optional — displayed above title (e.g. date)
    'link_url'    => home_url('/classes/'), // optional — adds .sd-btn.sd-btn--outline
    'link_text'   => 'Learn More',          // optional. Default: 'Learn More'
    'variant'     => 'tall',                // optional. Default: 'tall'
    'delay'       => 1,                     // optional — fade-in delay index 0–10
));
```

---

### `stardance_render_icon_card( $args )`

Centered icon + title + text card. Consolidates three formerly separate patterns:
- Homepage about features (`.sd-about__feature`)
- About page values (`.sd-about-values__card`)
- Single class detail cards (`.sd-class-details__card`)

```php
stardance_render_icon_card(array(
    'icon_url'  => get_template_directory_uri() . '/assets/images/icon-star.svg', // required
    'title'     => 'Card Title',   // required
    'text'      => 'Description.', // required
    'icon_size' => 48,             // optional — px. Default: 48. Use 60 for homepage about section.
    'delay'     => 1,              // optional — fade-in delay index 0–10
));
```

**Note:** When used inside `.sd-about__features` (the homepage flex container), the cards automatically get `flex: 0 0 calc(33.333% - 30px)` sizing from `sections.css`. No extra wrapper needed.

---

### `stardance_render_event_card( $args )`

Event card with image, date, tag pill, title, location, and a button. Used on the events page.

```php
stardance_render_event_card(array(
    'image_url'  => 'https://…/image.jpg',  // required
    'image_alt'  => 'Event name',           // required
    'date'       => '15 March 2026',        // optional
    'tag'        => 'Competition',          // optional — 'Competition' | 'Showcase' | 'Workshop'
    'title'      => 'Event Title',          // required
    'location'   => 'Limassol, Cyprus',     // optional
    'link_url'   => '#',                    // optional
    'link_text'  => 'View Details',         // optional. Default: 'View Details'
    'data_attrs' => array(                  // optional — for JS filtering
        'year'     => '2026',
        'category' => 'ballroom',
        'type'     => 'competition',
        'body'     => 'wdsf',
    ),
    'delay'      => 1,
));
```

---

### `stardance_render_faq_item( $args )`

Single FAQ accordion item. Wrap multiple items in `.sd-faq__list`. The FAQ JS (`assets/js/faq.js`) handles toggling automatically — no extra setup needed.

```php
// Wrapper:
<div class="sd-faq__list">
    <?php stardance_render_faq_item(array(
        'question' => 'Question text?',   // required
        'answer'   => 'Answer text.',     // required — supports basic HTML
        'delay'    => 1,                  // optional — fade-in delay index 0–10
    )); ?>
</div>
```

**Section wrapper pattern:**
```php
<section class="sd-section sd-faq" id="faq">
    <div class="sd-container">
        <h2 class="sd-heading fade-in fade-in-delay-0">FAQ Heading</h2>
        <div class="sd-faq__list">
            <?php stardance_render_faq_item(…); ?>
        </div>
    </div>
</section>
```

---

## CSS Component Classes (`components.css`)

### Containers & Layout

```html
<!-- Standard section + container -->
<section class="sd-section sd-my-section" id="section-id">
    <div class="sd-container">
        …
    </div>
</section>

<!-- Section with white or navy background -->
<section class="sd-section sd-section--white">…</section>
<section class="sd-section sd-section--navy">…</section>

<!-- Centered section CTA link (below a grid) -->
<div class="sd-section__cta fade-in fade-in-delay-N">
    <a href="…" class="sd-btn">View All</a>
</div>
```

### Grid Modifiers

Always add to a `.sd-grid` base class:

```html
<div class="sd-grid sd-grid--2">…</div>  <!-- 2 columns -->
<div class="sd-grid sd-grid--3">…</div>  <!-- 3 columns → 2 at 991px → 1 at 478px -->
<div class="sd-grid sd-grid--4">…</div>  <!-- 4 columns → 2 at 991px → 1 at 478px -->
```

### Typography

```html
<!-- Section heading (48px Cormorant, navy, centered) -->
<h2 class="sd-heading fade-in fade-in-delay-0">Heading</h2>

<!-- Body text block (Libertinus Sans, centered) -->
<p class="sd-text fade-in fade-in-delay-1">Text content.</p>

<!-- Text utilities -->
<p class="sd-text sd-text-left">Left-aligned text</p>
<span class="sd-text-white">White text</span>
<span class="sd-text-navy">Navy text</span>
<span class="sd-text-gold">Gold text</span>
```

### Buttons

**Always use `sd-btn` as the base class. Modifiers add on top.**

```html
<!-- Primary (gold gradient) -->
<a href="…" class="sd-btn">Get in Touch</a>
<button class="sd-btn" type="submit">Submit</button>

<!-- Outline (transparent, light-blue border) — always pair with sd-btn -->
<a href="…" class="sd-btn sd-btn--outline">Learn More</a>

<!-- Ghost (transparent, gold border, active state fills gold) — for filter tabs -->
<button class="sd-btn sd-btn--ghost is-active" data-filter="year" data-value="all">2026</button>
<button class="sd-btn sd-btn--ghost" data-filter="year" data-value="2025">2025</button>

<!-- Size variants (pair with any button class) -->
<a href="…" class="sd-btn sd-btn--sm">Small</a>
<a href="…" class="sd-btn sd-btn--lg">Large</a>
```

### Overlay Cards

```html
<!-- Class card (tall, no gradient) -->
<div class="sd-overlay-card sd-overlay-card--tall fade-in fade-in-delay-1"
     style="background-image: url('…');">
    <div class="sd-overlay-card__content">
        <h3 class="sd-overlay-card__title">Title</h3>
        <p class="sd-overlay-card__desc">Description</p>
        <a href="…" class="sd-btn sd-btn--outline">Learn More</a>
    </div>
</div>

<!-- Competition card (portrait, gradient, gold border) -->
<div class="sd-overlay-card sd-overlay-card--portrait fade-in fade-in-delay-2"
     style="background-image: url('…');">
    <div class="sd-overlay-card__content">
        <span class="sd-overlay-card__meta">21.01.2026</span>
        <h3 class="sd-overlay-card__title">Title</h3>
        <a href="…" class="sd-btn sd-btn--outline">Learn More</a>
    </div>
</div>
```

### Icon Cards

```html
<!-- Standalone -->
<div class="sd-icon-card fade-in fade-in-delay-1">
    <div class="sd-icon-card__icon" aria-hidden="true">
        <img src="…/icon-star.svg" alt="" width="48" height="48">
    </div>
    <h3 class="sd-icon-card__title">Title</h3>
    <p class="sd-icon-card__text">Description text.</p>
</div>

<!-- In a grid -->
<div class="sd-grid sd-grid--3">
    <!-- icon cards here -->
</div>

<!-- In homepage about flex container -->
<div class="sd-about__features">
    <!-- icon cards here — flex sizing applied automatically via sections.css -->
</div>
```

### Event Cards

```html
<article class="sd-event-card fade-in fade-in-delay-1"
         data-year="2026" data-category="ballroom" data-type="competition">
    <div class="sd-event-card__image">
        <img src="…" alt="Event name" width="400" height="280" loading="lazy">
    </div>
    <div class="sd-event-card__content">
        <span class="sd-event-card__date">15 March 2026</span>
        <span class="sd-event-card__tag">Competition</span>
        <h3 class="sd-event-card__title">Event Title</h3>
        <p class="sd-event-card__location">Limassol, Cyprus</p>
        <a href="#" class="sd-btn sd-btn--outline">View Details</a>
    </div>
</article>
```

### Page Hero

Used on all inner pages. Prefer the render function over manual HTML.

```html
<section class="sd-page-hero sd-page-hero--classes sd-section">
    <div class="sd-container">
        <h1 class="sd-heading sd-page-hero__title fade-in fade-in-delay-0">Title</h1>
        <p class="sd-text sd-page-hero__desc fade-in fade-in-delay-1">Subtitle.</p>
    </div>
</section>
```

### CTA Section

Prefer the render function over manual HTML.

```html
<section class="sd-section sd-cta" id="cta">
    <div class="sd-container sd-cta__inner">
        <h2 class="sd-heading sd-cta__title fade-in fade-in-delay-0">Ready to Start?</h2>
        <p class="sd-text sd-cta__desc fade-in fade-in-delay-1">Description.</p>
        <a href="…" class="sd-btn fade-in fade-in-delay-2">Get in Touch</a>
    </div>
</section>
```

### FAQ Accordion

Prefer the render function over manual HTML. JS is auto-initialised on page load.

```html
<section class="sd-section sd-faq" id="faq">
    <div class="sd-container">
        <h2 class="sd-heading fade-in fade-in-delay-0">FAQ</h2>
        <div class="sd-faq__list">
            <div class="sd-faq__item fade-in fade-in-delay-1">
                <button class="sd-faq__question" aria-expanded="false">
                    Question text?
                    <span class="sd-faq__icon" aria-hidden="true"></span>
                </button>
                <div class="sd-faq__answer" hidden>
                    <p>Answer text.</p>
                </div>
            </div>
        </div>
    </div>
</section>
```

### Form Inputs

```html
<!-- Text / email / tel / textarea -->
<input type="text" class="sd-input" placeholder="First Name">
<textarea class="sd-input" rows="5" placeholder="Your Message"></textarea>

<!-- Select -->
<select class="sd-input sd-select">
    <option value="" disabled selected>Choose an option</option>
    <option value="latin">Latin American</option>
</select>
```

### Spacing Utilities

```html
<h2 class="sd-heading sd-mb-sm">Heading with small bottom margin</h2>
<p class="sd-text sd-mb-lg">Text with large bottom margin</p>

<!-- Available: sd-mb-0, sd-mb-sm, sd-mb-md, sd-mb-lg, sd-mb-xl -->
```

---

## Animations

All visible elements use scroll-triggered fade-in. Add both classes:

```html
<element class="fade-in fade-in-delay-N">
```

- `fade-in` — starts invisible, transitions to visible when `.visible` is added by JS
- `fade-in-delay-0` through `fade-in-delay-10` — stagger delays in 0.1s increments (0s → 1s)
- All delays collapse to `0s` on mobile (≤767px)

**Convention:** Start each section at delay-0 for the heading, delay-1 for subtitle, delay-2+ for content.

---

## Page Templates

| File | Template Name | CSS File |
|---|---|---|
| `front-page.php` | Homepage | `sections.css` |
| `page-classes.php` | Classes | `pages/classes.css` |
| `page-events.php` | Events | `pages/events.css` |
| `page-about.php` | About | `pages/about.css` |
| `page-schedule.php` | Schedule | `pages/schedule.css` |
| `page-gallery.php` | Gallery | `pages/gallery.css` |
| `single-dance_class.php` | Single dance_class CPT | `pages/single-class.css` |

### Standard Page Structure

```php
<?php get_header(); ?>
<main class="sd-page sd-page--{name}" id="main-content">

    <?php stardance_render_page_hero(array(
        'title'       => 'Page Title',
        'description' => 'Page subtitle.',
        'modifier'    => '{name}',
    )); ?>

    <section class="sd-section sd-{name}-page" id="{section-id}">
        <div class="sd-container">
            <h2 class="sd-heading fade-in fade-in-delay-0">Section Heading</h2>
            <!-- content -->
        </div>
    </section>

    <?php stardance_render_cta(array(
        'title'       => 'CTA Heading',
        'description' => 'CTA description.',
        'button_text' => 'Get in Touch',
        'button_url'  => home_url('/#contact'),
    )); ?>

</main>
<?php get_footer(); ?>
```

---

## Homepage Template Parts

The homepage (`front-page.php`) is composed from 8 template parts:

| File | Section | Key Classes |
|---|---|---|
| `template-parts/hero.php` | Full-screen hero | `.sd-hero` |
| `template-parts/classes.php` | Class card grid | `.sd-classes`, `.sd-overlay-card--tall` |
| `template-parts/gallery.php` | Photo gallery | `.sd-gallery` |
| `template-parts/about.php` | Features | `.sd-about`, `.sd-about__features`, `.sd-icon-card` |
| `template-parts/timetable.php` | Timetable SVG | `.sd-timetable` |
| `template-parts/competitions.php` | Competition cards | `.sd-competitions`, `.sd-overlay-card--portrait` |
| `template-parts/coaches.php` | Coach profiles | `.sd-coaches` |
| `template-parts/contact-form.php` | AJAX contact form | `.sd-contact` |

---

## Image Base URL

All uploaded images are served from:
```
http://stardance.com.cy/wp-content/uploads/2026/02/
```

Common filenames:
- `European-Ballroom.png`, `Latin-American.png`, `Latin-Fusion-Ladies.png`
- `Kids-Programs.png`, `Wedding-Choreography.png`, `Individual-Lessons.png`
- `competition1.png` through `competition4.png`
- `contact-sec-bg-1536x497.jpg`, `Mask-group.jpg`

---

## Rules for New Development

1. **Always use render functions** for page heroes, CTAs, overlay cards, icon cards, event cards, and FAQ items. Do not copy-paste their HTML.
2. **Always use `sd-btn` as the base** for all buttons. Apply modifiers (`--outline`, `--ghost`, `--sm`, `--lg`) on top.
3. **Use `sd-grid--N` modifiers** for card grids instead of per-section grid column rules. Only define columns in page-specific CSS if the layout is truly unique (e.g. events sidebar + grid).
4. **Put page-specific CSS** in `assets/css/pages/{page}.css`, not in `sections.css` or `components.css`.
5. **Put reusable component CSS** in `components.css`, not in page files.
6. **Use design tokens** for all colors, spacing, shadows, and transitions. Never use magic numbers.
7. **Add `fade-in fade-in-delay-N`** to every visible element on page load.
8. **Keep `sections.css`** for homepage-only section layouts (header, hero, coaches, contact, footer, gallery grids). Everything used on more than one page belongs in `components.css`.
