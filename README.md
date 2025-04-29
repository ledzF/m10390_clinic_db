# Clinic Management System

The **Clinic Management System** is a lightweight PHP-MySQL web application designed to streamline and digitalize clinic operations. It supports multiple user roles including admins, doctors, and patients with separate dashboards and role-based access.

##  Features

### Admin/DOC
- Register new patients, doctors, and medicines
- View, edit, and delete patient/doctor/medicine records
- Assign appointments
- Add remarks to patient profiles

###  Patient
- Login using name + contact for simplified access
- View appointment history and doctor remarks
- Secure session management

###  Authentication
- Role-based login for Admin, Doctor, and Patient
- Optional patient registration protected with a code (e.g., `5743`) to prevent spam

---

## 🛠 Tech Stack

- **Backend:** PHP 7+, MySQLi
- **Frontend:** HTML, CSS
- **Database:** MySQL (e.g., `m10390_clinic_db`)
- **Other:** Basic session-based authentication

---

### 🚀 Getting Started

### 1. Clone the Repository
```bash
git clone https://github.com/yourusername/clinic-management-system.git
cd clinic-management-system
```
---

2. *Import the Database*

~ Open phpMyAdmin or any MySQL client

~ Create a database, e.g., clinic_db.

__Import the SQL file provided in the /database/ directory.__

Configure Database

Open db.php and update your DB credentials:

```php
$conn = mysqli_connect("localhost", "root", "", "clinic_db");
```
- Run the App

- Use a local server like XAMPP/WAMP/LAMP

- Visit: http://localhost/clinic-management-system/
