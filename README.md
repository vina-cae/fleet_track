# Fleet Track - Parcel Management System

## Project Description
Fleet Track is a full-stack web application designed for logistics companies to manage, track, and update parcel deliveries. It features a secure admin dashboard with real-time analytics, a parcel registration form, a status update table (Transit/Done), and a public tracking page for customers to check their packages.

## Tech Stack
- **Frontend:** HTML5, CSS3, JavaScript (Vanilla)
- **Backend:** PHP (Procedural)
- **Database:** MySQL (via XAMPP locally, InfinityFree online)
- **Map Integration:** Leaflet.js (OpenStreetMap)
- **Version Control:** Git & GitHub

## Key Features
- **Secure Admin Login:** Only admins can access the dashboard routes.
- **Dashboard Analytics:** Live counting of Total, In Transit, and Delivered parcels with a dynamic bar chart.
- **Full CRUD Operations:** Admins can Create, Read, Update (Transit/Done), and Delete parcels.
- **Public Tracking:** Customers can search for their parcels using a unique tracking code without logging in.
- **Interactive Map:** Automatically converts the Origin and Destination cities into coordinates and draws the route.
- **Responsive Dark UI:** A modern dark theme built from scratch with glowing shadows and Blue/Pink toggle options.

## Live Deployment
- **Live URL:** https://parcel-tracker.infinityfreeapp.com

## Deployment Steps (InfinityFree)
To deploy this application to a live server:
1. Create a free hosting account at InfinityFree.net.
2. Go to the Control Panel -> **Online File Manager** and open the `htdocs` folder.
3. Upload all project files (`index.php`, `dashboard.php`, `style.css`, etc.) into `htdocs`.
4. Go to the Control Panel -> **MySQL Databases** and create a new database.
5. Open **phpMyAdmin**, select your database, and import the `database.sql` file.
6. Edit `db.php` on the live server to match your new InfinityFree database credentials (Hostname, Username, Password, Database Name).
7. Visit your live URL to test the application.

## Developer
- **Vina Cae Dagsaan** (BSCpE 4B)