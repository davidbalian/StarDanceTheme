# Gallery: lightbox and static galleries

The Star Dance theme ships **one** script, **`stardance-theme/assets/js/gallery.js`**, that powers:

1. **Inline “static” galleries** elsewhere on the site (delegated clicks inside `[data-gallery-lightbox]`).
2. The **Gallery page** grid (`[data-gallery-grid]`) with a **custom overlay lightbox** that can **prefetch the next page** via the same AJAX pipeline as **Show More**.

Project rule: **no third-party lightbox libraries** — see `stardance-theme/CLAUDE.md`.

---

## Static galleries (`[data-gallery-lightbox]`)

**Markup pattern:** a container with **`data-gallery-lightbox`** wrapping anchor tags that each contain an **`img`**.

**Example:** `stardance-theme/template-parts/gallery.php` — portrait and landscape rows link to full JPEGs; thumbnails may use smaller derivatives.

**Behavior:**

- Click delegation on the container.
- If the click target is inside **`[data-gallery-lightbox-open]`**, the handler opens the lightbox at **slide 0** using **all** `a[href]` descendants that contain an `img`.
- Otherwise, if the click resolves to an **`a[href]`** with a nested **`img`**, navigation opens at that link’s index among the same filtered link list.
- **`preventDefault()`** stops normal navigation.

**Limits:** `openLightbox(..., null)` — no `loadMore` callback. The slide list is **whatever is in the DOM** at click time.

---

## Gallery page grid

**Prerequisite:** `[data-gallery-grid]` exists. If it does not, the script returns early after wiring static galleries — the grid block is skipped.

**Triggers:** Clicks on **`.sd-gallery-page__item`** (the `<a>` rendered by `stardance_render_gallery_item()`).

**Slide list:** All **`.sd-gallery-page__item`** elements currently in the grid, in DOM order (includes items added by **Show More** or lightbox-driven append).

**`openLightbox` arguments:**

- **`slides`** — built from each link: `{ src: href, alt: img.alt }` where `src` is the **`full`** image URL (the anchor `href`).
- **`loadMore`** — **`loadMoreGallery`**, which increments **`state.paged`**, calls **`fetchFilteredGallery({ append: true })`**, then maps **new** DOM nodes to slide objects.
- **`hasMore`** — function returning **`showMoreButton && !showMoreButton.hidden`** so the UI knows whether another server page may exist.

---

## Lightbox UX (implementation summary)

**DOM:** The script creates a root **`.sd-lightbox`** appended to `document.body`, with:

- Close control **`.sd-lightbox__close`** (`role` implied via button; overlay uses `role="dialog"` and `aria-modal="true"`).
- **`.sd-lightbox__counter`** — `current / total` text.
- Prev / next **`.sd-lightbox__arrow`** buttons; optional **`<img>`** icons when **`stardanceGallery.lightboxArrowUrl`** is set (same SVG for both; next uses CSS flip in `components.css`).
- **`.sd-lightbox__slider`** / **`.sd-lightbox__track`** / **`.sd-lightbox__slide`** — horizontal strip positioned with **`translateX(-index * 100%)`**.

**Slides:** Each slide’s **`<img>`** gets **`loading = 'lazy'`** (full URL from `href`).

**Navigation:**

- **Prev** disabled at index 0.
- **Next** at the last slide: if **`loadMore`** and **`hasMore()`** are truthy, invokes **`loadMore()`**; on success, new slides are **appended** to the track and the viewer advances with animation. While loading, **`isLoadingMore`** guards double requests.
- **Touch:** simple swipe threshold on overlay (`touchend` vs `touchstart`); triggers prev/next button clicks.
- **Keyboard:** `Escape` closes; left/right arrows simulate button clicks.
- **Click outside:** closing when target is the overlay root or the slider surface (not inner controls — see source for exact targets).

**Scrollbar:** `document.body.style.overflow = 'hidden'` while open; restored on close.

**Single active instance:** `activeLightbox.close()` if a second open is attempted.

---

## CSS

| Area | File |
|------|------|
| Lightbox overlay, arrows, counter, frame | `stardance-theme/assets/css/components.css` — `.sd-lightbox*` |
| Gallery page filters, grid items, page section | `stardance-theme/assets/css/pages/gallery.css` |

---

## Enqueue behavior

| Asset | Condition |
|-------|-----------|
| **`stardance-page-gallery`** stylesheet | `is_page_template('page-gallery.php')` in `stardance_enqueue_assets()` |
| **`stardance-gallery`** script + `stardanceGallery` localization | **Globally** enqueued on every front-end view (same function) |

**Tradeoff:** Gallery JS bytes load on non-gallery pages unless you later split into a conditional enqueue. Localization must remain available on any template that might include `[data-gallery-lightbox]` (for example the homepage).

---

## Coordinating Show More and lightbox

Both paths share **`state`** in `gallery.js`:

- **Show More button:** `state.paged += 1` then `fetchFilteredGallery({ append: true })`.
- **Lightbox `loadMoreGallery`:** same increment + append, but returns a **Promise** resolving to **only the new slides’** data for appending the lightbox track; on failure it decrements **`state.paged`** so server and client stay aligned.

After either path, **`has_more`** from JSON drives **`[data-gallery-show-more]`** visibility.

---

## Related documentation

- [gallery-overview-and-data-model.md](./gallery-overview-and-data-model.md) — thumbnails vs full URLs in markup
- [gallery-filters-ajax-show-more.md](./gallery-filters-ajax-show-more.md) — AJAX fields and `fetchFilteredGallery`
