# Module 6: Laravel Database Layer

The original customer and user pages now query SQLite via Eloquent models, rather than controller static arrays. Existing layouts and styling are preserved. The 13 original customers and 6 original staff accounts are seeded.

## First-time setup

1. Install PHP, Composer, and the PHP SQLite extension.
2. Run `composer install`.
3. Copy `.env.example` to `.env` (Windows: `copy .env.example .env`; macOS/Linux: `cp .env.example .env`).
4. Run `php artisan key:generate`.
5. Create `database/database.sqlite` if it does not exist (empty file).
6. Run `php artisan migrate --seed`.
7. Run `php artisan serve` and visit the Customers and Users pages.

For an already initialized project, run `php artisan migrate --seed` (do not run `migrate:fresh` unless you want to delete existing database data).

## Rubric mapping

1. Customers table includes full_name, email, phone. Existing users table is extended with unique username and full_name. Additional columns preserve original POS display; Laravel's default auth fields remain.
2. DatabaseSeeder seeds 13 customers and 6 staff users, idempotently by email.
3. Customer and User are Eloquent models.
4. CustomerController and UserController call `Model::orderBy('id')->get()`.
5. Blade tables read model attributes and retain the original design.

## Notes

- `username` and `full_name` are nullable in the upgrade migration to support pre-existing Laravel users. Seeded staff have both fields populated. If your professor requires non-null columns for every user, you can enforce this after migrating existing user records.
- Extra POS display columns (joined, orders, spent, status, role, last_active) are sample data, not calculated from a sales/orders system.
- Seeded staff passwords use the demonstration-only value `ChangeMe123!` and Laravel hashes it via the User model. Change passwords before deploying. Never use demo credentials in production.
- If an old user row lacks `full_name`, the users page will still render, but that row's display name will be blank until updated.
