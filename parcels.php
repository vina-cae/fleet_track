<?php
include 'db.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
// Fetch all parcels from the database
$query = mysqli_query($conn, "SELECT * FROM parcels ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Parcels - Fleet Track</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>🚚 Fleet</h2>
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="add_parcel.php">📦 Add Parcel</a>
        <a href="parcels.php" class="active">📋 Parcels</a>
        <a href="track.php">📍 Track</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="header">
            <h1>📋 All Parcels</h1>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Tracking</th>
                        <th>Sender</th>
                        <th>Receiver</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?php echo $row['tracking_code']; ?></td>
                        <td><?php echo $row['sender']; ?></td>
                        <td><?php echo $row['receiver']; ?></td>
                        <td>
                            <span style="color: <?php echo $row['status'] == 'Delivered' ? '#00b04f' : ($row['status'] == 'Transit' ? '#00d2ff' : '#ff7e00'); ?>;">
                                <?php echo $row['status']; ?>
                            </span>
                        </td>
                        <td>
                            <?php if($row['status'] != 'Transit' && $row['status'] != 'Delivered'): ?>
                                <a href="update_status.php?id=<?php echo $row['id']; ?>&status=Transit" class="action-btn btn-transit">🚚 Transit</a>
                            <?php endif; ?>
                            
                            <?php if($row['status'] != 'Delivered'): ?>
                                <a href="update_status.php?id=<?php echo $row['id']; ?>&status=Delivered" class="action-btn btn-done">✅ Done</a>
                            <?php endif; ?>

                            <!-- NEW DELETE BUTTON -->
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="action-btn btn-delete" onclick="return confirm('Are you sure you want to delete this parcel?');">🗑️ Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
