# Star Dance theme — handoff documentation

This folder documents how the **Star Dance Studio** WordPress theme ([`stardance-theme/`](../stardance-theme/)) implements the **Gallery** page and how **loading / performance** patterns are applied in code.

For the house style used on other client handoffs (section structure, “How To” tone), see the temporary reference folder [`handoff-documents/`](../handoff-documents/).

## Documents

| Topic | File |
|--------|------|
| CPT, taxonomies, PHP query payload, SSR markup | [gallery-overview-and-data-model.md](./gallery-overview-and-data-model.md) |
| Filter tabs, `admin-ajax`, Show More, state machine | [gallery-filters-ajax-show-more.md](./gallery-filters-ajax-show-more.md) |
| Custom lightbox, static galleries, CSS, enqueue | [gallery-lightbox-and-static-galleries.md](./gallery-lightbox-and-static-galleries.md) |
| Front-end loading techniques (evidence-based) | [performance-and-loading.md](./performance-and-loading.md) |

## Theme entry points

- **Functions / CPT / AJAX hooks:** [`stardance-theme/functions.php`](../stardance-theme/functions.php)
- **Shared renderers:** [`stardance-theme/inc/components.php`](../stardance-theme/inc/components.php)
- **Gallery page template:** [`stardance-theme/page-gallery.php`](../stardance-theme/page-gallery.php)
- **Gallery + lightbox JS:** [`stardance-theme/assets/js/gallery.js`](../stardance-theme/assets/js/gallery.js)
