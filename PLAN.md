# Plan · Multitenant BNI CRM

## Brief
Multitenant BNI CRM with tenant registration, superadmin management, and core BNI exhibition lead/event features, built on Laravel for consistency with existing Sublimity projects.

## Stack
- Laravel 10.x (PHP 8.2+)
- MySQL 8.0 (tenant-aware database structure)
- Spatie Laravel Multitenancy (v4) for tenant isolation
- Livewire 3 (admin panels, interactive components)
- Tailwind CSS 3 (UI consistency with existing BNI exhibition CRM)
- Laravel Fortify (authentication, password reset)
- ChromePHP (testing, optional)

## Scope
**Functionality**
- Superadmin dashboard: manage all tenants, system settings, global stats
- Tenant registration: public form for new tenant signups, pending superadmin approval
- Role-based access control: superadmin, tenant admin, tenant staff
- Tenant data isolation: full separation of leads, exhibitions, users per tenant
- Core BNI CRM features (migrated from existing bni-exhibition):
  - Lead management (add, edit, delete, filter, business card scanning)
  - Exhibition tracking (create events, manage attendees, check-ins)
  - Reporting (lead counts, exhibition performance per tenant)
- Tenant-specific dashboards: lead stats, exhibition status, staff activity
- Secure authentication: separate superadmin and tenant login flows

**Visuals**
- Match existing BNI exhibition CRM UI/UX conventions (branding, color scheme, layout)
- Superadmin panel: sidebar nav, tenant list table, system health widgets
- Tenant dashboard: lead summary cards, exhibition calendar, quick action buttons
- Responsive design for desktop and tablet use

## Out of Scope
- Mobile native app
- Payment integration for tenant subscription billing
- Advanced ML/analytics features
- Multi-language/internationalization support
- Public-facing exhibition registration portals

## Constraints
- Must use Laravel (consistent with existing Sublimity Laravel projects)
- Full tenant data isolation: no cross-tenant data leaks in queries or storage
- Superadmin credentials stored in `.env` (never hard-coded)
- Follow existing BNI exhibition CRM UI/UX patterns for familiarity
- All new code must include PHPUnit tests for critical paths

## Definition of Done
All GitHub issues in the repo are closed, superadmin can create a tenant, tenant admin can register, and core BNI lead/exhibition features work in isolated tenant context with 0 cross-tenant data leaks.

## Acceptance Criteria
- Superadmin can log in to dedicated `/superadmin` panel with separate credentials
- Superadmin can create, edit, suspend, delete tenants from dashboard
- Public `/register` form allows new tenants to sign up, with status "pending" until superadmin approval
- Tenant admin can log in to tenant-specific `/dashboard` after approval
- Leads created by Tenant A are not visible to Tenant B (verified with 2 test tenants)
- Core lead management (add, edit, delete, filter) works within tenant context
- Exhibition tracking (create, manage attendees, check-ins) works within tenant context
- All PHPUnit tests pass (unit, feature, multitenancy isolation tests)
- 0 JavaScript errors on all dashboards (verified via browser console)

## Verification
- Run `php artisan test` to confirm all tests pass
- Manually verify superadmin can create a test tenant, tenant admin can register
- Create 2 tenants, add a lead in Tenant A, confirm it does not appear in Tenant B dashboard
- Run `browser_console` on all dashboards to confirm 0 JS errors
- Check tenant database isolation: verify each tenant has separate data tables (or prefixed tables per Spatie config)

## Turn Budget
~100 turns for full implementation (lightweight setup: 15-25, medium features: 30-50, full completion: 100)

## References
- Existing BNI Exhibition CRM: https://github.com/SublimitySoftwares-AI/bni-exhibition
- Spatie Laravel Multitenancy docs: https://spatie.be/docs/laravel-multitenancy/v4/introduction
- Laravel Fortify docs: https://laravel.com/docs/10.x/fortify
- Existing BNI CRM wiki: ~/wiki-aperture/ (Laravel Hostinger deployment patterns)

## Risks / Open Questions
- Confirm if tenant isolation should use separate databases per tenant or prefixed tables in single DB (Spatie supports both)
- Confirm if existing BNI exhibition lead/exhibition code can be directly ported or needs refactoring for multitenancy
- Confirm superadmin login should be separate route or role-based within same login flow
