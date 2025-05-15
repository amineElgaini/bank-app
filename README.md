# Laravel Bank Management System

This Laravel application is a simple banking management system with the following key features:

- User management with roles: Admin, Employee, Customer
- Branch management
- Customer and Employee CRUD operations
- Transfer money between customers
- Deposit and withdrawal transactions
- Role-based access control via middleware
- Responsive UI with Tailwind CSS

---

## Features

### Roles and Permissions
- **Admin:** Manage users, branches, employees.
- **Employee:** Manage customers in their branch, perform transfers and transactions.
- **Customer:** View personal info (basic customer portal).

### Core Entities
- **User:** Authentication and role management.
- **Employee:** Linked to User and Branch.
- **Customer:** Linked to User and Branch, with balance.
- **Branch:** Bank branches.
- **Transaction:** Deposit and withdrawal logs.
- **Transfer:** Money transfers between customers.

---

## Installation

1. Clone the repo:

```bash
git clone https://github.com/yourusername/laravel-bank-management.git
cd laravel-bank-management

## Install dependencies:

composer install
npm install
npm run dev

## Run migrations and seeders:

php artisan migrate --seed

## Serve the application:

php artisan serve
