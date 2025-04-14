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
- PHP 7.3 or higher
- Composer
- Node.js and npm (for frontend assets)
- MySQL or any other database supported by Laravel

### Installation

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/your-username/courierplus-blog.git
   cd courierplus-blog
