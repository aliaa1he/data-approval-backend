
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

## 🏗️ Tech Stack

### Backend
- **Laravel 10**
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
