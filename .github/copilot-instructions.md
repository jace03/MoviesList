# Copilot Coding Agent Instructions

## Project Overview
This is a **MoviesList** application consisting of:
- **Backend**: Laravel 12 (PHP 8.4) REST API using Doctrine ORM
- **Frontend**: React 19 + TypeScript, built with Vite and styled with Tailwind CSS 4

## Repository Layout
```
/                        ← Laravel backend root
├── app/                 ← PHP application code (Controllers, Models, Repositories, etc.)
├── bootstrap/           ← Laravel bootstrap files
├── config/              ← Laravel config files
├── database/            ← Migrations, seeders, factories
├── public/              ← Web server document root
├── resources/           ← Blade views, raw assets
├── routes/              ← API and web route definitions
├── tests/               ← PHPUnit test suites (Feature + Unit)
├── MovieListFrontEnd/
│   └── frontend/
│       └── src/
│           ├── api/     ← Axios API client functions
│           ├── components/ ← Reusable React components
│           ├── hooks/   ← Custom React hooks
│           ├── pages/   ← Page-level React components
│           └── types/   ← Shared TypeScript type definitions
├── composer.json        ← PHP dependencies
├── package.json         ← JS/TS dependencies
└── vite.config.js       ← Vite bundler config
```

## Development Workflow

### Backend (PHP / Laravel)
- **Install deps**: `composer install`
- **Run dev server**: `composer run dev`
- **Run tests**: `composer test` (wraps `php artisan test`)
- **Lint / format**: `./vendor/bin/pint` (Laravel Pint — PSR-12 style)
- **Entry point**: `artisan`

### Frontend (React / TypeScript)
- Frontend source lives in `MovieListFrontEnd/frontend/src/`
- **Install deps**: `npm install`
- **Dev server** (Vite): `npm run dev`
- **Production build**: `npm run build`
- **Type check**: `npx tsc --noEmit`

## Coding Conventions
- PHP: PSR-12 enforced by Laravel Pint; use type declarations on all methods
- TypeScript: strict mode; prefer functional components and custom hooks
- API calls go in `MovieListFrontEnd/frontend/src/api/`
- Shared types go in `MovieListFrontEnd/frontend/src/types/index.ts`

## CI/CD
- CI runs on every push and pull request — see `.github/workflows/ci.yml`
- CD (deployment) is triggered manually or on merge to `main` — see `.github/workflows/cd.yml`

## Key Dependencies
| Layer | Package | Purpose |
|-------|---------|---------|
| Backend | `laravel/framework` ^12 | Web framework |
| Backend | `laravel-doctrine/orm` 3.1 | Doctrine ORM integration |
| Backend | `laravel/pint` ^1 | Code style linter |
| Frontend | `react` ^19 | UI library |
| Frontend | `tailwindcss` ^4 | Utility CSS framework |
| Frontend | `vite` ^6 | Bundler / dev server |
