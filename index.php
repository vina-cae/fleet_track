<?php
include 'db.php';
session_start();

// If already logged in, go straight to dashboard
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Simple login check (matching your reference files)
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['user'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Fleet Track</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #0b1a24;">

    <div class="form-container" style="width: 400px;">
        <h2>🚚 Fleet Track Login</h2>
        
        <?php if($error): ?>
            <div style="background: #ff4d4d; color: white; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center; font-size: 14px;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter username" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter password" required>
            </div>

            <div class="btn-group">
                <button type="submit" name="login" class="btn btn-blue">Login</button>
            </div>
        </form>
        
        <p style="text-align: center; margin-top: 15px; font-size: 12px; color: #8ba3b5;">
            Use: <b>admin</b> / <b>admin123</b>
        </p>
    </div>

</body>
</html>