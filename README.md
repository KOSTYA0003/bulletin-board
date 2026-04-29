# 📢 Bulletin Board

## 📖 Project Overview

Bulletin Board is a functional web platform for private classified ads. It features a comprehensive management system for users, hierarchical categories, and content moderation. This project demonstrates advanced Laravel capabilities in building multi-level systems with a role-based access model(RBAC) and complex data relationships.

## 🚀 Core Functionality

### 👥 Users and Roles (RBAC)

- **User** — Can create, edit, and delete their own advertisements, as well as browse ads from others.
- **Admin** — Full system access: user management (ban/unban, role assignment) and global advertisement moderation.

### 📝 Advertisements

- Full CRUD cycle (Create, Read, Update, Delete)
- Support for multiple image uploads (up to 2MB per file).
- Status Workflow: pending (under review), approved (published), rejected (declined).
- Fields: Title, description, price (negotiable or numeric value).
- Date of creation

### 🗂️ Categories

- Multi-level Structure: Supports infinite nesting depth.
- Example Path: Electronics → Phones & Tablets → Smartphones → iPhone 15 Pro.
- Automated Logic: Automatic calculation of nesting levels (level attribute).
- Ad Counter: Displays the number of ads within a category, including all subcategories.
- Breadcrumbs: Dynamic navigation for a better user experience.

### 🖼️ Image Management

- Multiple Uploads: Support for attaching several photos to a single ad.
- Storage: Files are stored in storage/app/public/advertisements.
- Smart Preview: Displays up to 3 photos in lists, with a counter for additional images.
- Auto-Cleanup: Automatic deletion of image files from storage when an advertisement is deleted.

### 🛡️ Moderation System

- Default Status: Ads are created with the approved status (immediately public).
- Admin Capabilities:
    Approve (approved) or Reject (rejected) with reason.
    Edit or Delete any advertisement globally.


### 👑 Administrative Panel

- Dashboard: Real-time statistics (total ads, active vs. rejected ads, total users, and banned accounts).
- User Management: Comprehensive tools to browse the user list, edit profiles, ban/unban users, and assign administrative roles.
- Content Management: A global list of all advertisements (pagination: 50 per page) with advanced filtering, editing, and moderation controls (Approve/Reject).

## 🛠️ Technology Stack

| Technology | Purpose |
|:--- |:--- |
| **Laravel 12** | 	Modern PHP Framework (Backend) |
| **MySQL 8.0** | Relational Database |
| **Tailwind CSS 4** | 	Latest utility-first CSS framework |
| **Vite** | 	Fast frontend asset bundling |
| **Docker** | 	Containerization and environment isolation |


## 🌟 Key Features

*   **🌳 Recursive Category System**: Supports unlimited nesting depth using Eloquent self-referencing relationships.
*   **🔐 Access Control (RBAC)**: Flexible permission logic for Guests, Registered Users, and Administrators.
*   **📢 Ad Lifecycle**: : Complete CRUD cycle with a built-in moderation system (Pending, Approved, or Rejected statuses).
*   **📊 Insights**: A central dashboard for content monitoring and platform-wide analytics.


### 🖼️ Interface

**Main Page**
![Main Page](screenshots/main.png)

**Advertisement Details**
![Advertisement Details](screenshots/ad_details_page.png)

**Recursive Category Tree**
![Recursive Category Tree](screenshots/category_tree.png)

**User Management**
![User Management](screenshots/admin_dashboard.png)


## 📦 Installation and Setup (Docker)
This is the recommended way to run the project. No local PHP or MySQL installation is required.

Clone the project and configure the environment:

```bash
    git clone https://github.com/KOSTYA0003/bulletin-board.git
```

```bash
    cd bulletin-board
```

```bash
    cp .env.example .env  # For Windows CMD use: copy .env.example .env
```

Note: Ensure your .env file matches the Docker database settings: DB_HOST=board-db and DB_PASSWORD=root.

2. Start the containers:

```bash
    docker-compose up -d --build
```

3. Install dependencies and configure the application:

```bash
    docker exec -it board-app composer installs
```

```bash
    docker exec -it board-app php artisan key:generate
```

```bash
    docker exec -it board-app php artisan storage:link
```

```bash
    docker exec -it board-app npm install --force
```

```bash
    docker exec -it board-app npm run build
```

    4. Run migrations and seed the database:

```bash
    docker exec -it board-app php artisan migrate:fresh --seed
```


**Accessing the Application:**
- Website: [http://localhost:8082](http://localhost:8082)
- Database (phpMyAdmin): [http://localhost:8083](http://localhost:8083)

#### 👤 Test User Credentials

After running `php artisan migrate:fresh --seed`, the following accounts will be available for testing:

| Email | Password | Role |
| :--- | :--- | :--- |
| **user@test.com** | `password` | User |
| **admin@test.com** | `password` | Admin |

> ℹ️ Note: Additionally, the factory creates 10 random users. You can find their emails in the database or via the seeder output.

## 📄 License
MIT
