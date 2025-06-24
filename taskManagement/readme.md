# Task Manager Web App

A simple task management web application for freelancers to:

- ✅ Add tasks
- ✅ Mark tasks as completed
- ✅ Update existing tasks
- ✅ Delete tasks

---

## 📌 Features

- Visually distinguishes completed vs pending tasks
- Responsive UI built with HTML, CSS, and PHP
- Connects to a MySQL database using PDO
- Clean table layout for task tracking

---

## 🐞 Common Bugs & Issues Encountered

- **Anchor (`<a>`) elements not styled as buttons:**  
  Solution: Added custom CSS classes (e.g., `.update-btn`) and ensured `text-decoration: none;` and `display: inline-block;` were set.

- **Button styles not working:**  
  Solution: Used `class` instead of `id` for repeated buttons, checked CSS file linking, and cleared browser cache.

- **Database connection not working:**  
  Solution: Ensured correct credentials in `database/database.php`, used `PDO` with error reporting, and checked MySQL server status.

- **Inserted/updated values not showing in table:**  
  Solution: Used PHP to dynamically fetch and display tasks from the database in the table body.

- **Update form not pre-filled:**  
  Solution: Used PHP to fetch the task by ID and echo values into form fields.

- **Delete and update actions interfering:**  
  Solution: Used a link for Update and a separate POST form for Delete, not placing both in the same form.

- **Form data not being received in PHP:**  
  Solution: Ensured all form fields had correct `name` attributes and used `$_POST['fieldname']` in PHP.

---

## ✏️ Author

Nash Claracay  
BSCS - Web Application Development  
2025

---