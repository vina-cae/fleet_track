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

// Fetch data for the analytics chart
$status_query = mysqli_query($conn, "SELECT status, COUNT(*) as count FROM parcels GROUP BY status");
$chart_data = [];
while ($row = mysqli_fetch_assoc($status_query)) {
    $chart_data[$row['status']] = $row['count'];
}
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
        <a href="add_parcel.php">📦 Add Parcel</a>
        <a href="parcels.php">📋 Parcels</a>      
        <a href="track.php">📍 Track</a>
        <a href="logout.php">🚪 Logout</a>
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

        <!-- ANALYTICS CHART -->
        <div style="background: #112431; border-radius: 12px; padding: 20px;">
            <h3 style="margin-bottom: 15px; color: #00d2ff;">📊 Analytics</h3>
            <div style="display: flex; align-items: flex-end; height: 150px; gap: 20px; padding-top: 20px;">
                <?php 
                $max_count = count($chart_data) > 0 ? max($chart_data) : 0;
                foreach($chart_data as $status => $count): 
                    $height = $max_count > 0 ? ($count / $max_count) * 100 : 10; 
                ?>
                    <div style="flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: flex-end; height: 100%;">
                        <div style="background: #0082c8; width: 100%; height: <?php echo $height; ?>%; border-radius: 5px 5px 0 0;"></div>
                        <p style="margin-top: 10px; font-size: 12px;"><?php echo $status; ?></p>
                        <p style="font-size: 14px; font-weight: bold;"><?php echo $count; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
    </div>
</body>
</html>