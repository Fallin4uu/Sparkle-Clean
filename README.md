SparkleClean Services - Web Application
SparkleClean Services is a complete, multi-page web application for a professional cleaning company. Built with PHP and MySQL, it allows potential customers to browse services, view prices, and read client reviews. Registered clients can log in to a secure dashboard to schedule appointments and manage their account, which includes a secure NID verification system.

Key Features
Dynamic Public Pages: The website dynamically loads all content—such as services, pricing, team members, and reviews—directly from the MySQL database.

Client Authentication: A secure registration and login system for clients, with password hashing for security.

Client Dashboard: A dedicated dashboard for logged-in users to view their appointment history and manage their account.

NID Verification System: A secure process for clients to verify their identity by uploading images of their National ID card, a crucial step for building trust and security.

Appointment Scheduling: An integrated form that allows verified, logged-in clients to request cleaning appointments for specific services and dates.

Review & Rating System: Registered clients can submit star ratings and written feedback, which are then displayed publicly on the reviews page.

Contact Form: A functional contact form that captures user messages and stores them in the database for administrative review.

Responsive Design: The entire website is styled with a single, comprehensive CSS file that ensures a seamless experience on desktops, tablets, and mobile devices.


Setup and Installation
To run this project locally, you will need a server environment like XAMPP.

Prerequisites:

Ensure you have XAMPP installed and running (with Apache and MySQL services started).

Clone the Repository:

git clone [https://github.com/Fallin4uu/Sparkle-Clean.git](https://github.com/Fallin4uu/Sparkle-Clean.git)

Alternatively, download the project files and place them in your XAMPP htdocs directory.

Database Setup:

Open phpMyAdmin by navigating to http://localhost/phpmyadmin.

Create a new database named sparkle_clean.

Select the sparkle_clean database and go to the "Import" tab.

Upload and import the database_setup.sql file provided in the repository to create and populate all necessary tables.

Database Connection:

Open the api/db_connect.php file.F

Verify that the database credentials ($servername, $username, $password, $dbname) match your local MySQL setup. The default XAMPP setup usually has a blank password for the root user.

Create Uploads Directory:

In the root directory of the project, create a new folder named uploads.

Inside the uploads folder, create another folder named nid. This is required for the NID verification image uploads.

Run the Application:

Open your web browser and navigate to http://localhost/sparkle-clean/home.php.

Project Structure
/sparkleclean/
│
├── 📄 home.php             # Main landing page
├── 📄 services.php         # Displays all cleaning services
├── 📄 reviews.php          # Shows client reviews and form
├── 📄 workers.php          # Lists team members
├── 📄 contact.php          # Contact form and information
├── 📄 schedule.php         # Appointment booking form
├── 📄 fees.php             # Pricing table
├── 📄 login.php            # Client login page
├── 📄 registration.php     # Client registration page
├── 📄 dashboard.php        # Secure client dashboard
├── 📄 header.php           # Reusable dynamic header
├── 📄 style.css            # Single stylesheet for all pages
├── 📄 database_setup.sql   # SQL file for database creation
│
├── 📁 api/                  # Backend scripts
│   ├── 📄 db_connect.php
│   ├── 📄 register.php
│   ├── 📄 login.php
│   ├── 📄 logout.php
│   ├── 📄 submit_review.php
│   ├── 📄 schedule_appointment.php
│   ├── 📄 verify_nid.php
│   └── 📄 contact_handler.php
│
└── 📁 uploads/
    └── 📁 nid/
