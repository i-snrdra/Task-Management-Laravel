# Simple Task Management

A simple and efficient task management system built with Laravel and Backpack for Laravel. This application helps users manage their tasks effectively with features like task creation, status tracking, and role-based access control.

## Features

- **Task Management**: Create, update, and delete tasks with attributes like name, description, due date, and status.
- **Role-Based Access Control**:
  - Admin: Manage users and view all tasks.
  - User: Manage their own tasks.
- **Dashboard**: View task statistics (e.g., total tasks, completed tasks, pending tasks).

---

## Tech Stack

- **Backend**: Laravel
- **Admin Panel**: Backpack for Laravel
- **Database**: MySQL

---

## Installation

Follow these steps to set up the project locally:

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL or any supported database
- Redis (optional, for queue management)

### Steps

1. **Clone the Repository**:
    -     git clone https://github.com/your-username/task-management.git
    -     cd task-management
2. **Install Dependencies**:
   -     composer install
   -     npm install
3. **Set Up Environment**:
    - Copy the .env.example file to .env:
    -     cp .env.example .env
    - Update the .env file with your database and other configurations.
4. **Generate Application Key**
    -     php artisan key:generate
5. **Run Migrations**
    -     php artisan migrate
6. **Run Database Seeder**
    -     php artisan db:seed
7. **Build**
    -     npm run build

---
### Screenshots
![image](https://github.com/user-attachments/assets/a6997ae0-1d6e-4f3e-b6f3-ced9fb32c9ee)
![image](https://github.com/user-attachments/assets/44582ec3-5f5f-4d62-b32e-306620f636bb)
![image](https://github.com/user-attachments/assets/a17fd4bf-6b97-417b-9b5a-384a3ac4259f)


---

### License
This project is licensed under the MIT License. See the LICENSE file for details.
