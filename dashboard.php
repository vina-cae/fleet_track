<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Fleet Track</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <h2>🚚 Fleet</h2>
        <a href="dashboard.php" class="active">🏠 Dashboard</a>
        <a href="#">📦 Add Parcel</a>
        <a href="#">📋 Parcels</a>
        <a href="#">📍 Track</a>
        <a href="#">🚪 Logout</a>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>👋 Welcome, Admin</h1>
        </div>

        <div class="stats-grid">
            <div class="stat-card card-blue">
                <h3>Total Parcels</h3>
                <p>2</p> <!-- Dummy data for now -->
            </div>
            <div class="stat-card card-orange">
                <h3>In Transit</h3>
                <p>0</p>
            </div>
            <div class="stat-card card-green">
                <h3>Delivered</h3>
                <p>1</p>
            </div>
        </div>
    </div>
</body>
</html>