# CourierPlus Multi-Tenant Blog System

Welcome to the CourierPlus Multi-Tenant Blog System! This project is part of the CourierPlus selection process and demonstrates the implementation of multi-tenancy, authentication, API development, and best coding practices using Laravel.

## Task Overview

### Key Features:
1. **User Registration and Approval:**
   - Users can register, but their accounts remain pending approval.
   - Admins approve accounts, creating them as tenants.

2. **Tenant Operations:**
   - Tenants can log in and perform CRUD (Create, Read, Update, Delete) operations on blog posts via both Web and API.

3. **Admin Capabilities:**
   - Admins can view all posts created by all tenants.

4. **API Authentication:**
   - API authentication is required for tenants using Laravel Sanctum or Passport.

5. **Best Practices:**
   - The project follows SOLID principles and Laravel best practices.

## Getting Started

### Prerequisites

1. **PHP:**
   Ensure you have PHP installed (version 8.0 or higher is recommended).

2. **Composer:**
   Make sure Composer is installed. Composer is a dependency manager for PHP.

3. **Node.js and npm:**
   You'll need Node.js and npm. Node.js version v18.20.2 was used; other versions above v18.20.2 are also compatible.

4. **Database:**
   Have a database server running (e.g., MySQL, PostgreSQL). MySQL was used.

**Note:** This project was set up on Laravel 11.


### Installation

1. **Clone the Repository:**
   ```bash
   git clone (https://github.com/fullstack-engr/multi-tenant-blogging-platform-using-laravel.git)
   cd courierplus-blog
<h3>2. Install PHP Dependencies</h3>
<pre><code>composer install</code></pre>

<h3>3. Set Up Environment File</h3>
<p>Copy the <code>.env.example</code> file to <code>.env</code>:</p>
<pre><code>cp .env.example .env</code></pre>
<p>Then, generate an application key:</p>
<pre><code>php artisan key:generate</code></pre>

<h3>4. Configure Database</h3>
<p>Open the <code>.env</code> file and configure your database settings:</p>
<pre><code>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
ADMIN_NAME=Admin_User
ADMIN_EMAIL=your_admin_user
ADMIN_PASSWORD=your_admin_password</code></pre>

<h3>5. Migrate the Database</h3>
<p>Run the migrations to set up the database schema:</p>
<pre><code>php artisan migrate</code></pre>

<h3>6. Add Sanctum</h3>
<p>If not already added, install Sanctum:</p>
<pre><code>composer require laravel/sanctum</code></pre>
<p>Publish the Sanctum configuration:</p>
<pre><code>php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"</code></pre>
<p>Run the migrations to set up Sanctum:</p>
<pre><code>php artisan migrate:fresh</code></pre>
