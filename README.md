# Tasks for Today Management System

A Laravel and Blade rebuild of the TSA1 task management System.

## Requirements

- PHP 8.2 or newer
- Composer 2
- SQLite PHP extension

## Setup on Windows

```powershell
composer install
copy .env.example .env
php artisan key:generate
New-Item database\database.sqlite -ItemType File
php artisan migrate:fresh --seed
php artisan serve
```

Open http://127.0.0.1:8000.

Use `php artisan migrate:fresh --seed` only when resetting the local demo database. It recreates the schema and loads eight tasks across four dates plus exactly one user.

## Pages

| URL | Purpose |
| --- | --- |
| `/` | Welcome page showing only today's tasks |
| `/tasks` | Full task list ordered by task date |
| `/profile` | The single seeded user profile |
| `/about` | Static project and developer information |
| `/customers` | Customer directory with create and edit workflows |
| `/users` | Staff directory with create, edit, and avatar upload workflows |

## Application structure

| Responsibility | Location |
| --- | --- |
| Routes | `routes/web.php` |
| Task controller | `app/Http/Controllers/TaskController.php` |
| Page controller | `app/Http/Controllers/PageController.php` |
| Eloquent models | `app/Models/Task.php`, `app/Models/User.php` |
| Migrations | `database/migrations/` |
| Seeder | `database/seeders/DatabaseSeeder.php` |
| Blade views | `resources/views/` |

## Tests

```powershell
php artisan test
```

Use `php artisan storage:link` once before testing avatar display locally. User avatars are
validated as images up to 2 MB, resized to 256x256 JPEG thumbnails with Intervention Image,
and stored on Laravel's public disk.

## Authentication

Laravel Breeze provides the `/login` and `/register` pages. Customer and user
account management is protected by the `auth` middleware, so guests are
redirected to login. Run `npm install` and `npm run build` when setting up the
Breeze frontend assets.

## Deploy on Render

This repository includes `Dockerfile` and `render.yaml` for deployment. Push the project to GitHub, then in Render choose **New → Blueprint**, select the repository, and apply the blueprint. Render will build the Docker image and provide a public `onrender.com` URL.

The free service uses SQLite inside the container, so seeded demo data can reset when the service is redeployed or restarted. That is acceptable for a classroom demonstration; use a persistent disk or a hosted database if data must survive restarts.
