Thank you for sharing your controllers! Based on your project details, here's an updated `README.md` for your **Zoniftye** project with the necessary additions regarding packages, queue configuration, and migration commands.

---

# Zoniftye

**Zoniftye** is a Laravel 11-based project designed to manage authentication, projects, reviews, contact forms, password management, and more. It leverages JWT authentication, job queues for email functionality, and integrates various Laravel features for building a scalable web application.

## Table of Contents

1. [About](#about)
2. [Requirements](#requirements)
3. [Installation](#installation)
4. [Configuration](#configuration)
5. [Running the Application](#running-the-application)
6. [API Endpoints](#api-endpoints)
7. [Testing](#testing)
8. [License](#license)

---

## About

Zoniftye is a Laravel application built to manage multiple aspects of a web platform, including authentication, password reset, project management, reviews, and contact form submissions. The application uses JWT for API authentication and Mailtrap for email testing, along with queues for background email tasks.

---

## Requirements

- PHP >= 8.2
- Laravel >= 11.31
- Composer
- MySQL (or your preferred database)
- Mailtrap (for email testing)
- Redis (for queue management)

---

## Installation

Follow these steps to set up and run the application locally.

1. **Clone the repository:**

   ```bash
   git clone https://github.com/yourusername/zoniftye.git
   cd zoniftye
   ```

2. **Install dependencies via Composer:**

   ```bash
   composer install
   ```

3. **Set up your `.env` file:**

   Duplicate the `.env.example` file and rename it to `.env`:

   ```bash
   cp .env.example .env
   ```

4. **Generate application key:**

   ```bash
   php artisan key:generate
   ```

5. **Set up the database:**

   Update the `.env` file with your database credentials:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

6. **Run migrations to set up the database schema:**

   ```bash
   php artisan migrate
   ```

---

## Configuration

### JWT Authentication

This project uses the `tymon/jwt-auth` package for JWT authentication. Make sure to generate the JWT secret by running:

```bash
php artisan jwt:secret
```

This will generate a secret key and save it to the `.env` file.

### Mailtrap Configuration

For email testing, this project uses **Mailtrap**. Update the `.env` file with your Mailtrap credentials:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
```

### Queue Configuration

Ensure your `.env` file is configured for queues:

```env
QUEUE_CONNECTION=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

Then, start the queue worker with:

```bash
php artisan queue:work
```

### Caching and Optimizing

For production environments, you can cache routes and configurations:

```bash
php artisan config:cache
php artisan route:cache
```

---

## Running the Application

After completing the installation and configuration steps, you can run the application locally.

1. **Start the development server:**

   ```bash
   php artisan serve
   ```

   By default, the application will be accessible at [http://localhost:8000](http://localhost:8000).

---

## API Endpoints

### Authentication

- **POST /api/login**  
  Logs the user in and returns a JWT token.

  - **Request Body:**

    ```json
    {
      "email": "user@example.com",
      "password": "yourpassword"
    }
    ```

  - **Response:**

    ```json
    {
      "username": "User Name",
      "email": "user@example.com",
      "token": "your_jwt_token"
    }
    ```

- **POST /api/logout**  
  Logs the user out by invalidating the JWT token.

### Password Reset

- **POST /api/password/forgot**  
  Sends a password reset link to the user's email.

  - **Request Body:**

    ```json
    {
      "email": "user@example.com"
    }
    ```

- **POST /api/password/reset**  
  Resets the user's password using the reset token and email.

  - **Request Body:**

    ```json
    {
      "token": "reset_token",
      "email": "user@example.com",
      "password": "newpassword",
      "password_confirmation": "newpassword"
    }
    ```

### Project Management

- **GET /api/projects**  
  Retrieves all projects.

- **POST /api/projects**  
  Creates a new project.

  - **Request Body:**

    ```json
    {
      "title": "Project Title",
      "description": "Project Description",
      "image": "image_file"
    }
    ```

- **PUT /api/projects/{id}**  
  Updates an existing project.

- **DELETE /api/projects/{id}**  
  Deletes a project.

### Contact Form

- **POST /api/contact**  
  Submits a new contact message.

  - **Request Body:**

    ```json
    {
      "first_name": "John",
      "last_name": "Doe",
      "email": "john.doe@example.com",
      "phone_number": "123456789",
      "message": "Your message here"
    }
    ```

### Review Management

- **GET /api/reviews**  
  Retrieves all reviews.

- **POST /api/reviews**  
  Creates a new review.

  - **Request Body:**

    ```json
    {
      "title": "Review Title",
      "comment": "Review Comment",
      "rating": 5,
      "customer_name": "Customer Name"
    }
    ```

---

## Testing

To run the application's tests, make sure you have the `.env` file set up with the appropriate database configuration. Then, run the following command:

```bash
php artisan test
```

---

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
