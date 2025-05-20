
#  Management System via PHP

A modular, web-based **Management System** developed using **HTML**, **CSS**, **JavaScript**, **PHP**, and **MySQL** (via **XAMPP**). This system handles four key areas:

1. Student Registration
2. Employee Management
3. Flight Management
4. Library Management

Each module allows CRUD operations with data saved securely in a MySQL database.

---

## Project Structure

```
Management System via PHP/
├── Student Registration System/
│   ├── formValidation.js
│   ├── studentRegistrationForm.html
│   ├── styles.css
│   ├── table.php
│   ├── thankYou.html
├── Employee Management.php
├── Flight Management.php
└── Library Management.php
```

---

##  Student Registration System

This module captures student information through a web form and stores it in a MySQL database.

###  Features

- HTML5 form with JavaScript (`formValidation.js`) client-side validation.
- Stores student data (name, email, DOB, course, gender, etc.).
- Thank-you confirmation page on successful submission.
- PHP script (`table.php`) connects to MySQL via XAMPP.

### Screenshots

> Add your screenshots below. Example:
> ```
> ![Student Registartion](E:\Management System via PHP\screenshots\Student registration.png)
> ![Database Connectivity](E:\Management System via PHP\screenshots\Student database connectivity.png)
> ```

---

##  Employee Management

This module handles organizational staff information.

###  Features

- Add, update, view, or delete employee records.
- Stores fields like name, role, contact, department, and join date.
- Developed using PHP and MySQL.

###  Screenshots

>  Add your screenshots below:
> ```
> ![Employee Management System](E:\Management System via PHP\screenshots\Employee Mangament System.png)
> ![Employee Database](E:\Management System via PHP\screenshots\Employee Database.png)
> ```

---

##  Flight Management

Simulates airline operations management (for academic/demo use).

###  Features

- Add flights (Flight No., Origin, Destination, Date & Time).
- List all scheduled flights.
- Edit or delete flights.

###  Screenshots

>  Add your screenshots below:
> ```
> ![Flight Management System](E:\Management System via PHP\screenshots\Flight Mangament System.png)
> ![Flight Database](E:\Management System via PHP\screenshots\Flight Database.png)
> ```

---

##  Library Management

Keeps track of books and student lending activity.

### Features

- Add/view/update/delete books.
- Track issued books and return status.
- Book data includes Title, Author, Genre, Availability.

### Screenshots

>  Add your screenshots below:
> ```
> ![Library Management System](E:\Management System via PHP\screenshots\Libarary Managment System.png)
> ![Library Management Database ](E:\Management System via PHP\screenshots\Library Management Database.png)
> ```

---

##  Technologies Used

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP (Procedural)
- **Database:** MySQL via XAMPP

---

## 🛠️ How to Run

1. Install [XAMPP](https://www.apachefriends.org/index.html)
2. Place this folder inside `htdocs`
3. Start Apache and MySQL from XAMPP control panel
4. Create a new MySQL database (e.g., `management_system`)
5. Create required tables using `phpMyAdmin` or `.sql` scripts
6. Open the following in your browser:

```
http://localhost/Student%20Registration%20System/studentRegistrationForm.html
```

---

##  Security Suggestions

- Sanitize and validate inputs on both client and server sides.
- Use prepared statements to avoid SQL injection.
- Add authentication for sensitive modules.

---

##  Future Enhancements

- Admin login with role-based access.
- PDF/Excel report generation.
- AJAX-based dynamic updates.
- Bootstrap for responsive design.
- Migrate to MVC structure or use Laravel for scalability.

---

