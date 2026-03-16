<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="navbar">
    <div class="logo">Jael's Portfolio</div>
    <div class="nav-links">
        
        <?php if(isset($_SESSION['admin'])) echo '<a href="logout.php">Logout</a>'; ?>
    </div>
</div>

<div class="container admin-dashboard">
    <h1>Admin Dashboard</h1>
    <ul>
        <li><a href="manage_projects.php">Manage Projects</a></li>
        <li><a href="manage_skills.php">Manage Skills</a></li>
        <li><a href="manage_certificates.php">Manage Certificates</a></li>
        
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>
</body>
</html>