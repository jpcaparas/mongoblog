# Mongoblog

A simple Laravel blog application powered by MongoDB.

## Tests

### Migrations and seeds

1. On `.env`, set the `DB_CONNECTION` directive value to be `testing`. This will use a (non-persistent) in-memory SQLite database, allowing for faster operations.
1. Run `php artisan config:cache` to load `.env` directives into the app configuration. 
1. Run `php artisan migrate:refresh --seed` to run migrations and seed tables with data.
