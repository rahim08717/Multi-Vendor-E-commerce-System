# Multi-Vendor E-commerce System

A comprehensive Multi-Vendor E-commerce platform built with **Laravel**. This system supports three types of users: **Admin, Seller, and Customer**, each with distinct roles and permissions. It features a robust Role-Based Access Control (RBAC) system, real-time activity logging, and order management.

## 🚀 Key Features

### 1. Admin Panel (Super User)
- **Dashboard:** Overview of total products, sellers, and earnings.
- **Seller Management:** Approve or manage seller accounts.
- **Role & Permission:** Assign roles and permissions dynamically.
- **Activity Logs:** Track detailed system activities (Login, Logout, Product Creation, Order Updates) using Laravel Events & Listeners.
- **Order Monitoring:** View all orders across the platform.

### 2. Seller Panel (Multi-Vendor Support)
- **Data Isolation:** Sellers can only view and manage their *own* products and orders.
- **Product Management:** Full CRUD (Create, Read, Update, Delete) capabilities for products.
- **Order Management:** View incoming orders and update order status (e.g., Pending → Shipped → Delivered).
- **Dashboard:** Track individual sales and earnings.

### 3. Customer Panel
- **Browsing:** Browse products from multiple sellers.
- **Cart System:** Add products to the cart and manage quantities.
- **Checkout:** Place orders securely.
- **Order Tracking:** View order history and current status.

## 🛠 Technology Stack
- **Framework:** Laravel 12 (PHP)
- **Database:** MySQL
- **Frontend:** Blade Templates, Bootstrap
- **Authentication:** Laravel UI / Auth
- **Security:** Middleware for Role-Based Access Control (RBAC)

## ⚙️ Installation Guide

Follow these steps to run the project locally:

1. **Clone the Repository**
   ```bash
   git clone [https://github.com/your-username/your-repo-name.git](https://github.com/your-username/your-repo-name.git)
   cd your-repo-name
