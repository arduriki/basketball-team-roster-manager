# Phase 3: Create — What I Learned

## The Big Picture

**Goal:** Build an HTML form to add new players from the browser, safely inserting data into the database.

---

## Key Concepts

### 1. HTML Forms

Forms collect user input and send it to the server.

```html
<form method="POST" action="add-player.php">
    <label for="player_name">Full name</label><br>
    <input type="text" name="player_name"><br>

    <label for="player_number">Number</label><br>
    <input type="number" name="player_number"><br>

    <input type="submit" value="Add Player">
</form>
```

**Key attributes:**
- `method` — how to send data (GET or POST)
- `action` — where to send the data (which PHP file)
- `name` — on inputs, this is the key PHP uses to access the value

### 2. Form Attributes Explained

| Attribute | Used on | Purpose |
|-----------|---------|---------|
| `name` | `<input>` | Identifies the data sent to PHP — **required for PHP** |
| `id` | Any element | Unique identifier for CSS/JavaScript |
| `for` | `<label>` | Connects label to an input's `id` (clicking label focuses input) |

**For PHP, only `name` matters!**

### 3. GET vs POST

| Method | Data sent via | Visible in URL? | Use for |
|--------|---------------|-----------------|---------|
| GET | URL query string (`?name=value`) | Yes | Searching, filtering, bookmarkable pages |
| POST | Request body | No | Creating, updating, deleting data |

**Rule:** Use POST when you're changing data on the server.

### 4. Receiving Form Data in PHP

When a form is submitted via POST, data is available in the `$_POST` superglobal:

```php
$_POST['player_name']      // value from the input with name="player_name"
$_POST['player_number']    // value from the input with name="player_number"
```

**Check if form was submitted:**
```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // form was submitted
}
```

### 5. SQL Injection — The Danger

**NEVER put user input directly in SQL:**

```php
// ⚠️ DANGEROUS - DON'T DO THIS!
$pdo->query("INSERT INTO players (name) VALUES ('{$_POST['player_name']}')");
```

A malicious user could input:
```
'); DELETE FROM players; --
```

This would delete all your data!

### 6. Prepared Statements — The Safe Way

Separate the SQL structure from the values:

**Positional placeholders (`?`):**
```php
$stmt = $pdo->prepare("INSERT INTO players (name, number, position) VALUES (?, ?, ?)");
$stmt->execute([$name, $number, $position]);
```

**Named placeholders (`:name`) — more readable:**
```php
$stmt = $pdo->prepare("INSERT INTO players (name, number, position) VALUES (:name, :number, :position)");
$stmt->execute([
    'name' => $_POST['player_name'],
    'number' => $_POST['player_number'],
    'position' => $_POST['player_position']
]);
```

**Why it's safe:** The database knows the values are data, not SQL commands. It escapes them automatically.

### 7. Superglobals

PHP has special arrays available everywhere:

| Variable | Contains |
|----------|----------|
| `$_POST` | Data from POST requests (forms) |
| `$_GET` | Data from URL query strings |
| `$_SERVER` | Server and request information |

---

## What I Built

**add-player.php:**
- HTML form with inputs for name, number, position
- PHP code that checks for POST submission
- Prepared statement to safely insert into database
- Success message and link back to roster

**index.php updates:**
- Added link to the add player form

---

## The Code Pattern

```php
<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO players (name, number, position) VALUES (:name, :number, :position)");
    $stmt->execute([
        'name' => $_POST['player_name'],
        'number' => $_POST['player_number'],
        'position' => $_POST['player_position']
    ]);
    echo "Player added!";
    echo '<p><a href="index.php">← Back to roster</a></p>';
}
?>
<!DOCTYPE html>
<!-- form HTML here -->
```

---

## CRUD Progress

- **C**reate — ✅ `add-player.php`
- **R**ead — ✅ `index.php`
- **U**pdate — Phase 5
- **D**elete — Phase 5

---

## Security Lesson

> **Always use prepared statements when working with user input.** No exceptions. Even if you think the input is "safe" — treat all user input as potentially malicious.

---

## Looking Ahead: Phase 4

Next, we'll create individual player detail pages using URL parameters:
- `player.php?id=3` — shows player with ID 3
- Learning to read `$_GET` parameters
- Fetching a single record from the database

---

*Date completed: February 2025*
