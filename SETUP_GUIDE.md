# Ultras E-commerce Website Setup Guide

This guide will walk you through the steps required to set up and run the Ultras e-commerce website on a new computer.

## 1. Prerequisites

Before you begin, you will need to install **XAMPP**, which is a free and open-source cross-platform web server solution stack package developed by Apache Friends. XAMPP provides you with a local development environment that includes:

*   **Apache:** The web server that will host the website.
*   **MariaDB:** The database system where your product and customer data will be stored.
*   **PHP:** The server-side scripting language that the website is built with.

You can download XAMPP from the official website: [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html)

## 2. File Setup

Once you have installed XAMPP, you will need to place the project files in the correct directory so that the Apache web server can find them.

1.  Navigate to the directory where you installed XAMPP.
2.  Find the `htdocs` folder. This is the root directory for all of your web projects.
3.  Copy the entire `ultras-1.0.0` project folder into the `htdocs` directory.

The final path to your project should look something like this: `C:/xampp/htdocs/ultras-1.0.0/`

## 3. Database Setup

The next step is to create the necessary databases and tables for the website. I have created a script that will do this for you automatically.

1.  **Start XAMPP:** Open the XAMPP Control Panel and start the **Apache** and **MySQL** modules.
2.  **Run the Setup Script:** Open your web browser and navigate to the following URL:
    [http://localhost/ultras-1.0.0/setup.php](http://localhost/ultras-1.0.0/setup.php)

    You should see a success message indicating that the databases and tables were created successfully.

## 4. Seed the Database

Now that the database is set up, you need to populate it with the product data. I have created a script for this as well.

1.  **Run the Seeding Script:** In your web browser, navigate to the following URL:
    [http://localhost/ultras-1.0.0/seed_from_static.php](http://localhost/ultras-1.0.0/seed_from_static.php)

    You should see a message that says "Products seeded successfully!".

## 5. Running the Website

You are now ready to run the website.

1.  **Customer View:** To view the main website, navigate to:
    [http://localhost/ultras-1.0.0/](http://localhost/ultras-1.0.0/)
2.  **Admin Panel:** To access the admin login page, navigate to:
    [http://localhost/ultras-1.0.0/admin_login.php](http://localhost/ultras-1.0.0/admin_login.php)

    The default admin credentials are:
    *   **Username:** admin
    *   **Password:** password

    You can change these credentials by editing the `admins` table in the `ultras_admin` database using a tool like phpMyAdmin, which is included with XAMPP.

That's it! Your e-commerce website should now be fully functional on your new computer.
