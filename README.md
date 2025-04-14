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
   git clone [https://github.com/fullstack-engr/multi-tenant-blogging-platform-using-laravel.git](https://github.com/fullstack-engr/multi-tenant-blogging-platform-using-laravel.git)
   cd courierplus-blog
