# Phase 2: Database — What I Learned

## The Big Picture

**Goal:** Connect PHP to a MySQL database and fetch players dynamically instead of hardcoding them.

---

## Key Concepts

### 1. Docker for Development

Docker runs applications in isolated **containers** — like lightweight virtual machines.

**Commands:**
```bash
docker compose up -d     # Start containers in background
docker compose ps        # Check running containers
docker compose down      # Stop containers
docker exec -it basketball_db mysql -u root -p   # Connect to MySQL inside container
```

**docker-compose.yml** defines what containers to run and how to configure them.

### 2. SQL Basics

SQL (Structured Query Language) is how you talk to databases.

**Select a database:**
```sql
USE basketball_roster;
```

**Create a table:**
```sql
CREATE TABLE IF NOT EXISTS players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    number INT NOT NULL,
    position VARCHAR(100) NOT NULL
);
```

- `AUTO_INCREMENT` — MySQL generates unique IDs automatically
- `PRIMARY KEY` — the unique identifier for each row
- `NOT NULL` — this column must have a value (a constraint)
- `IF NOT EXISTS` — safe to run multiple times without errors

**Insert data:**
```sql
INSERT INTO players (name, number, position)
VALUES
    ('Player 1', 10, 'Guard'),
    ('Player 2', 23, 'Forward');
```

**Fetch data:**
```sql
SELECT * FROM players;
```

**Inspect table structure:**
```sql
SHOW COLUMNS FROM players;
```

### 3. PDO (PHP Data Objects)

PDO is PHP's modern, secure way to connect to databases.

**Connecting:**
```php
$dsn = "mysql:host=127.0.0.1;port=3306;dbname=basketball_roster";
$username = "root";
$password = "secret";

$pdo = new PDO($dsn, $username, $password);
```

- **DSN** (Data Source Name) — tells PDO where and what the database is
- `new PDO(...)` — creates a connection object

**Running queries:**
```php
$result = $pdo->query("SELECT * FROM players");
$players = $result->fetchAll(PDO::FETCH_ASSOC);
```

- `->query()` — runs SQL and returns a PDOStatement object
- `->fetchAll()` — gets all rows as a PHP array
- `PDO::FETCH_ASSOC` — return only named keys (not numeric indexes)

### 4. Object-Oriented Programming (OOP) Preview

- A **class** is a blueprint (like `PDO` or `PDOStatement`)
- An **object/instance** is a specific thing created from that blueprint
- `new ClassName()` creates an instance
- `->method()` calls a function on that object

```php
$pdo = new PDO(...);        // $pdo is an instance of the PDO class
$result = $pdo->query(...); // calling the query() method on $pdo
```

### 5. Including Files with `require`

```php
require 'database.php';
```

- Includes another PHP file — like copy-pasting its code at that spot
- Variables defined in the required file become available
- `require` stops the script if the file is missing (use for critical files)
- `include` continues with a warning if missing (use for optional files)

---

## What I Built

- **docker-compose.yml** — defines MySQL container
- **database.php** — connects to MySQL and fetches players into `$players`
- **index.php** — requires database.php and displays players from the database

**The flow:**
1. `index.php` requires `database.php`
2. `database.php` connects to MySQL and runs `SELECT * FROM players`
3. Results go into `$players` array
4. `index.php` loops through `$players` and renders HTML

---

## Commands Learned

```bash
# Docker
docker compose up -d          # Start MySQL container
docker compose ps             # Check status
docker compose down           # Stop container
docker exec -it basketball_db mysql -u root -p   # MySQL shell

# PHP
php -S localhost:8000         # Start dev server
php database.php              # Run PHP file directly (for testing)
```

---

## Key Insight

The data structure from `fetchAll(PDO::FETCH_ASSOC)` is **identical** to the hardcoded array from Phase 1 — an array of associative arrays. This is why learning to build it by hand first was valuable!

---

## Looking Ahead: Phase 3

Next, we'll build an HTML form to **add new players** from the browser — no more needing to type SQL manually. This involves:
- HTML forms and the `POST` method
- Receiving form data in PHP with `$_POST`
- Inserting into the database safely (prepared statements)

---

*Date completed: February 2025*
