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
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
  }

  - **Request Body**:
  ```json
  {
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
  }
