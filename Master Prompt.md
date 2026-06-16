# WordPress Theme Development Standards (ACF Flexible Content Architecture)

> This document defines the development standards, architecture, coding conventions, and implementation requirements for all WordPress projects built using ACF Flexible Content.

---

## Core Development Principles

* Follow DRY (Don't Repeat Yourself) principles.
* Improve maintainability and scalability.
* Create reusable components whenever patterns repeat.
* Ensure all code follows WordPress Coding Standards.
* Ensure the final codebase is modular, reusable, and easy to maintain.
* Be clean, maintainable, and production-ready.
* Follow BEM standards for class naming.
* Consider mobile layouts from the **1279px breakpoint and below**.
* Always review existing components before creating new ones.
* Prefer reusable solutions over one-off implementations.

---

# Project Workflow

Before development begins:

1. Review all existing ACF Flexible Content layouts.
2. Identify opportunities to reuse existing layouts.
3. Propose reusable solutions using:

   * Modifier classes
   * Radio buttons
   * Toggle fields
   * Existing components
4. Ask for confirmation before creating new Flexible Content layouts.
5. Ask questions whenever requirements are unclear to avoid rework.

---

# ACF Flexible Content Architecture

## Flexible Row Standards

* Use **ACF Flexible Content** as the primary page builder architecture.
* Every Flexible Content section must contain:

```html
<section class="c-block">
```

* Reuse existing Flexible Content rows whenever possible.
* Do not create new Flexible Content layouts unless the design cannot be achieved using existing layouts and modifiers.

---

# Common Section Settings

Create a reusable **Clone Field Group** named:

## Section Settings

| Field Name    | Type         | Purpose                    |
| ------------- | ------------ | -------------------------- |
| section_id    | Text         | Unique identifier          |
| section_class | Text         | Additional section classes |
| color         | Color Picker | Text color                 |
| bg_color      | Color Picker | Background color           |
| bg_image      | Image        | Background image           |

## Rendering Requirements

Create a single reusable helper/template file that outputs section settings.

Use CSS variables for all section-level styling:

```css
--color
--bg-color
--bg-image
```

Apply these values globally through the shared helper.

---

# ACF Color Picker Palette

Add the following to `functions.php`.

```php
function lsq_acf_input_admin_footer() { ?>
	<script type="text/javascript">
		(function($) {
			acf.add_filter('color_picker_args', function( args, $field ){
				args.palettes = [
					'#667DB7',
					'#5FB77B',
					'#EC8B6B'
				];
				return args;
			});
		})(jQuery);
	</script>
<?php
}
add_action('acf/input/admin_footer', 'lsq_acf_input_admin_footer');
```

Replace the colors with colors actually used within the Figma design.

---

# Typography System

## Requirements

* Create reusable typography utility classes.
* Use `clamp()` for responsive typography.
* Follow a scalable typography system.
* Avoid hardcoded font sizes throughout components.
* Always use typography values from Figma.
* Never assume typography values.

### Example Font Size Utilities

```css
.fs32 {
	font-size: clamp(1.25rem, 0.95rem + 0.5vw, 2rem);
}

.fs18 {
	font-size: clamp(1rem, 0.95rem + 0.25vw, 1.125rem);
}
```

### Font Weight Utilities

```css
.fw-300
.fw-400
.fw-500
.fw-600
.fw-700
.fw-800
```

### Line Height Standards

Use calculations:

```css
line-height: calc(26 / 18);
```

Avoid:

```css
line-height: 26px;
```

---

# Font Family Strategy

Apply typography globally whenever possible.

Only use font-family utility classes when a component differs from the global typography system.

```css
.ff-head,
.h1, h1,
.h2, h2,
.h3, h3,
.h4, h4,
.h5, h5,
.h6, h6 {
	font-family: "Faculty Glyphic", sans-serif;
	font-weight: 400;
}

.ff-body,
body {
	font-family: articulat-cf, sans-serif, "Helvetica Neue", Helvetica, -apple-system, Arial, sans-serif;
	font-weight: 300;
}
```

---

# Layout Standards

## Container Usage

Do not apply left or right padding directly to:

```html
<section>
<header>
<footer>
```

Always wrap content using:

```html
<div class="container">
```

---

## Layout System

### Do Not Use CSS Grid

Use Flexbox only.

Global utility:

```css
.dflex {
	display: flex;
	flex-wrap: wrap;
}
```

Avoid repeating Flexbox declarations throughout components.

---

# Media Standards

## Image Fields

Always configure ACF image fields with:

```text
Return Format: ID
```

Render images using:

```php
wp_get_attachment_image()
```

Use full-size images by default unless otherwise specified.

---

## Media Wrappers

Always wrap:

* Images
* Videos
* Iframes

Inside:

```html
<div class="c-media-wrap">
```

---

# Link Standards

Use ACF Link fields.

Do not create separate:

* URL fields
* Link Text fields

Respect:

```php
target="_blank"
```

when selected by the user.

---

# Button System

## Base Component

```css
.c-button
```

## Variations

```css
.c-button--primary
.c-button--secondary
.c-button--outline
```

### Requirements

* Use modifiers only when styles differ significantly.
* Remove duplicated button styling.
* Keep button styling centralized.

---

## Gravity Forms Integration

Use Gravity Forms hooks to transform submit buttons into:

```html
c-button c-button--submit
```

Ensure generated markup remains identical to Gravity Forms default button structure.

---

# JavaScript Standards

Create:

```text
/assets/js/theme.js
```

Enqueue through WordPress properly.

---

## JavaScript Requirements

Use reusable factory functions for repeated patterns:

Examples:

* Mobile menu toggle
* Mobile submenu toggle
* Accordions
* Tabs

---

## Mobile Submenu Toggle

Use:

```javascript
slideToggle()
```

---

## Accordions

Use:

```javascript
slideToggle()
```

---

## Tabs

Requirements:

* jQuery-based
* Responsive
* Collapsible on mobile

---

# Mobile Navigation Requirements

Breakpoint:

```css
1279px
```

Requirements:

1. Responsive and collapsible.
2. Vertical menu structure.
3. Functional navigation links.
4. Menu overlay when opened.
5. Clicking outside closes menu.
6. Use jQuery `slideToggle()` for submenu functionality.

---

# Site Options vs Flexible Content

Some sections may support content from:

## Page-Level Content

Managed through Flexible Content.

## Site Options

Managed through ACF Options Page.

---

### Content Source Selector
Always mentioned if you think particular ACF flexible row require this kind of functionality. Generally this kind of blocks contains list services, locations etc. But, as mentioned earlier do not assume and clarify if you think for particular section we will require this kind of feature. Create a Radio Button field for the sections where we mention this section should be manage within site options. The user just needt to ACF flexible row to add the row on the page:

```text
Content Source
```

Options:

```text
Page Content
Site Options
```

### Requirements

* Use ACF Conditional Logic.
* Hide page-level fields when Site Options is selected.
* Show page-level fields when Page Content is selected.

When Page Content is selected:
Make sure the content should be managed page level id emprty fields (fallback content should comes from the site options).

```html
page-level-content
```

must be added to the section wrapper.

---

# Animation Standards

Use subtle fade-in animations.

Requirements:

* Smooth transitions.
* Minimal translate movement.
* Professional appearance.
* No excessive motion.

Support:

```css
prefers-reduced-motion
```

---

# Default Template Requirements

Apply theme styling to:

* 404.php
* search.php
* archive.php
* category.php
* tag.php
* author.php

Requirements:

* Follow typography system.
* Use container wrappers.
* Follow reusable component structure.

---

# Utility Classes

```css
.wid-100 {
	max-width: 100%;
	width: 100%;
}

.c-media-wrap {
	position: relative;
	overflow: hidden;
}

.has-overlay:after {
	@extend %abs-cover;
	z-index: 1;
	background: var(--overlay);
}

.has-overlay,
.is-bg {
	@extend %abs-cover;
	z-index: 0;
}

.is-bg {
	img,
	video,
	iframe {
		height: 100%;
		width: 100%;
	}
}

.c-block {
	padding: var(--pt,40px) var(--px,26px) var(--pb,40px);
	color: var(--color,var(--clr-black));
	background: var(--bg-color,var(--clr-white));
}

.c-btn-wrap {
	--gapx: 12px;
	--gapy: 12px;
	--direction: row;
}

header,
footer,
aside,
section,
.c-block {
	padding: var(--pt,40px) var(--px,26px) var(--pb,40px);
}
```

---

# SCSS Mixins

## Visually Hidden

```scss
@mixin visually-hidden {
	clip: rect(0 0 0 0);
	clip-path: inset(50%);
	height: 1px;
	overflow: hidden;
	position: absolute;
	white-space: nowrap;
	width: 1px;
}
```

---

## Line Clamp

```scss
@mixin lineclamp($lines: 4) {
	-webkit-box-orient: vertical;
	-webkit-line-clamp: $lines;
	overflow: hidden;
	display: -webkit-box;
}
```

---

# Global Reset

Use the supplied global reset exactly as provided by project requirements.

---

# Final QA Checklist

Before completing any task verify:

* [ ] DRY principles followed.
* [ ] Reusable architecture used wherever possible.
* [ ] Existing flexible layouts reviewed before creating new ones.
* [ ] BEM naming conventions followed.
* [ ] Typography follows Figma values.
* [ ] No hardcoded font sizes.
* [ ] Responsive behavior verified below 1279px.
* [ ] Accessibility considerations reviewed.
* [ ] WordPress Coding Standards followed.
* [ ] Performance reviewed.
* [ ] Maintainability reviewed.
* [ ] Images use ACF ID return type.
* [ ] Images rendered with `wp_get_attachment_image()`.
* [ ] Media wrapped in `.c-media-wrap`.
* [ ] Links use ACF Link fields.
* [ ] Theme JS centralized in `theme.js`.
* [ ] Default templates styled consistently.
* [ ] Flexible rows use `.c-block`.
* [ ] Site Options / Page Content logic implemented when required.

---

## Development Philosophy

Always prioritize:

**Reusable > Configurable > Maintainable > Scalable**

Avoid creating new components when existing components can be extended using modifiers, settings, or reusable architecture.
