<?php
include 'db.php';

// NO SESSION START. This page is fully public.

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
            $error = "Tracking code not found. Please check and try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Track Your Parcel - Fleet Track</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="display: flex; justify-content: center; align-items: flex-start; min-height: 100vh; background-color: #0b1a24; padding-top: 80px;">

    <!-- NO SIDEBAR. Full width centered content. -->
    <div style="width: 100%; max-width: 700px;">
        
        <div style="text-align: center; margin-bottom: 40px;">
            <h1 style="color: #00d2ff; font-size: 36px; margin-bottom: 10px;">🚚 Fleet Track</h1>
            <p style="color: #8ba3b5; font-size: 16px;">Enter your tracking code below to check your parcel status.</p>
        </div>

        <!-- SEARCH FORM -->
        <div class="form-container" style="margin-bottom: 30px; background: #0a151e;">
            <form method="GET" action="track.php" style="display: flex; gap: 15px; align-items: center;">
                <input type="text" name="track_code" placeholder="Enter Tracking Code (e.g. TRK-XXXXXX)" style="flex: 1; margin: 0; font-size: 16px; padding: 15px; border-radius: 8px;">
                <button type="submit" class="btn btn-blue" style="flex: 0 0 auto; padding: 15px 35px; margin: 0; font-size: 16px;">Search</button>
            </form>
        </div>

        <!-- ERROR MESSAGE -->
        <?php if ($error): ?>
            <div style="background: rgba(255, 77, 77, 0.2); border: 1px solid #ff4d4d; color: #ff4d4d; padding: 15px; border-radius: 8px; text-align: center; font-weight: bold; margin-bottom: 30px;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <!-- RESULT -->
        <?php if ($parcel): ?>
            <div class="table-container" style="background: #0a151e; box-shadow: 0 8px 32px rgba(0, 210, 255, 0.15);">
                <h3 style="color: #00d2ff; margin-bottom: 20px; text-align: center;">Parcel Details: <?php echo $parcel['tracking_code']; ?></h3>
                <table>
                    <tr>
                        <td style="text-align: left; font-weight: bold; width: 30%; color: #8ba3b5;">Sender:</td>
                        <td style="text-align: left; font-size: 16px;"><?php echo $parcel['sender']; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-weight: bold; color: #8ba3b5;">Receiver:</td>
                        <td style="text-align: left; font-size: 16px;"><?php echo $parcel['receiver']; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-weight: bold; color: #8ba3b5;">Origin:</td>
                        <td style="text-align: left; font-size: 16px;"><?php echo $parcel['origin']; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-weight: bold; color: #8ba3b5;">Destination:</td>
                        <td style="text-align: left; font-size: 16px;"><?php echo $parcel['destination']; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-weight: bold; color: #8ba3b5;">Status:</td>
                        <td style="text-align: left; font-weight: bold; font-size: 18px;">
                            <span style="color: <?php echo $parcel['status'] == 'Delivered' ? '#00b04f' : ($parcel['status'] == 'Transit' ? '#00d2ff' : '#ff7e00'); ?>;">
                                <?php echo $parcel['status']; ?>
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        <?php endif; ?>

        <!-- ADMIN LOGIN LINK AT BOTTOM -->
        <div style="text-align: center; margin-top: 50px;">
            <a href="index.php?logout=1" style="color: #5a6b7a; text-decoration: none; font-size: 14px;">Admin Login &rarr;</a>
        </div>

    </div>

</body>
</html>