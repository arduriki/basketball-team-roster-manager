# Phase 5: Update & Delete — What I Learned

## The Big Picture

**Goal:** Complete the CRUD cycle by adding the ability to edit and delete players.

---

## Key Concepts

### 1. The Full CRUD Cycle

| Operation | SQL Statement | HTTP Method | File |
|-----------|---------------|-------------|------|
| **C**reate | `INSERT INTO` | POST | `add-player.php` |
| **R**ead | `SELECT` | GET | `index.php`, `player.php` |
| **U**pdate | `UPDATE ... SET ... WHERE` | POST | `edit-player.php` |
| **D**elete | `DELETE FROM ... WHERE` | POST | `player.php` |

CRUD is the foundation of almost every web application — social media, e-commerce, email, etc.

### 2. UPDATE Query

```sql
UPDATE players SET name = :name, number = :number, position = :position WHERE id = :id
```

- `SET` — which columns to change and their new values
- `WHERE` — which row(s) to update (always include this, or you'll update ALL rows!)

### 3. DELETE Query

```sql
DELETE FROM players WHERE id = :id
```

- **Always include `WHERE`** — without it, you'll delete ALL rows!
- Always use prepared statements — same security rules as INSERT/UPDATE

### 4. Pre-filling Forms with Existing Data

Use the `value` attribute to show current data in form inputs:

```html
<input type="text" name="player_name" value="<?= $player['name'] ?>">
<input type="number" name="player_number" value="<?= $player['number'] ?>">
```

### 5. Hidden Inputs

Pass data the user shouldn't modify but the server needs:

```html
<input type="hidden" name="player_id" value="<?= $player['id'] ?>">
```

- Invisible to the user in the browser
- Sent with the form data via `$_POST`
- Useful for carrying IDs in update/delete operations

### 6. GET and POST in the Same Request

A form can send POST data while the URL carries GET parameters — they're independent:

```html
<form action="edit-player.php?id=3" method="post">
```

- `$_GET['id']` → `3` (from the URL)
- `$_POST['player_name']` → form field value (from the body)

### 7. HTML Forms Only Support GET and POST

- In REST theory: `PUT` for updates, `DELETE` for deletions
- In HTML reality: forms only support `GET` and `POST`
- Solution: use `POST` for both updates and deletions
- Laravel solves this with **method spoofing** — a hidden field that tells the framework the intended method

### 8. Confirmation Before Destructive Actions

Use JavaScript's `confirm()` for a simple browser dialog:

```html
<input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
```

- `confirm()` shows an OK/Cancel popup
- Returns `true` (OK) → form submits
- Returns `false` (Cancel) → form does NOT submit

### 9. Redirect After Data Changes

After creating, updating, or deleting data, redirect the user:

```php
header('Location: index.php');
die();
```

- Prevents the user from seeing a broken or empty page
- Prevents accidental re-submission if the user refreshes

### 10. Code Organization with Functions (DRY Principle)

**DRY = Don't Repeat Yourself.** Extract repeated logic into reusable functions:

```php
// functions.php
function getId()
{
    if (!isset($_GET['id'])) {
        header('Location: index.php');
        exit;
    } else {
        return $_GET['id'];
    }
}

function checkIdPlayer($pdo, $id)
{
    $stmt = $pdo->prepare("SELECT * FROM players WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
```

Both `player.php` and `edit-player.php` use these same functions instead of duplicating code.

---

## The Edit Pattern (Two-Step Page)

A page that handles both displaying and processing:

```php
<?php
// Step 1: Handle POST (form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update the database
    // Redirect or show confirmation
    die();
}

// Step 2: Handle GET (page load)
// Fetch data and display pre-filled form
?>
```

This pattern puts POST handling **before** GET handling — so redirects and `die()` prevent the form from rendering after submission.

---

## What I Built

**edit-player.php:**

- Fetches player data and displays a pre-filled form (GET)
- Updates the player in the database (POST)
- Uses hidden input to carry the player ID

**player.php updates:**

- Added delete form with hidden input and confirmation dialog
- Handles DELETE via POST, redirects to roster after deletion
- Edit link inside the `else` block (only shows when player exists)

**functions.php (new file):**

- `getId()` — validates and returns the ID from `$_GET`
- `checkIdPlayer()` — fetches a single player by ID
- Used by both `player.php` and `edit-player.php`

---

## Project Structure (Updated)

```
index.php          — Roster list (Read all)
add-player.php     — Add new player (Create)
player.php         — Player detail + Delete
edit-player.php    — Edit player (Update)
database.php       — PDO connection
functions.php      — Shared helper functions
docker-compose.yml — MySQL container
lessons/           — Learning notes
```

---

## CRUD Complete

All four operations are working with prepared statements and proper security. This is the foundation of almost every web application — and exactly what Laravel's Resource Controllers automate.

---

## Looking Ahead: Phase 6

Next, we'll polish the app:

- Client-side form validation with vanilla JavaScript
- Simple interactivity (sort/filter players)
- Basic CSS styling to make it readable

---

*Date completed: February 2026*
