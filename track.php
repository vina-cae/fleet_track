<?php
include 'db.php';

$parcel = null;
$error = "";

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

    <div class="sidebar">
        <h2>🚚 Fleet</h2>
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="add_parcel.php">📦 Add Parcel</a>
        <a href="parcels.php">📋 Parcels</a>
        <a href="track.php" class="active">📍 Track</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>📍 Track Parcel</h1>
        </div>

        <div class="form-container" style="max-width: 700px; margin: 0 auto 30px auto;">
            <!-- Fixed flexbox so input and button look good together -->
            <form method="GET" action="track.php" style="display: flex; gap: 15px; align-items: center;">
                <input type="text" name="track_code" placeholder="Enter Tracking Code (e.g. TRK-XXXXXX)" style="flex: 1; margin: 0; padding: 10px; border-radius: 8px;">
                <button type="submit" class="btn btn-blue" style="flex: 0 0 auto; padding: 12px 30px; margin: 0;">Search</button>
            </form>
        </div>

        <?php if ($error): ?>
            <div style="background: rgba(255, 77, 77, 0.2); border: 1px solid #ff4d4d; color: #ff4d4d; padding: 15px; border-radius: 8px; max-width: 700px; margin: 0 auto; text-align: center; font-weight: bold;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if ($parcel): ?>
            <div class="table-container" style="max-width: 700px; margin: 0 auto;">
                <h3 style="color: #00d2ff; margin-bottom: 20px; text-align: center;">Parcel Details: <?php echo $parcel['tracking_code']; ?></h3>
                <table>
                    <tr>
                        <td style="text-align: left; font-weight: bold; width: 30%; color: #8ba3b5;">Sender:</td>
                        <td style="text-align: left;"><?php echo $parcel['sender']; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-weight: bold; color: #8ba3b5;">Receiver:</td>
                        <td style="text-align: left;"><?php echo $parcel['receiver']; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-weight: bold; color: #8ba3b5;">Origin:</td>
                        <td style="text-align: left;"><?php echo $parcel['origin']; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-weight: bold; color: #8ba3b5;">Destination:</td>
                        <td style="text-align: left;"><?php echo $parcel['destination']; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-weight: bold; color: #8ba3b5;">Status:</td>
                        <td style="text-align: left; font-weight: bold;">
                            <span style="color: <?php echo $parcel['status'] == 'Delivered' ? '#00b04f' : ($parcel['status'] == 'Transit' ? '#00d2ff' : '#ff7e00'); ?>;">
                                <?php echo $parcel['status']; ?>
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        <?php endif; ?>

    </div>
</body>
</html>