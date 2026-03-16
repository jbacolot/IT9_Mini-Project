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
    <title>Contact</title>
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



<div class="contact-card">
    <h2>My Contact Information</h2>
    <br>

    <div class="contact-icons">
        <a href="mailto:bacolotjaelmae@gmail.com" class="contact-icon">
            <img src="images/gmail.png" alt="Email">
        </a>
        <a href="https://github.com/jbacolot" class="contact-icon" target="_blank">
            <img src="images/github.png" alt="GitHub">
        </a>
        <a href="https://www.linkedin.com/in/jael-mae-bacolot-4a3694331/" class="contact-icon" target="_blank">
            <img src="images/linkedin.png" alt="LinkedIn">
        </a>
        <a href="https://www.instagram.com/its_jaellyy/" class="contact-icon" target="_blank">
            <img src="images/instagram.png" alt="Instagram">
        </a>
    </div>

    <div class="contact-info">
        <p>Email: bacolotjaelmae@gmail.com</p>
        <p>GitHub: <a href="https://github.com/jbacolot" target="_blank">jbacolot</a></p>
        <p>LinkedIn: <a href="https://www.linkedin.com/in/jael-mae-bacolot-4a3694331/" target="_blank">Jael Mae Bacolot</a></p>
        <p>Instagram: <a href="https://www.instagram.com/its_jaellyy/" target="_blank">@its_jaellyy</a></p>
    </div>

</div>
</body>
</html>