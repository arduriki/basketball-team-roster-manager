# 🏀 Basketball Roster Manager

A vanilla PHP + JavaScript + MySQL web app built from scratch as a hands-on learning project.

## What is this?

This is a simple CRUD application for managing a basketball team roster — adding players, viewing details, editing, and deleting. Nothing fancy, and that's the point.

The goal isn't the app itself. The goal is to **learn web development fundamentals by building something real**, without frameworks hiding what's actually happening under the hood.

## Why vanilla?

No Laravel, no React, no Tailwind, no Composer. Just raw PHP, plain JavaScript, handwritten SQL, and basic CSS. Every line of code exists because I wrote it and (hopefully) understand why it's there.

This project is a stepping stone toward full-stack development with Laravel. By doing things the hard way first, the framework will make a lot more sense later.

## Tech stack

- **PHP** — backend logic, routing, HTML rendering
- **MySQL** — data storage
- **PDO** — database connection (prepared statements, no shortcuts)
- **HTML/CSS** — structure and styling
- **JavaScript** — client-side interactivity
- **PHP built-in server** — `php -S localhost:8000`

## Learning approach

This project is built progressively in phases, guided by Claude Code acting as a teacher and mentor (see `CLAUDE.md`):

1. **Foundation** — PHP generating HTML, understanding the request/response cycle
2. **Database** — MySQL setup, connecting with PDO, fetching data
3. **Create** — HTML forms, POST requests, inserting data safely
4. **Read & Detail** — Individual pages, query parameters, basic routing
5. **Update & Delete** — Edit forms, delete flows, full CRUD
6. **Polish** — Client-side validation, interactivity with vanilla JS, basic styling
7. **Reflection** — Reviewing pain points and understanding why frameworks exist

## Getting started

### Requirements

- PHP 8.x
- MySQL 8.x
- A terminal and a text editor

### Run it

```bash
# Clone the repo
git clone https://github.com/YOUR_USERNAME/basketball-roster-manager.git
cd basketball-roster-manager

# Start the PHP development server
php -S localhost:8000

# Open in your browser
# http://localhost:8000
```

### Database setup

This project uses Docker to run MySQL:

```bash
# Start MySQL container
docker compose up -d

# Verify it's running
docker compose ps
```

Then connect to MySQL and create the players table:

```bash
# Connect to MySQL (password: secret)
docker exec -it basketball_db mysql -u root -p
```

```sql
USE basketball_roster;

CREATE TABLE IF NOT EXISTS players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    number INT NOT NULL,
    position VARCHAR(100) NOT NULL
);
```

## Status

✅ Phase 1 — Foundation (complete)
✅ Phase 2 — Database (complete)
✅ Phase 3 — Create (complete)
✅ Phase 4 — Read & Detail (complete)
✅ Phase 5 — Update & Delete (complete)
✅ Phase 6 — Polish & JavaScript (complete)
✅ Phase 7 — Reflection (complete)

**Project complete!** Next step: Laravel.

## What I learned

This project taught me the fundamentals that frameworks automate:

- **PHP** — superglobals, request handling, server-side logic
- **MySQL + PDO** — CRUD queries with prepared statements
- **HTML forms** — GET/POST, form handling, hidden inputs
- **JavaScript** — DOM manipulation, client-side validation
- **CSS** — external stylesheets, layout basics
- **Security** — SQL injection prevention, input validation
- **Docker** — containerized development environment

Every pain point I experienced (repetitive HTML, raw SQL, manual routing, hardcoded credentials) has a direct solution in Laravel — and now I understand *why* those solutions exist.

## License

MIT
