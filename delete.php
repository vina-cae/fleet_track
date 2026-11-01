<?php
// ==================== DATABASE CONNECTION ====================
include 'db.php';
session_start();

// ==================== CHECK IF USER IS LOGGED IN ====================
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

// ==================== CHECK IF ID EXISTS IN URL ====================
if (isset($_GET['id'])) {
    
    $id = $_GET['id'];
    
    // ==================== DELETE QUERY ====================
    $sql = "DELETE FROM parcels WHERE id = '$id'";
    
    // ==================== EXECUTE QUERY ====================
    if (mysqli_query($conn, $sql)) {
        // Success alert
        echo "<script>
                alert('Parcel deleted successfully!');
                window.location.href='parcels.php';
              </script>";
    } else {
        // Error alert
        echo "<script>
                alert('Error deleting parcel.');
                window.location.href='parcels.php';
              </script>";
    }
}
?>