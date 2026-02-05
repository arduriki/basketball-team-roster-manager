# The Request-Response Cycle

Think of it like ordering food at a restaurant:

1. You (browser) ask for something → "I want the menu" (this is called an HTTP request)
2. The waiter (web server) receives your order and goes to the kitchen
3. The kitchen (PHP) prepares the dish — it generates the HTML
4. The waiter brings the dish back → the browser receives HTML (this is the HTTP response)

The key insight: PHP runs on the server and finishes its work before anything reaches the browser. The browser never sees PHP code — it only sees the HTML that PHP produced.

---

## Importance of PHP

_PHP generates HTML → The server sends HTML → The browser renders HTML_
