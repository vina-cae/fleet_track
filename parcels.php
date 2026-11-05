<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Parcel - Fleet Track</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="sidebar">
        <h2>🚚 Fleet</h2>
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="add_parcel.php" class="active">📦 Add Parcel</a>
        <a href="parcels.php">📋 Parcels</a>
        <a href="track.php">📍 Track</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

    <div class="main-content" style="display: flex; justify-content: center; align-items: flex-start;">
        <div class="form-container" style="width: 100%; max-width: 600px;">
            <h2 style="text-align: center; color: #00d2ff;">📦 Add Parcel</h2>
            
            <form action="save_parcel.php" method="POST">
                <div class="form-group">
                    <label>Sender Name</label>
                    <input type="text" name="sender" placeholder="Enter sender name" required>
                </div>
                
                <div class="form-group">
                    <label>Receiver Name</label>
                    <input type="text" name="receiver" placeholder="Enter receiver name" required>
                </div>
                
                <div class="form-group">
                    <label>Origin City</label>
                    <input type="text" name="origin" placeholder="Enter origin city" required>
                </div>
                
                <div class="form-group">
                    <label>Destination City</label>
                    <input type="text" name="destination" placeholder="Enter destination city" required>
                </div>
                
                <div class="form-group">
                    <label>Weight (kg)</label>
                    <input type="number" step="0.01" name="weight" placeholder="Enter weight" required>
                </div>

                <div class="btn-group" style="margin-bottom: 10px;">
                    <button type="submit" class="btn btn-blue">+ Add Parcel</button>
                    <button type="reset" class="btn btn-orange">✏️ Clear</button>
                </div>
                
                <!-- Replaced the massive gray button with a sleek text link -->
                <a href="dashboard.php" class="back-link">⬅ Back to Dashboard</a>
            </form>
        </div>
    </div>

</body>
</html>