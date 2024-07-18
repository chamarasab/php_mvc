# PHP MVC Login and Registration

This is a PHP MVC (Model-View-Controller) application that includes user registration and login functionalities. The application is structured to follow the MVC pattern, promoting separation of concerns and making the codebase more manageable.

## Table of Contents

1. [Introduction](#introduction)
2. [Project Structure](#project-structure)
3. [Setting Up the Environment](#setting-up-the-environment)
4. [Database Setup](#database-setup)
5. [Running the Application](#running-the-application)
6. [Routes](#routes)
7. [Contributing](#contributing)
8. [License](#license)

## Introduction

This project demonstrates a simple implementation of an MVC framework in PHP. It includes basic features such as user registration, login, and user management.

## Project Structure

```
/php_mvc_login_and_register
│
├── /public
│   └── index.php
│
├── /src
│   ├── /config
│   │   └── config.php
│   ├── /controllers
│   │   └── UserController.php
│   ├── /core
│   │   ├── Router.php
│   │   ├── Controller.php
│   │   ├── Model.php
│   │   └── View.php
│   ├── /helpers
│   │   └── ResponseHelper.php
│   ├── /middlewares
│   │   └── AuthMiddleware.php
│   ├── /models
│   │   └── UserModel.php
│   └── /routes
│       └── web.php
│
├── /logs
│   └── app.log
│
└── composer.json
```

## Setting Up the Environment

1. **Install Composer**:
   Composer is a dependency manager for PHP. You can download and install it from [getcomposer.org](https://getcomposer.org).

2. **Create the Project Directory**:
   ```bash
   mkdir php_mvc_login_and_register
   cd php_mvc_login_and_register
   ```

3. **Initialize Composer**:
   ```bash
   composer init
   ```

4. **Install Dependencies**:
   Create a `composer.json` file with the necessary dependencies. Then, run:
   ```bash
   composer install
   ```

## Database Setup

1. **Create the Database**:
   Run the following SQL commands to create the `mvc` database and `users` table.

   ```sql
   CREATE DATABASE mvc;
   
   USE mvc;
   
   CREATE TABLE `users` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `name` varchar(255) NOT NULL,
     `email` varchar(255) NOT NULL,
     `password` varchar(255) NOT NULL,
     `logged_at` timestamp NULL DEFAULT current_timestamp(),
     PRIMARY KEY (`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
   ```

## Running the Application

1. **Run the Application**:
   Use a PHP built-in server to run the application.
   
   ```bash
   php -S localhost:8000 -t public
   ```

2. **Access the Application**:
   Open a browser and navigate to `http://localhost:8000`.

## Routes

The application routes are defined in `src/routes/web.php`. Here are the available routes:

- `POST /register` - Register a new user.
- `POST /login` - Login a user.
- `GET /user/{id}` - Get user details by ID.
- `GET /users` - List all users.
- `PUT /user/{id}` - Update user details.
- `DELETE /user/{id}` - Delete a user.

## Contributing

If you would like to contribute to this project, please fork the repository and submit a pull request. We welcome all contributions that improve the application.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
