# 🚀 AI Resume Builder (Laravel + Tailwind)

<p align="center">
<a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 11"></a>
<a href="https://tailwindcss.com"><img src="https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS"></a>
<a href="https://php.net"><img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP"></a>
</p>

A powerful, scalable Resume Builder application built with **Laravel 11**. 

Unlike traditional resume builders that rely on hundreds of hardcoded Blade files, this project uses a **Database-Driven Template Engine**. Resume designs are stored as HTML/Blade code in the database and rendered dynamically using `Blade::render()`, allowing for infinite scalability and instant updates without deployment.

---

## ✨ Key Features

### 🎨 User Features
* **Dynamic Resume Builder:** Add Experience, Education, and Skills using a reactive form.
* **Live Template Switching:** Instantly change the look of a resume without re-entering data.
* **PDF Export:** Download high-quality, ATS-friendly resumes.
* **Glassmorphism UI:** A modern, clean interface built with Tailwind CSS.

### 🛠️ Admin & Technical Features
* **Database-Driven Rendering:** Templates are stored in the `templates` table (LONGTEXT) and compiled at runtime.
* **Template Management:** Admin panel to Create, Edit, and Delete templates directly from the browser.
* **Role-Based Access Control (RBAC):** Super Admin, Editor, and User roles.
* **Yajra DataTables:** Server-side rendering for high-performance data grids.
* **Bulk Seeding:** Automated setup for templates and sample data.

---

## 📸 Screenshots

| Welcome Page | Resume Editor |
|:---:|:---:|
| <img src="https://via.placeholder.com/600x400?text=Welcome+Page" alt="Welcome Page" width="400"> | <img src="https://via.placeholder.com/600x400?text=Resume+Editor" alt="Resume Editor" width="400"> |

| Admin Dashboard | Template Selection |
|:---:|:---:|
| <img src="https://via.placeholder.com/600x400?text=Admin+Dashboard" alt="Admin Panel" width="400"> | <img src="https://via.placeholder.com/600x400?text=Template+Select" alt="Template Selection" width="400"> |

---

## 🛠️ Tech Stack

* **Backend:** Laravel 11, PHP 8.2+
* **Frontend:** Blade, Tailwind CSS, Alpine.js
* **Database:** MySQL
* **Icons:** Lucide Icons
* **Packages:**
    * `yajra/laravel-datatables` (Admin Tables)
    * `laravel/jetstream` (Auth & Teams)
    * `barryvdh/laravel-dompdf` (PDF Generation)

---

## 🚀 Installation Guide

Follow these steps to set up the project locally.

### 1. Clone the Repository
```bash
git clone [https://github.com/Yuvraj8090/resumeBuilder.git](https://github.com/Yuvraj8090/resumeBuilder.git)
cd resumeBuilder
2. Install Dependencies
Bash

composer install
npm install && npm run build
3. Environment Setup
Copy the .env file and generate the app key.

Bash

cp .env.example .env
php artisan key:generate
4. Database Setup
Create a database (e.g., resume_builder) in your MySQL, then configure your .env file:

Code snippet

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=resume_builder
DB_USERNAME=root
DB_PASSWORD=
5. Migrate & Seed (Important!)
This command will create tables and insert the Super Admin user and Default Templates.

Bash

php artisan migrate --seed
Note: If you want to seed specific templates manually:

Bash

php artisan db:seed --class=ModernTemplateSeeder
6. Run the Server
Bash

php artisan serve
Visit http://127.0.0.1:8000 in your browser.

👤 Default Login
Email: admin@gmail.com

Password: password (or whatever you set in UserSeeder)

🧩 Architectural Highlight: Dynamic Rendering
Instead of creating physical files for every new template:

Storage: We store the raw Blade HTML in the templates table.

Rendering: We use Laravel's inline rendering engine:

PHP

// ResumeController.php
$html = Blade::render($template->html_code, ['resume' => $resume]);
Benefit: This allows the Admin to fix typos, change colors, or add new designs instantly without touching the codebase or deploying to the server.

🤝 Contributing
Contributions are welcome!

Fork the Project

Create your Feature Branch (git checkout -b feature/AmazingFeature)

Commit your Changes (git commit -m 'Add some AmazingFeature')

Push to the Branch (git push origin feature/AmazingFeature)

Open a Pull Request

📄 License
This project is open-sourced software licensed under the MIT license.

📞 Contact
If you have any questions or feedback, feel free to reach out:

GitHub: Yuvraj8090

LinkedIn: Yuvraj Kohli

Email: yuvrajkohli8090@gmail.com

<p align="center"> Built with ❤️ by <a href="https://github.com/Yuvraj8090">Yuvraj Kohli</a> </p>