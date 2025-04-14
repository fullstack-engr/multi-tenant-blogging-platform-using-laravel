
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
The Tenant API Documentation can be found [here](https://github.com/fullstack-engr/multi-tenant-blogging-platform-using-laravel/blob/production/API_Documentation.md).

### Installation

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/fullstack-engr/multi-tenant-blogging-platform-using-laravel.git
   cd courierplus-blog
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Set Up Environment File**
   Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```
   Then, generate an application key:
   ```bash
   php artisan key:generate
   ```

4. **Configure Database**
   Open the `.env` file and configure your database settings:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   ADMIN_NAME=Admin_User
   ADMIN_EMAIL=your_admin_user
   ADMIN_PASSWORD=your_admin_password
   ```

5. **Migrate the Database**
   Run the migrations to set up the database schema:
   ```bash
   php artisan migrate
   ```

6. **Add Sanctum**
   If not already added, install Sanctum:
   ```bash
   composer require laravel/sanctum
   ```
   Publish the Sanctum configuration:
   ```bash
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   ```
   Run the migrations to set up Sanctum:
   ```bash
   php artisan migrate:fresh
   ```

7. **Run Database Seeder**
   ```bash
   php artisan db:seed --class=UserSeeder
   ```

8. **Install Frontend Dependencies (if applicable)**
   If the project uses npm for frontend assets, install the dependencies:
   ```bash
   npm install
   ```
   Then, compile the assets:
   ```bash
   npm run dev
   ```

9. **Serve the Application**
   Start the Laravel development server:
   ```bash
   php artisan serve
   ```
   Your application should now be running at [http://127.0.0.1:8000](http://127.0.0.1:8000).
