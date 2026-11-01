<?php
include 'db.php';

$parcel = null;
$error = "";

// ==================== SEARCH LOGIC ====================
if (isset($_GET['track_code'])) {
    $code = mysqli_real_escape_string($conn, $_GET['track_code']);
    
    if (empty($code)) {
        $error = "Please enter a tracking code.";
    } else {
        $query = mysqli_query($conn, "SELECT * FROM parcels WHERE tracking_code = '$code' LIMIT 1");
        if (mysqli_num_rows($query) > 0) {
            $parcel = mysqli_fetch_assoc($query);
        } else {
            $error = "Tracking code not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Track Parcel - Fleet Track</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>🚚 Fleet</h2>
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="add_parcel.php">📦 Add Parcel</a>
        <a href="parcels.php">📋 Parcels</a>
        <a href="track.php" class="active">📍 Track</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="header">
            <h1>📍 Track Parcel</h1>
        </div>

        <!-- SEARCH FORM -->
        <div class="form-container" style="margin: 0 0 20px 0;">
            <form method="GET" action="track.php" style="display: flex; gap: 10px;">
                <input type="text" name="track_code" placeholder="Enter Tracking Code (e.g. TRK-XXXXXX)" style="flex: 1; margin: 0;">
                <button type="submit" class="btn btn-blue" style="flex: 0; padding: 12px 20px;">Search</button>
            </form>
        </div>

        <!-- ERROR MESSAGE -->
        <?php if ($error): ?>
            <div style="background: #ff4d4d; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <!-- RESULT DETAILS -->
        <?php if ($parcel): ?>
            <div class="table-container" style="max-width: 600px; margin: 0 auto;">
                <h3 style="color: #00d2ff; margin-bottom: 15px;">Parcel Details: <?php echo $parcel['tracking_code']; ?></h3>
                <table>
                    <tr>
                        <td style="text-align: left; font-weight: bold;">Sender:</td>
                        <td style="text-align: left;"><?php echo $parcel['sender']; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-weight: bold;">Receiver:</td>
                        <td style="text-align: left;"><?php echo $parcel['receiver']; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-weight: bold;">Origin:</td>
                        <td style="text-align: left;"><?php echo $parcel['origin']; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-weight: bold;">Destination:</td>
                        <td style="text-align: left;"><?php echo $parcel['destination']; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-weight: bold;">Status:</td>
                        <td style="text-align: left; color: <?php echo $parcel['status'] == 'Delivered' ? '#00b04f' : '#ff7e00'; ?>; font-weight: bold;">
                            <?php echo $parcel['status']; ?>
                        </td>
                    </tr>
                </table>
            </div>
        <?php endif; ?>

    </div>
</body>
</html>