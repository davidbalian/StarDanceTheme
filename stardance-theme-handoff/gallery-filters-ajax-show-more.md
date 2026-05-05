# Gallery: filters, AJAX, and Show More

How the Gallery page **filter tabs** and **Show More** button talk to WordPress **`admin-ajax.php`**, how the client **state** stays in sync, and how **replace vs append** updates the DOM.

---

## DOM hooks (from `page-gallery.php`)

| Hook / selector | Role |
|-----------------|------|
| `[data-gallery-grid]` | Container whose `innerHTML` is replaced on filter change, or appended on “show more”. |
| `[data-gallery-show-more]` | Button shown when `has_more` is true; `hidden` when no further pages. |
| `.sd-gallery-page__tab` | Filter tab; must expose **`data-filter-group`** and **`data-filter-value`**. |

**`data-filter-group`** must match keys on the JS `state` object:

- `gallery_year`
- `gallery_type`

**`data-filter-value`** is either `all` or a **term slug** (from the PHP loop in `page-gallery.php`).

Tabs use **`aria-pressed`** toggled in JS; filter groups use **`role="group"`** with `aria-label` in the template.

---

## Server: AJAX action

| Item | Value |
|------|--------|
| **Action** | `stardance_filter_gallery` |
| **Nonce** | `stardance_gallery_nonce` (checked in `stardance_filter_gallery()`) |
| **Handlers** | `wp_ajax_*` and `wp_ajax_nopriv_*` on `stardance_filter_gallery` |

**Handler implementation:** `stardance_filter_gallery()` in `stardance-theme/functions.php` reads POST fields:

- `gallery_year`, `gallery_type` (sanitized text)
- `posts_per_page` (int, minimum 1)
- `paged` (int, minimum 1)
- passes **`animate` => false** into `stardance_get_gallery_query_payload()`

Response: `wp_send_json_success()` with `markup`, `has_more`, `max_pages`, `found_posts`.

---

## Client configuration

Script handle **`stardance-gallery`** is localized as **`stardanceGallery`** in `stardance_enqueue_assets()` (`functions.php`):

- `ajaxurl` — `admin_url( 'admin-ajax.php' )`
- `nonce` — `wp_create_nonce( 'stardance_gallery_nonce' )`
- `lightboxArrowUrl` — optional SVG for lightbox arrows (used elsewhere; see companion doc)

---

## JavaScript state (`assets/js/gallery.js`)

Only runs the gallery-page block if **`[data-gallery-grid]`** exists.

```text
state = {
  gallery_year: 'all',
  gallery_type: 'all',
  paged: 1,
  posts_per_page: 12
}
```

- **Filter tab click:** `updateActiveTab()` copies `data-filter-group` / `data-filter-value` into `state`, sets **`state.paged = 1`**, toggles `.is-active` and `aria-pressed`, then calls **`fetchFilteredGallery()`** without append mode (full replace).

- **Show More button click:** increments **`state.paged`** before **`fetchFilteredGallery({ append: true })`**.

**`fetchFilteredGallery(options)`:**

- Builds `FormData` with `action`, `nonce`, filter fields, `paged`, `posts_per_page`.
- POSTs via **`fetch(stardanceGallery.ajaxurl, { method: 'POST', body: formData })`**.
- Expects `{ success, data: { markup, has_more } }`.
- **`append` false:** sets `galleryGrid.innerHTML = payload.data.markup`.
- **`append` true:** if `markup.trim()` is non-empty, **`insertAdjacentHTML('beforeend', markup)`**.
- **`[data-gallery-show-more]`:** `hidden` set from **`!payload.data.has_more`** after a successful parse.

**Failure:** logs to console; when append fails, callers may revert `paged` — see **`loadMoreGallery()`** (used by the lightbox).

**UX:** While loading, the grid gets **`.is-loading`** and the show-more button is **disabled**; both cleared in `finally`.

---

## Replace vs append (summary)

| User action | `state.paged` | DOM update |
|-------------|---------------|------------|
| Change year or type | Reset to **1** | Replace grid `innerHTML` |
| Show More | Increment, then fetch | Append to grid |
| Lightbox “next” at last slide | Increment inside `loadMoreGallery` | Append via AJAX, then extend slide array in JS |

---

## Relation to SSR

Initial HTML is produced by **`stardance_get_gallery_query_payload()`** with **`animate` => true** (default inside the payload function’s `wp_parse_args`), so first paint gets **`fade-in fade-in-delay-N`** up to delay index 10. AJAX uses **`animate` => false** so those classes are omitted for injected markup.

Full item rendering rules are documented in [gallery-overview-and-data-model.md](./gallery-overview-and-data-model.md).

---

## Styling cues

Gallery page chrome (filters, grid, loading) lives in **`stardance-theme/assets/css/pages/gallery.css`**.

---

## Related documentation

- [gallery-overview-and-data-model.md](./gallery-overview-and-data-model.md) — PHP payload and `stardance_render_gallery_item`
- [gallery-lightbox-and-static-galleries.md](./gallery-lightbox-and-static-galleries.md) — `loadMoreGallery` and lightbox integration
