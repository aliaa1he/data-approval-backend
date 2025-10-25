
[Screencast from 2025-10-23 20-16-13.webm](https://github.com/user-attachments/assets/278be92c-73ca-4763-a3db-f01172c90b2f)
 
#Data Approval System

A full-stack web application for managing and approving department entries.  
Built with **Laravel (Sanctum Authentication)** for the backend and **Vue 3 + Vite + Axios** for the frontend.

---

##  Features

### Authentication
- Secure login and registration using **Laravel Sanctum**.
- Token-based authentication stored safely in `localStorage`.
- Protected routes and automatic token validation.

### Entry Management
- Add, view, and delete entries dynamically.
- Filter entries by **status** (Pending, Approved, Rejected) and **date range**.
- Pagination support for large datasets.

### Admin Dashboard
- View summarized statistics by entry status.
- Approve or reject entries directly from the dashboard.
- Visual statistics for better monitoring and decision making.

### User Dashboard
- Submit new entries with category, value, and date.
- Track the status of submitted entries in real-time.

### Statistics
- Dynamic statistics grouped by status.
- Auto-calculated total value of all entries.

---

##  Tech Stack

### Backend
- **Laravel 12**
- **Laravel Sanctum** (Authentication)
- **MySQL** (Database)
- **Eloquent ORM**
- **API Routes** with `auth:sanctum` middleware

### Frontend
- **Vue 3 (Composition API)**
- **Vite**
- **Axios** for API communication
- **Font Awesome** for icons

---
How It Works

- **Authentication**:

- User registers or logs in.

- Sanctum generates a token stored in localStorage.

- **Entry Submission**:

- Users can add entries (category, value, date, notes).

- Each entry is stored with status pending by default.

- **Admin Dashboard**:

- Admin can view all entries.

- Approve or reject entries → updates status instantly.

- View real-time statistics (pending, approved, rejected, total value).

- **Validation & Error Handling**:

- Frontend validates fields before submission.

- Backend prevents duplicate entries with the same (category, date, and value).

- Clear error/success messages displayed to the user.

---

## API Documentation

Base URL (local development):  
👉 **http://localhost:8000/api**

---

###  Authentication Routes

| Method | Endpoint | Description | Auth |
|:------:|:---------|:-------------|:----:|
| **POST** | `/register` | Register a new user |
| **POST** | `/login` | Login and receive authentication token  |
| **POST** | `/logout` | Logout current user (invalidate token) |

---

###  Entry Management Routes

| Method | Endpoint | Description | Auth |
|:------:|:---------|:-------------|:----:|
| **GET** | `/entries` | Fetch all entries (visible for authorized users) |
| **POST** | `/entries` | Create a new entry (category, value, date, notes)  |
| **PUT** | `/entries/{id}/status` | Update the status of a specific entry (approve/reject)  |
| **DELETE** | `/entries/{id}` | Delete an existing entry |

---

###  Statistics & Categories

| Method | Endpoint | Description | Auth |
|:------:|:---------|:-------------|:----:|
| **GET** | `/entries/statistics` | Get summarized statistics (Pending / Approved / Rejected / Total Value) |
| **GET** | `/entries/categories` | Fetch allowed categories (Finance, HR, IT, Operations, Marketing)  |

---

###  Notes

- All routes under `/entries` require a valid **Sanctum token**.
- Token is automatically added by the frontend via **Axios interceptors**.
- Unauthorized requests will return a `401 Unauthorized` error.
- Validation errors return status `422 Unprocessable Content`.
- Duplicate entries (same category, numeric_value, and date) return  
  `{ "message": "Duplicate entry" }`.

---

###  Example Headers for Authenticated Requests

```http
Authorization: Bearer <your_token_here>
Accept: application/json
Content-Type: application/json

