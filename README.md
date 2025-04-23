# Laravel Blog CMS with Filament Admin Panel

## Project Overview

A streamlined CMS allowing users to create, publish, and manage articles/posts with categories and tags. It includes role-based access (admin, editor, author), a clean RESTful API, and a Filament-powered admin panel.

<img width="1433" alt="admin-1" src="https://github.com/user-attachments/assets/9f671a4b-5a76-4960-9fd0-b9748f20323a" />

<img width="1433" alt="admin-2" src="https://github.com/user-attachments/assets/4940110d-dd12-4d10-9f9a-af6f29df581d" />

<img width="1433" alt="admin-4" src="https://github.com/user-attachments/assets/e2435ead-3866-4a58-86fc-0c82ee2a6d32" />

<img width="1433" alt="admin-3" src="https://github.com/user-attachments/assets/68c4b91d-4d13-4d5a-931b-800236372acb" />

---

## Key Features

### Core Functionality
- Article creation and publishing
- Category, subcategory, and tag management
- User management with roles (admin, editor, author)
- Featured image uploads

### API
- RESTful endpoints for articles, categories, and tags
- Basic authentication using Laravel Sanctum

### Filament Admin
- Dashboard for managing content
- User administration (via Spatie permissions)
- Spatie Media library

---

## ⚙️ Technical Stack

- Laravel 12+
- Laravel Sanctum for API auth
- Filament Admin Panel
- Spatie Laravel-Permission for role management
- File uploads handled via Spatie Media Library

---

## 🧑‍💻 User Roles & Permissions

| Role   | Articles | Categories | Users |
|--------|----------|------------|-------|
| Admin  | Full CRUD | Full CRUD | Full CRUD |
| Editor | Full CRUD | Full CRUD | No access |
| Author | Own articles only | No access | No access |

Role-based access is managed with **Spatie Laravel-Permission**.

---

## 👥 Seeded Users

These default users are seeded into the database using `UserSeeder.php`. Use these to log in to the Filament Admin Panel:

```bash
Name: Admin
Email: admin@example.com
Password: 123123123
Role: admin

Name: Editor
Email: editor@example.com
Password: 123123123
Role: editor

Name: Author
Email: author@example.com
Password: 123123123
Role: author
```

## Getting Started

To set up the project, follow these steps:

**Clone the repository**  
   
   ```bash
   git clone https://github.com/Dachi301/laravel-blog-cms.git
   ```
**Navigate to the project directory**  

   ```bash
   cd laravel-blog-cms
   ```
**Install PHP dependencies**  

   ```bash
   composer install
   ```
**Install JavaScript dependencies**  

   ```bash
   npm install
   ```
**Build the project**  

   ```bash
   npm run build
   ```
**Create a copy of the .env file**  

   ```bash
   cp .env.example .env
   ```
**Generate the application key**  

   ```bash
   php artisan key:generate
   ```
**Create the storage symlink**  

   ```bash
   php artisan storage:link
   ```
**Run migrations**  

   ```bash
   php artisan migrate
   ```
**Seed the database with roles and example data**  

   ```bash
   php artisan db:seed
   ```
**Start the development server**  

   ```bash
   php artisan serve
   ```

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
