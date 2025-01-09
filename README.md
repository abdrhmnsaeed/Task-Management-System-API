# Task Management System API

A RESTful API built with Laravel for managing tasks. The API allows users to create, read, update, delete, and filter tasks. It includes authentication with JWT, rate-limiting middleware to prevent abuse, and supports unit testing.

## Features

- **Authentication**: Register and login users with JWT tokens for secure access.
- **CRUD Operations**: Create, retrieve, update, and delete tasks.
- **Filtering and Sorting**: Fetch tasks with optional filters (priority, due date range) and sorting by due date.
- **Rate-Limiting**: Protect API endpoints from abuse with rate-limiting.
- **Unit Tests**: Tests for the task management endpoints.

## Table of Contents

- [API Documentation](#api-documentation)
- [Rate Limiting](#rate-limiting)
- [Setup Instructions](#setup-instructions)
- [Testing](#testing)
- [Deployment](#deployment)
- [License](#license)

## API Documentation

### 1. User Registration
- **Endpoint**: `POST /api/register`
- **Request Body**:
  ```json
  {
    "name": "Test User",
    "email": "testuser@example.com",
    "password": "passwd123"
  }
  ```

  - **Response**:
  ```json
  {
    "token": "JWT_TOKEN"
  }
  ```

  ### 2. User Login
- **Endpoint**: `POST /api/login`
- **Request Body**:
  ```json
  {
    "email": "testUser@example.com",
      "password": "passwd123"
  }
  ```

  - **Response**:
  ```json
  {
    "token": "JWT_TOKEN"
  }
  ```

   ### 2. Create Task
- **Endpoint**: `POST /api/tasks`
- **Request Body**:
  ```json
  {
      "title": "Create New Task",
      "description": "Test adding new task",
      "due_date": "2025-01-15",
      "priority": "high"
  }
  ```

  - **Response**:
  ```json
  {
      "id": 1,
      "title": "Complete the project",
      "description": "Finalize all remaining tasks",
      "due_date": "2025-01-15",
      "priority": "high",
      "created_at": "2025-01-01T00:00:00Z",
      "updated_at": "2025-01-01T00:00:00Z"
  }
  ```
