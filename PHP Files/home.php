<?php
session_start();
if(!isset($_SESSION['viewer']) && !isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="navbar">
    <div class="logo">Jael's Portfolio</div>
    <div class="nav-links">
        <a href="home.php">Home</a>
        <a href="about.php">About Me</a>
        <a href="projects.php">Projects</a>
        <a href="skills.php">Skills</a>
        <a href="certificates.php">Certificates</a>
        <a href="contact.php">Contact</a>
        <a href="login.php" class="exit-btn">Exit</a>
        <?php if(isset($_SESSION['admin'])) echo '<a href="logout.php">Logout</a>'; ?>
    </div>
</div>


<section class="hero">
  <div class="hero-text">
    <h1>Welcome to my personal portfolio!</h1>
    <p>I am Jael, an aspiring web developer and designer,
        passionate about creating beautiful and functional digital experiences.
        Here, you can explore my projects, discover my skills, 
        get to know my journey in the world of technology and design. 
        Thank you for visiting — I hope you enjoy exploring my work!</p>
</section>

</div>
</body>
</html>