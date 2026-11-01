<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Parcel - Fleet Track</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>🚚 Fleet</h2>
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="add_parcel.php" class="active">📦 Add Parcel</a>
        <a href="#">📋 Parcels</a>
        <a href="#">📍 Track</a>
        <a href="#">🚪 Logout</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="form-container">
            <h2>📦 Add Parcel</h2>
            
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

                <div class="btn-group">
                    <button type="submit" class="btn btn-blue">+ Add Parcel</button>
                    <button type="reset" class="btn btn-orange">✏️ Clear</button>
                </div>
                
                <div class="btn-group">
                    <a href="dashboard.php" class="btn btn-gray">⬅ Back to Dashboard</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>