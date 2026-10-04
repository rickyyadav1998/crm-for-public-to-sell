# Self-Hosted CRM

A low-cost, self-hosted CRM designed for PHP 8.2+ and MySQL/MariaDB shared hosting.

## Architecture

- Laravel 12
- PHP 8.2+
- MySQL / MariaDB
- Blade-first frontend
- Database-backed CRM
- PWA and integrations will be added in later phases
- One installation = one company/workspace

## Development setup

1. Install PHP 8.2+, Composer and MySQL.
2. Copy `.env.example` to `.env`.
3. Set the MySQL credentials in `.env`.
4. Run `composer install`.
5. Run `php artisan key:generate`.
6. Run `php artisan migrate --seed` after the seed system is added.
7. Point the web server document root to the `public/` directory.

## Shared hosting

The production web root should point to `public/`. Keep `.env`, `app/`, `config/`, `database/` and `vendor/` outside the public web root when the hosting provider allows it.

The standalone `database/schema.sql` is also available for manual MySQL import.

## Build roadmap

1. Database + Laravel foundation
2. Authentication and roles
3. Leads CRUD
4. Contacts and companies
5. Deals and pipeline
6. Tasks and follow-ups
7. Forms, webhooks and API
8. Integrations
9. PWA + push notifications
10. Self-service installer
11. Central license / telemetry control panel
