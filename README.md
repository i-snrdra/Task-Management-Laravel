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
- **Frontend**: TailwindCSS
- **Admin Panel**: Backpack for Laravel
- **Database**: MySQL / PostgreSQL / SQLite
- **Build Tool**: Vite
- **Testing**: PHPUnit
- **Caching & Queue**: Redis

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
    - git clone https://github.com/your-username/task-management.git
    - cd task-management
2. **Install Dependencies**:
   - composer install
   - npm install
3. **Set Up Environment**:
    - Copy the .env.example file to .env:
    -     cp .env.example .env
    - Update the .env file with your database and other configurations.
4. **Generate Application Key**
    - php artisan key:generate
5. **Run Migrations**
    - php artisan migrate
6. **Build**
    - npm run build

### License
This project is licensed under the MIT License. See the LICENSE file for details.
