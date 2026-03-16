<?php
session_start();

$admin_user = "admin";
$admin_pass = "1234";

if(isset($_POST['role'])){
    $role = $_POST['role'];

    if($role=="viewer"){
        $_SESSION['viewer'] = true;
        header("Location: home.php");
        exit;
    }

    if($role=="admin"){
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        if($username==$admin_user && $password==$admin_pass){
            $_SESSION['admin'] = true;
            header("Location: admin_dashboard.php");
            exit;
        } else {
            $error = "Invalid admin credentials!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-container">
    <div class="card">
        <h2>Login</h2>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Admin Username">
            <input type="password" name="password" placeholder="Admin Password">
            <div>
                <button type="submit" name="role" value="admin">Login as Admin</button>
                <button type="submit" name="role" value="viewer">View Only</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>