<?php
// ==================== DATABASE CONNECTION ====================
include 'db.php';

// ==================== FETCH STATISTICS ====================
$total_query = mysqli_query($conn, "SELECT COUNT(*) as count FROM parcels");
$total_parcels = mysqli_fetch_assoc($total_query)['count'];

$transit_query = mysqli_query($conn, "SELECT COUNT(*) as count FROM parcels WHERE status='Transit'");
$in_transit = mysqli_fetch_assoc($transit_query)['count'];

$delivered_query = mysqli_query($conn, "SELECT COUNT(*) as count FROM parcels WHERE status='Delivered'");
$delivered = mysqli_fetch_assoc($delivered_query)['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Fleet Track</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>🚚 Fleet</h2>
        <a href="dashboard.php" class="active">🏠 Dashboard</a>
        <a href="#">📦 Add Parcel</a>
        <a href="#">📋 Parcels</a>
        <a href="#">📍 Track</a>
        <a href="#">🚪 Logout</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="header">
            <h1>👋 Welcome, Admin</h1>
        </div>

        <!-- STAT CARDS -->
        <div class="stats-grid">
            <div class="stat-card card-blue">
                <h3>Total Parcels</h3>
                <p><?php echo $total_parcels; ?></p>
            </div>
            <div class="stat-card card-orange">
                <h3>In Transit</h3>
                <p><?php echo $in_transit; ?></p>
            </div>
            <div class="stat-card card-green">
                <h3>Delivered</h3>
                <p><?php echo $delivered; ?></p>
            </div>
        </div>
    </div>

</body>
</html>