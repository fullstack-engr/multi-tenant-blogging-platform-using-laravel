# 📘 CourierPlus API Documentation

Welcome to the CourierPlus2 API. This API allows clients to manage user authentication and post operations in a multi-tenant blog system.

---

## 🌐 Base URL
```
http://127.0.0.1:8000
```

## 🔐 Authentication

This API uses Bearer Token authentication. Include the token in the `Authorization` header:

```
Authorization: Bearer <your_token>
```

---

## 🔑 Tenant Endpoints

### Login
- **Endpoint:** `/api/login`
- **Method:** `POST`
- **Description:** Authenticates a user and returns a token.

**Request Body:**
```json
{
  "email": "federicka@gmail.com",
  "password": "federicka"
}
```

**Response:**
- Status: 200 OK
```json
{
  "token": "1|lJss07pKQlkYdx96pqJL0hFbegPvs53Vt0hE0Ko82b21f1f6",
  "user": {
    "id": 4,
    "name": "Federick Approved",
    "email": "federicka@gmail.com",
    "email_verified_at": null,
    "is_admin": false,
    "status": "approved",
    "created_at": "2025-04-13T21:37:36.000000Z",
    "updated_at": "2025-04-13T21:37:36.000000Z"
  }
}
```

**Error Response:**
- Status: 403 Forbidden
```json
{
  "message": "Your account is not approved yet."
}
```

---

### Logout
- **Endpoint:** `/api/logout`
- **Method:** `POST`
- **Description:** Logs out the authenticated user.

**Request Header:**
```
Authorization: Bearer <your_token>
```

**Response:**
- Status: 200 OK
```json
{
  "message": "Logged out"
}
```

---

### Me
- **Endpoint:** `/api/me`
- **Method:** `GET`
- **Description:** Retrieves the authenticated user's info.

**Request Header:**
```
Authorization: Bearer <your_token>
```

**Response:**
- Status: 200 OK
```json
{
  "id": 1,
  "name": "FederickA",
  "email": "federicka@gmail.com",
  "email_verified_at": null,
  "is_admin": false,
  "status": "approved",
  "created_at": "2025-04-14T10:28:13.000000Z",
  "updated_at": "2025-04-14T11:07:33.000000Z"
}
```

---

## 📝 Posts Endpoints

### All Posts
- **Endpoint:** `/api/posts`
- **Method:** `GET`
- **Description:** Retrieves all posts.

**Request Header:**
```
Authorization: Bearer <your_token>
```

**Response:**
```json
[
  {
    "id": 3,
    "site_id": 1,
    "user_id": 1,
    "title": "6 Exercises to Tone Every Inch of Your Body",
    "content": "1. Lunges · 2. Pushups · 3. Squats · 4. Standing overhead dumbbell presses · 5. Dumbbell rows · 6. Single-leg deadlifts.",
    "created_at": "2025-04-14T11:46:47.000000Z",
    "updated_at": "2025-04-14T11:46:47.000000Z",
    "user": {
      "id": 1,
      "name": "FederickA",
      "email": "federicka@gmail.com",
      "email_verified_at": null,
      "is_admin": false,
      "status": "approved",
      "created_at": "2025-04-14T10:28:13.000000Z",
      "updated_at": "2025-04-14T11:07:33.000000Z"
    }
  }
]
```

---

### Show Post
- **Endpoint:** `/api/posts/{id}`
- **Method:** `GET`
- **Description:** Retrieves a specific post by ID.

**Request Header:**
```
Authorization: Bearer <your_token>
```

**Response:**
```json
{
  "id": 1,
  "site_id": 1,
  "user_id": 1,
  "title": "Most popular places to visit",
  "content": "Based on various sources...",
  "created_at": "2025-04-14T11:42:46.000000Z",
  "updated_at": "2025-04-14T11:42:46.000000Z",
  "user": { ... },
  "site": { ... }
}
```

---

### Insert Post
- **Endpoint:** `/api/posts`
- **Method:** `POST`
- **Description:** Creates a new post.

**Request Header:**
```
Authorization: Bearer <your_token>
```

**Request Body:**
```json
{
  "site_id": 1,
  "user_id": 1,
  "title": "How do People Talk",
  "content": "Flatly - In a firm and definite way intended to end discussion..."
}
```

**Response:**
- Status: 201 Created
```json
{
  "id": 4,
  "title": "How do People Talk",
  "content": "...",
  "user_id": 1,
  "site_id": 1,
  "created_at": "...",
  "updated_at": "..."
}
```

---

### Update Post
- **Endpoint:** `/api/posts/{id}`
- **Method:** `PUT`
- **Description:** Updates a post by ID.

**Request Header:**
```
Authorization: Bearer <your_token>
```

**Request Body:**
```json
{
  "site_id": 1,
  "user_id": 1,
  "title": "How do People Talk Frequently",
  "content": "Flatly - In a firm and definite way intended to end discussion..."
}
```

**Response:**
- Status: 200 OK
```json
{
  "id": 4,
  "title": "How do People Talk Frequently",
  "content": "...",
  "site_id": 1,
  "user_id": 1,
  "created_at": "...",
  "updated_at": "..."
}
```

---

### Delete Post
- **Endpoint:** `/api/posts/{id}`
- **Method:** `DELETE`
- **Description:** Deletes a post by ID.

**Request Header:**
```
Authorization: Bearer <your_token>
```

**Response:**
- Status: 200 OK
```json
{
  "message": "Deleted"
}
```
