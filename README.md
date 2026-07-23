# laravel-subdirectory-migrations

A super simple Laravel package that changes the migration discovery logic to automatically include all subdirectories under every registered migration path.

## Installation

```bash
composer require misakstvanu/laravel-subdirectory-migrations
```

The package auto-discovers itself via Laravel's package discovery, so no manual provider registration is needed.

## Usage

Organise your migrations into subdirectories however you like — the package will find them all automatically:

```
database/
└── migrations/
    ├── 2024_01_01_000000_create_users_table.php
    ├── orders/
    │   ├── 2024_02_01_000000_create_orders_table.php
    │   └── 2024_02_02_000000_create_order_items_table.php
    └── payments/
        └── 2024_03_01_000000_create_payments_table.php
```

Run migrations as normal:

```bash
php artisan migrate
```

All migration commands (`migrate`, `migrate:rollback`, `migrate:status`, `migrate:fresh`, etc.) will automatically pick up migrations in subdirectories.

## How it works

The package replaces Laravel's default `Migrator` with a thin subclass (`SubdirectoryMigrator`) that overrides `getMigrationFiles()`. Before delegating to the original implementation, it recursively expands every registered migration path to include all of its subdirectories. No configuration required.

## License

MIT
