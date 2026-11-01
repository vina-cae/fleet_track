<?php
// ==================== DATABASE CONNECTION ====================
include 'db.php';

// ==================== CHECK IF FORM IS SUBMITTED ====================
if (isset($_POST['sender'])) {
    
    // ==================== GET FORM DATA ====================
    $sender      = mysqli_real_escape_string($conn, $_POST['sender']);
    $receiver    = mysqli_real_escape_string($conn, $_POST['receiver']);
    $origin      = mysqli_real_escape_string($conn, $_POST['origin']);
    $destination = mysqli_real_escape_string($conn, $_POST['destination']);
    $weight      = mysqli_real_escape_string($conn, $_POST['weight']);
    
    // ==================== GENERATE TRACKING CODE ====================
    // Generates a code like "TRK-A1B2C3"
    $tracking_code = "TRK-" . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
    
    // ==================== INSERT QUERY ====================
    $sql = "INSERT INTO parcels (tracking_code, sender, receiver, origin, destination, weight, status) 
            VALUES ('$tracking_code', '$sender', '$receiver', '$origin', '$destination', '$weight', 'Pending')";
            
    // ==================== EXECUTE QUERY ====================
    if (mysqli_query($conn, $sql)) {
        // Success alert
        echo "<script>
                alert('Parcel added successfully! Tracking Code: $tracking_code');
                window.location.href='dashboard.php';
              </script>";
    } else {
        // Error alert
        echo "<script>
                alert('Error adding parcel. Please try again.');
                window.location.href='add_parcel.php';
              </script>";
    }
}
?>