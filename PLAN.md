# BNI CRM Multitenancy - Project Plan

## Overview
A multitenant CRM system for BNI (Business Network International) chapters, built with Laravel, Spatie Multitenancy, Livewire, and Tailwind CSS. Each BNI chapter operates as an independent tenant with isolated data.

## Technology Stack
- **Framework**: Laravel 12.x
- **PHP Version**: 8.2+
- **Multitenancy**: Spatie Laravel Multitenancy v4.x
- **Authentication**: Laravel Fortify
- **RBAC**: Spatie Laravel Permission
- **Frontend**: Livewire 3.x + Tailwind CSS 3.x
- **Database**: MySQL 8.0+ (per-tenant databases)

## Features

### 1. Superadmin Panel (Issue #2, #3)
- Tenant creation, management, activation/suspension
- Cross-tenant user management
- Dashboard with system-wide statistics

### 2. Authentication (Issue #9)
- Laravel Fortify for authentication
- Superadmin login → separate admin panel
- Tenant user login → tenant-specific dashboard
- Email verification, password reset

### 3. RBAC (Issue #4)
- Roles: superadmin, tenant_admin, member
- Permissions: manage_tenants, manage_leads, manage_exhibitions, etc.
- Role assignment during tenant/user creation

### 4. Lead Management (Issue #5)
- CRUD operations for leads
- Source tracking (exhibition, referral, card_scan, etc.)
- Search and filter capabilities
- Tenant-isolated data

### 5. Exhibition Management (Issue #6)
- Exhibition CRUD with date ranges
- Attendee management with check-in functionality
- Tenant-isolated exhibitions

### 6. Data Isolation (Issue #7)
- Spatie Multitenancy automatic tenant switching
- Tenant connection trait on all tenant models
- Tests verifying data never leaks between tenants

## Architecture

### Database Strategy
- **Landlord database**: tenants, users, roles, permissions (system-wide)
- **Per-tenant databases**: leads, exhibitions, attendees, etc.

### Middleware Stack
1. `EnsureUserIsAuthenticated` - Fortify auth check
2. `NeedsTenant` - Spatie tenant resolution
3. `EnsureTenantIsActive` - Verify tenant is not suspended
4. `EnsureUserIsSuperadmin` / `EnsureUserIsTenantAdmin` - Role checks

### Route Groups
- `/superadmin/*` - Superadmin-only routes
- `/tenant/*` - Tenant routes (requires tenant context)
- `/` - Public/guest routes

## Directory Structure
```
app/
├── Actions/
│   ├── Fortify/           # Fortify action classes
│   └── Livewire/          # Livewire component actions
├── Http/
│   ├── Controllers/
│   │   ├── Auth/          # Authentication controllers
│   │   ├── Superadmin/    # Superadmin controllers
│   │   └── Tenant/        # Tenant controllers
│   └── Middleware/
├── Models/
│   ├── Lead.php           # Uses UsesTenantConnection
│   ├── Exhibition.php     # Uses UsesTenantConnection
│   ├── Tenant.php         # Spatie tenant model
│   └── User.php           # Extended with roles
├── Providers/
│   ├── FortifyServiceProvider.php
│   └── MultitenancyServiceProvider.php
config/
├── multitenancy.php       # Spatie config
├── fortify.php            # Fortify config
└── auth.php               # Auth guards
database/migrations/
├── *_create_tenants_tables.php
├── *_create_leads_table.php
└── *_create_exhibitions_tables.php
resources/views/
├── auth/                  # Login, register, etc.
├── layouts/               # App, guest layouts
├── superadmin/            # Superadmin views
└── tenant/               # Tenant views (leads, exhibitions)
```

## Acceptance Criteria

### Superadmin
- [ ] Can create new tenants with admin user
- [ ] Can view all tenants with status
- [ ] Can activate/suspend tenants
- [ ] Dashboard shows system-wide stats

### Authentication
- [ ] Users can register and login
- [ ] Superadmin users see superadmin panel
- [ ] Tenant users see tenant dashboard
- [ ] Password reset works

### RBAC
- [ ] Roles can be assigned to users
- [ ] Permissions protect routes
- [ ] Superadmin can manage tenant users

### Leads
- [ ] Tenant users can CRUD their leads
- [ ] Leads are isolated per tenant
- [ ] Search and filter work
- [ ] Source tracking functional

### Exhibitions
- [ ] Tenant users can CRUD exhibitions
- [ ] Attendee management works
- [ ] Check-in functionality works
- [ ] Data isolated per tenant

### Testing
- [ ] Unit tests for models
- [ ] Feature tests for authentication
- [ ] Multitenancy isolation tests
- [ ] Integration tests for CRUD operations

## GitHub Issues
1. Set up Laravel 10.x with Spatie Laravel Multitenancy ✓
2. Build Superadmin dashboard and tenant management
3. Implement tenant registration flow
4. Set up role-based access control (RBAC)
5. Port BNI exhibition lead management to multitenant
6. Port BNI exhibition exhibition tracking to multitenant
7. Implement tenant data isolation verification tests
8. Build tenant-specific dashboards
9. Set up Laravel Fortify authentication (superadmin + tenants)
10. Write PHPUnit tests for all critical paths

## Future Enhancements
- Card scanning with OCR
- Email integration
- Event/meeting management
- Referral tracking
- Analytics dashboard
- API for mobile apps
