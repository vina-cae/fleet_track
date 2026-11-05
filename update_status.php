<?php
// ==================== DATABASE CONNECTION ====================
include 'db.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();

// ==================== CHECK IF ID AND STATUS EXIST IN URL ====================
if (isset($_GET['id']) && isset($_GET['status'])) {
    
    // ==================== GET DATA FROM URL ====================
    $id = $_GET['id'];
    $status = $_GET['status'];
    
    // ==================== UPDATE QUERY ====================
    $sql = "UPDATE parcels SET status = '$status' WHERE id = '$id'";
    
    // ==================== EXECUTE QUERY ====================
    if (mysqli_query($conn, $sql)) {
        // Success alert and redirect back to parcels page
        echo "<script>
                alert('Parcel status updated to $status!');
                window.location.href='parcels.php';
              </script>";
    } else {
        // Error alert
        echo "<script>
                alert('Error updating status. Please try again.');
                window.location.href='parcels.php';
              </script>";
    }
}
?>