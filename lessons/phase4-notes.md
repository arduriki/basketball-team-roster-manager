# Phase 4: Read & Detail — What I Learned

## The Big Picture

**Goal:** Create individual player detail pages accessible by clicking on a player's name in the roster.

---

## Key Concepts

### 1. URL Query Parameters

Data can be passed through the URL using query parameters:

```
player.php?id=3
player.php?id=3&team=barca    (multiple parameters with &)
```

- `?` starts the query string
- `key=value` pairs pass data
- `&` separates multiple parameters

### 2. `$_GET` Superglobal

PHP reads query parameters from the URL using `$_GET`:

```php
// URL: player.php?id=3
$id = $_GET['id'];  // $id = "3"
```

**All three superglobals compared:**

| Superglobal | Source | Example |
|-------------|--------|---------|
| `$_GET` | URL query parameters | `?id=3` |
| `$_POST` | Form submissions (POST method) | Form data in request body |
| `$_SERVER` | Server/request info | `$_SERVER['REQUEST_METHOD']` |

### 3. `fetch()` vs `fetchAll()`

| Method | Returns | Use when |
|--------|---------|----------|
| `fetchAll(PDO::FETCH_ASSOC)` | Array of all rows | Listing multiple records |
| `fetch(PDO::FETCH_ASSOC)` | Single row (or `false`) | Getting one specific record |

```php
// Fetch one player by ID
$stmt = $pdo->prepare("SELECT * FROM players WHERE id = :id");
$stmt->execute(['id' => $id]);
$player = $stmt->fetch(PDO::FETCH_ASSOC);
```

When no row matches, `fetch()` returns `false`.

### 4. Checking if Parameters Exist with `isset()`

**Always check before accessing `$_GET` keys** — if the key doesn't exist, PHP throws a warning.

```php
// ⚠️ Wrong order — warning happens before the check!
$id = $_GET['id'];
if (!isset($id)) { ... }

// ✅ Correct — check first, then use
if (!isset($_GET['id'])) {
    // handle missing parameter
} else {
    $id = $_GET['id'];
}
```

**Lesson:** Order matters! Check first, use second.

### 5. Redirecting with `header()` and `exit`

```php
header('Location: index.php');
exit;
```

- `header('Location: ...')` — tells the browser to go to a different page
- `exit` — **required!** Stops PHP from continuing to execute the rest of the script
- `exit` and `die()` are aliases — they do the same thing
- They stop the **current script**, not the whole server
- No need for full URLs — `index.php` works fine

### 6. Alternative PHP Template Syntax

When mixing PHP and HTML, use the alternative syntax for cleaner templates:

**Control structures:**

```php
<?php foreach ($items as $item): ?>
    <li><?= $item['name'] ?></li>
<?php endforeach; ?>

<?php if ($condition): ?>
    <p>True!</p>
<?php else: ?>
    <p>False!</p>
<?php endif; ?>
```

**Short echo tags:**

```php
<?= $variable ?>        <!-- same as <?php echo $variable; ?> -->
<?= $player['name'] ?>  <!-- cleaner for template output -->
```

**Why this is better:**

- HTML stays as HTML (editor can highlight it properly)
- Easier to read than `echo "<p>..."` strings
- This is how Laravel's Blade templates work under the hood!

---

## What I Built

**player.php:**

- Reads player ID from URL query parameter (`$_GET['id']`)
- Redirects to roster if no ID provided
- Fetches single player from database with prepared statement
- Shows player details or "Player not found" message
- Link back to roster

**index.php updates:**

- Player names are now clickable links to their detail pages
- Used alternative syntax (`foreach:` / `endforeach`) and short echo tags (`<?= ?>`)

---

## The Code Pattern

```php
<?php
require 'database.php';

// 1. Validate input
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
} else {
    $id = $_GET['id'];
}

// 2. Fetch data
$stmt = $pdo->prepare("SELECT * FROM players WHERE id = :id");
$stmt->execute(['id' => $id]);
$player = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!-- 3. Display -->
<?php if (!$player): ?>
    <p>Player not found</p>
<?php else: ?>
    <p>#<?= $player['number'] ?> - <?= $player['name'] ?></p>
    <p>Position: <?= $player['position'] ?></p>
<?php endif; ?>
```

---

## Security Notes

- **Prepared statements protect against SQL injection**, even with unexpected input like `?id=abc` or `?id='; DROP TABLE players;--`
- **Validate input early** — check if parameters exist with `isset()` before using them
- **Redirect + exit** — always `exit` after `header('Location: ...')` to prevent the rest of the script from running

---

## CRUD Progress

- **C**reate — ✅ `add-player.php`
- **R**ead — ✅ `index.php` (list) + `player.php` (detail)
- **U**pdate — Phase 5
- **D**elete — Phase 5

---

## Looking Ahead: Phase 5

Next, we'll complete CRUD with Update and Delete:

- Edit form pre-filled with existing player data
- Delete with confirmation
- Understanding the full CRUD cycle

---

*Date completed: February 2026*
