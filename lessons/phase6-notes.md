# Phase 6: Polish & JavaScript — What I Learned

## The Big Picture

**Goal:** Add client-side form validation with JavaScript and basic CSS styling.

---

## Key Concepts

### 1. JavaScript vs PHP — Where They Run

| | PHP | JavaScript |
|---|-----|-----------|
| **Runs on** | Server | Browser (client) |
| **Changes are** | Permanent (database, files) | Temporary (only in browser memory) |
| **When it runs** | Before the page is sent | After the page is received |
| **Purpose** | Generate HTML, handle data | React to user actions, improve UX |

**Analogy:** PHP is the kitchen that prepares the meal. JavaScript is the waiter who adjusts things at your table without going back to the kitchen.

### 2. Selecting Elements with JavaScript

Use `document.querySelector()` to find HTML elements:

```js
// By tag name
document.querySelector("h1")

// By input name attribute
document.querySelector('input[name="player_name"]')

// Get the value of an input
document.querySelector('input[name="player_name"]').value
```

### 3. Client-Side Form Validation

A function that checks input before the form submits:

```js
function validateForm() {
    var name = document.querySelector('input[name="player_name"]').value;
    var number = document.querySelector('input[name="player_number"]').value;
    var position = document.querySelector('input[name="player_position"]').value;

    if (name === "" || number === "" || position === "") {
        alert("Can't leave an empty field");
        return false;  // stops the form
    }
    return true;  // allows the form to submit
}
```

**Connect it to the form:**
```html
<form onsubmit="return validateForm()">
```

- `return` is critical — without it, the form ignores the function's result
- `return false` → form does NOT submit
- `return true` → form submits normally

### 4. Linking JavaScript Files

```html
<script src="validation.js"></script>
```

- Place before `</body>` (so HTML loads first)
- One file can be shared across multiple pages
- Same concept as `style.css` — write once, use everywhere

### 5. Strict Equality in JavaScript (`===` vs `==`)

```js
"5" == 5    // true — == converts types (loose)
"5" === 5   // false — === checks value AND type (strict)
```

**Always prefer `===`** to avoid unexpected type conversion bugs.

### 6. Client-Side vs Server-Side Validation

- **Client-side (JavaScript):** Fast, instant feedback, better user experience
- **Server-side (PHP):** Secure, cannot be bypassed
- **Always do both!** JavaScript can be disabled or bypassed by tech-savvy users

### 7. CSS — Three Ways to Add Styles

| Method | Where | Shared? | Use when |
|--------|-------|---------|----------|
| **Inline** | `style=""` on elements | No | Quick one-off tweaks |
| **Internal** | `<style>` in `<head>` | No | Single-page styles |
| **External** | `<link href="style.css">` | Yes ✅ | Real applications |

**External is the standard** — one file, all pages styled consistently.

### 8. Basic CSS Layout

```css
body {
    max-width: 800px;      /* limit width for readability */
    margin: 0 auto;        /* center on page */
    padding: 50px;         /* space from edges */
    text-align: center;
    font-family: "Happy Monkey", system-ui;
}
```

- `max-width` — content never wider than this
- `margin: 0 auto` — zero top/bottom, automatic (equal) left/right = centered
- `system-ui` — fallback font if Google Font doesn't load

### 9. Google Fonts

Import custom fonts from Google:

```css
@import url('https://fonts.googleapis.com/css2?family=Happy+Monkey&display=swap');
```

Then use in `font-family`:
```css
font-family: "Happy Monkey", system-ui;
```

---

## What I Built

**validation.js:**
- `validateForm()` function that checks all three form fields
- Shared between `add-player.php` and `edit-player.php`
- Returns `false` to prevent submission if any field is empty

**style.css:**
- Google Font import ("Happy Monkey")
- Centered layout with max-width and padding
- Linked to all PHP pages via `<link rel="stylesheet">`

---

## Files Changed

- **add-player.php** — added `onsubmit`, linked `validation.js` and `style.css`
- **edit-player.php** — added `onsubmit`, linked `validation.js` and `style.css`, moved PHP inside `<body>`
- **player.php** — linked `style.css`
- **index.php** — linked `style.css`

---

## Looking Ahead: Phase 7

Final phase! We'll review the full codebase together, discuss what was painful, what was repetitive, and understand why frameworks like Laravel exist.

---

*Date completed: February 2026*
