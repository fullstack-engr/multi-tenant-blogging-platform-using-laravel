
# CourierPlus API Documentation
This documentation provides a comprehensive overview of the API endpoints, including the request and response formats, authentication details, and example payloads.

## Base URL
http://127.0.0.1:8000

## Authentication
This API uses Bearer Token authentication. Include the token in the `Authorization` header as follows:
Authorization: Bearer <your_token>

## Tenant Endpoints

### Login
**Endpoint:** `/api/login`

**Method:** `POST`

**Description:** Authenticates a user and returns a token.

**Request Body:**
```json
{
  "email": "federicka@gmail.com",
  "password": "federicka"
}
Response:
    • Status: 200 OK
    • Body:

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
Error Response:
    • Status: 403 Forbidden
    • Body:

{
  "message": "Your account is not approved yet."
}

### **Logout**
Endpoint: /api/logout
Method: POST
Description: Logs out the authenticated user.
Request Headers:

Authorization: Bearer <your_token>
Response:
    • Status: 200 OK
    • Body:

```json
{
  "message": "Logged out"
}

Me
Endpoint: /api/me
Method: GET
Description: Retrieves the authenticated user's information.
Request Headers:

Authorization: Bearer <your_token>
Response:
    • Status: 200 OK
    • Body:

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
Posts Endpoints
All Posts
Endpoint: /api/posts
Method: GET
Description: Retrieves all posts.
Request Headers:

Authorization: Bearer <your_token>
Response:
    • Status: 200 OK
    • Body:

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
  },
  ...
]
Show Post
Endpoint: /api/posts/{id}
Method: GET
Description: Retrieves a specific post by ID.
Request Headers:

Authorization: Bearer <your_token>
Response:
    • Status: 200 OK
    • Body:

{
  "id": 1,
  "site_id": 1,
  "user_id": 1,
  "title": "Most popular places to visit",
  "content": "Based on various sources, some of the most popular travel destinations for 2025 include New York City, London, Dubai, and various other trending trips like Cape Town, Kruger & Victoria Falls, Classic Turkey, and Bali...",
  "created_at": "2025-04-14T11:42:46.000000Z",
  "updated_at": "2025-04-14T11:42:46.000000Z",
  "user": {
    "id": 1,
    "name": "FederickA",
    "email": "federicka@gmail.com",
    "email_verified_at": null,
    "is_admin": false,
    "status": "approved",
    "created_at": "2025-04-14T10:28:13.000000Z",
    "updated_at": "2025-04-14T11:07:33.000000Z"
  },
  "site": {
    "id": 1,
    "user_id": 1,
    "name": "People Talk",
    "subdomain": "people-talk",
    "created_at": "2025-04-14T11:40:15.000000Z",
    "updated_at": "2025-04-14T11:40:15.000000Z"
  }
}
Delete Post
Endpoint: /api/posts/{id}
Method: DELETE
Description: Deletes a specific post by ID.
Request Headers:

Authorization: Bearer <your_token>
Response:
    • Status: 200 OK
    • Body:

{
  "message": "Deleted"
}
Insert Post
Endpoint: /api/posts
Method: POST
Description: Creates a new post.
Request Headers:

Authorization: Bearer <your_token>
Request Body:

{
  "site_id": 1,
  "user_id": 1,
  "title": "How do People Talk",
  "content": "Flatly - In a firm and definite way intended to end discussion of a subject. Fluent - Spoken well and without difficulty. Gibbering - Unable to speak in a sensible way, especially because you are frightened or shocked. Halting - With a lot of pauses between words or movements, often because of a lack of confidence."
}
Response:
    • Status: 201 Created
    • Body:

{
  "title": "How do People Talk",
  "content": "Flatly - In a firm and definite way intended to end discussion of a subject. Fluent - Spoken well and without difficulty. Gibbering - Unable to speak in a sensible way, especially because you are frightened or shocked. Halting - With a lot of pauses between words or movements, often because of a lack of confidence.",
  "user_id": 1,
  "site_id": 1,
  "updated_at": "2025-04-14T11:56:21.000000Z",
  "created_at": "2025-04-14T11:56:21.000000Z",
  "id": 4
}

Update Post
Endpoint: /api/posts/{id}
Method: PUT
Description: Updates an existing post by ID.
Request Headers:

Authorization: Bearer <your_token>
Request Body:

{
  "site_id": 1,
  "user_id": 1,
  "title": "How do People Talk Frequently",
  "content": "Flatly - In a firm and definite way intended to end discussion of a subject. Fluent - Spoken well and without difficulty. Gibbering - Unable to speak in a sensible way, especially because you are frightened or shocked. Halting - With a lot of pauses between words or movements, often because of a lack of confidence."
}
Response:
    • Status: 200 OK
    • Body:

{
  "id": 4,
  "site_id": 1,
  "user_id": 1,
  "title": "How do People Talk Frequently",
  "content": "Flatly - In a firm and definite way intended to end discussion of a subject. Fluent - Spoken well and without difficulty. Gibbering - Unable to speak in a sensible way, especially because you are frightened or shocked. Halting - With a lot of pauses between words or movements, often because of a lack of confidence.",
  "created_at": "2025-04-14T11:56:21.000000Z",
  "updated_at": "2025-04-14T11:59:41.000000Z"
}
