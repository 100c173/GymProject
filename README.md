# GYM-MS

## Description
This project is a **GYM management system** built with **Laravel 10** that provides a **RESTful API** for book appointment, rating, subscribe a plan, service, trainer and send a membership application etc. It allows admins to perform **CRUD operations** (Create, Read, Update, Delete) on various entities, with the ability to filter data. The project follows **service pattern** and incorporates **clean code** and **refactoring principles**.

### Key Features:
- **CRUD Operations**: Create, read, update, and delete various entities in the system.
- **Filtering**: Filter data based on different criteria.
- **Service Pattern**: The project follows the service pattern for better code organization and maintainability.
- **Form Requests**: Validation is handled by custom form request classes.
- **API Response Service**: Unified responses for API endpoints.
- **Pagination**: Results are paginated for better performance and usability.
- **Resources**: API responses are formatted using Laravel resources for a consistent structure.
- **Seeders**: Populate the database with initial data for testing and development.
- **Email Notification**: When someone subscribes to a plan, the information of the plan and subscription will be sent via email.
### Technologies Used:
- **Laravel 10**
- **PHP**
- **MySQL**
- **XAMPP** (for local development environment)
- **Composer** (PHP dependency manager)
- **Postman Collection**: Contains all API requests for easy testing and interaction with the API.

---

## Installation

### Prerequisites

Ensure you have the following installed on your machine:
- **XAMPP**: For running MySQL and Apache servers locally.
- **Composer**: For PHP dependency management.
- **PHP**: Required for running Laravel.
- **MySQL**: Database for the project
- **Postman**: Required for testing the requestes.

### Steps to Run the Project

1. Clone the Repository  
   ```bash
   git clone https://github.com/TukaHeba/Movie_Library.git
2. Navigate to the Project Directory
   ```bash
   cd GymProject
3. Install Dependencies
   ```bash
   composer install
   npm install
4. Create Environment File
   ```bash
   cp .env.example .env
   Update the .env file with your database configuration (MySQL credentials, database name, etc.).
5. Generate Application Key
    ```bash
    php artisan key:generate
6. Run Migrations
    ```bash
    php artisan migrate
7. Seed the Database
    ```bash
    php artisan db:seed
8. Run the Application
    ```bash
    php artisan serve
    npm run dev
9. Interact with the API and test the various endpoints via Postman collection 
    Get the collection from here: [Postman Collection](https://documenter.getpostman.com/view/38893521/2sAYQWJDQu)
