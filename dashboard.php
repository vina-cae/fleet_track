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

// Fetch recent parcels for the table
$recent_query = mysqli_query($conn, "SELECT * FROM parcels ORDER BY created_at DESC LIMIT 5");
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

        <!-- RECENT PARCELS TABLE -->
        <div style="background: #112431; border-radius: 12px; padding: 20px; margin-bottom: 30px;">
            <h3 style="margin-bottom: 15px; color: #00d2ff;">📋 Recent Parcels</h3>
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #0082c8; color: white;">
                        <th style="padding: 12px; border-radius: 8px 0 0 8px;">Tracking</th>
                        <th style="padding: 12px;">Sender</th>
                        <th style="padding: 12px;">Receiver</th>
                        <th style="padding: 12px;">Status</th>
                        <th style="padding: 12px; border-radius: 0 8px 8px 0;">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($recent_query)): ?>
                    <tr style="border-bottom: 1px solid #1a364a;">
                        <td style="padding: 12px;"><?php echo $row['tracking_code']; ?></td>
                        <td style="padding: 12px;"><?php echo $row['sender']; ?></td>
                        <td style="padding: 12px;"><?php echo $row['receiver']; ?></td>
                        <td style="padding: 12px;">
                            <span style="color: <?php echo $row['status'] == 'Delivered' ? '#00b04f' : '#ff7e00'; ?>;">
                                <?php echo $row['status']; ?>
                            </span>
                        </td>
                        <td style="padding: 12px;"><?php echo date('d M Y, h:i A', strtotime($row['created_at'])); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        
    </div>
</body>
</html>