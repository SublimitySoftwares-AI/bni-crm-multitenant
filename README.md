# BNI CRM Multitenancy

A multitenant CRM system for BNI (Business Network International) chapters, built with Laravel 12, Spatie Multitenancy, Livewire, and Tailwind CSS.

## Features

- **Multi-tenancy**: Each BNI chapter operates as an independent tenant with isolated data
- **Role-Based Access Control**: Roles include superadmin, tenant_admin, and member
- **Lead Management**: Full CRUD with source tracking (exhibition, referral, card_scan, etc.)
- **Exhibition Tracking**: Create exhibitions, manage attendees, check-in functionality
- **Authentication**: Laravel Fortify with email verification and password reset

## Tech Stack

- Laravel 12.x
- PHP 8.2+
- Spatie Laravel Multitenancy v4
- Spatie Laravel Permission
- Laravel Fortify
- Livewire 3.x
- Tailwind CSS 3.x
- MySQL 8.0+

## Installation

```bash
# Clone the repository
git clone https://github.com/SublimitySoftwares-AI/bni-crm-multitenant.git
cd bni-crm-multitenant

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Start the development server
php artisan serve
```

## Architecture

### Database Strategy
- **Landlord database**: tenants, users, roles, permissions (system-wide)
- **Per-tenant databases**: leads, exhibitions, attendees, etc.

### Middleware Stack
1. `EnsureUserIsAuthenticated` - Fortify auth check
2. `NeedsTenant` - Spatie tenant resolution
3. `EnsureTenantIsActive` - Verify tenant is not suspended
4. `EnsureUserIsSuperadmin` / `EnsureUserIsTenantAdmin` - Role checks

## Testing

```bash
php artisan test
```

## License

MIT