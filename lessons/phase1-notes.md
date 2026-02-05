# Phase 1: Foundation — What I Learned

## The Big Picture

**Goal:** Create a PHP page that displays a hardcoded list of basketball players.

---

## Key Concepts

### 1. The Request-Response Cycle

When you visit a website:

1. **Browser (client)** sends an HTTP request → "Give me this page"
2. **Web server** receives the request and calls PHP
3. **PHP** runs and generates HTML
4. **Server** sends the HTML back as an HTTP response
5. **Browser** receives and renders the HTML

**Analogy:** Like ordering at a restaurant — you (browser) order, the kitchen (PHP) prepares the dish, the waiter (server) brings you the finished meal. You never see the kitchen.

### 2. PHP Runs on the Server

- PHP code executes **on the server**, not in the browser
- The browser **never sees PHP code** — only the HTML output
- When you "View Page Source" in the browser, you see HTML, not PHP

### 3. Mixing PHP and HTML

In a `.php` file:
- Anything **inside** `<?php ?>` tags is PHP code
- Anything **outside** those tags is sent directly as HTML

```php
<!DOCTYPE html>
<html>
<body>
    <h1>Regular HTML here</h1>

    <?php
    echo "<p>This comes from PHP!</p>";
    ?>
</body>
</html>
```

### 4. Arrays in PHP

**Simple array** (list of values):
```php
$players = ["Player 1", "Player 2", "Player 3"];
```

**Associative array** (key-value pairs):
```php
$player = [
    "name" => "Dario Brizuela",
    "number" => 8,
    "position" => "Guard"
];
// Access with: $player["name"]
```

**Multidimensional array** (array of arrays):
```php
$players = [
    ["name" => "Player 1", "number" => 1],
    ["name" => "Player 2", "number" => 2],
];
```

### 5. Foreach Loops

Iterate over arrays to generate repeated HTML:

```php
foreach ($players as $player) {
    echo "<li>{$player["name"]}</li>";
}
```

- If the array is empty, the loop runs **zero times** (no error!)

### 6. String Interpolation

Embed variables inside double-quoted strings using curly braces:

```php
echo "Player: {$player["name"]}";
```

This is cleaner than concatenation: `"Player: " . $player["name"]`

---

## What I Built

A PHP page (`index.php`) that:
- Displays a basketball roster with player names, numbers, and positions
- Uses an array of associative arrays to store player data
- Uses a foreach loop to generate HTML list items

---

## Commands Learned

Start PHP's built-in development server:
```bash
php -S localhost:8000
```

---

## Looking Ahead: Phase 2

Next, we'll connect to a **real database (MySQL)** so players aren't hardcoded — they'll be stored and retrieved from a database. The multidimensional array structure you learned here is exactly how database results look!

---

*Date completed: February 2025*
