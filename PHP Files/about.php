<?php
session_start();
// Allow both viewers and admin to see About Me
if(!isset($_SESSION['viewer']) && !isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>About Me</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div class="logo">Jael's Portfolio</div>
    <div class="nav-links">
        <a href="home.php">Home</a>
        <a href="about.php">About Me</a>
        <a href="projects.php">Projects</a>
        <a href="skills.php">Skills</a>
        <a href="certificates.php">Certificates</a>
        <a href="contact.php">Contact</a>
        <?php if(isset($_SESSION['admin'])) echo '<a href="logout.php">Logout</a>'; ?>
        <?php if(!isset($_SESSION['admin'])) echo '<a href="login.php">Exit</a>'; ?>
    </div>
</div>

<div class="container">

   <!-- Intro Section -->
    <div class="intro-card">
        <div class="intro-left">
            <img src="images/jael_photo.png" alt="Jael Mae Bacolot">
        </div>
        <div class="intro-right">
        <h2>Jael Mae Bacolot</h2>
        <p>Bachelor of Science in Information Technology</p>
        <p>University of Mindanao</p>
        <img src="images/um_logo.jpg" alt="University Logo" class="institution-logo">
        <p class="tagline">Aspiring Web Developer & Designer</p>
         </div>
    </div>

    <!-- Biography -->
    <div class="about-card">
        <h2>BIOGRAPHY</h2>
        <p>Hello! I’m Jael, an aspiring web developer and designer. I enjoy creating visually appealing and functional web applications. My goal is to continue learning and improving my skills in both front-end and back-end development to make impactful projects.</p>
    </div>

    <!-- Interests and Aspirations -->
    <div class="about-card two-column">
        <div class="left-img">
            <img src="images/interests.jpg" alt="Interests" />
        </div>
        <div class="right-text">
            <h2>INTERESTS AND ASPIRATIONS</h2>
            <p>I love designing user interfaces, exploring new web technologies, and building projects that solve real-world problems. I aspire to become a full-stack developer and create innovative solutions in the tech industry.</p>
        </div>
    </div>

    <!-- Hobbies -->
    <div class="about-card">
        <h2 style="text-align:center;">HOBBIES</h2>
        <div class="hobbies-grid">
            <div class="hobby-card">
                <h3>Watching Anime</h3>
                <img src="images/anime.jpg" alt="Anime">
            </div>
            <div class="hobby-card">
                <h3>Watching K-drama</h3>
                <img src="images/kdrama.jpg" alt="K-Drama">
            </div>
            <div class="hobby-card">
                <h3>Gaming</h3>
                <img src="images/gaming.jpg" alt="Gaming">
            </div>
        </div>
    </div>

    <!-- Daily Routine -->
    <div class="about-card">
        <h2>DAILY ROUTINE</h2>
        <p>Wake up<br>
        Eat breakfast<br>
        Go to school<br>
        Eat lunch<br>
        Go home<br>
        Relax and rest<br>
        Study or work on projects<br>
        Eat dinner<br>
        Continue studying<br>
        Sleep</p>
    </div>

    <!-- Favorite Quotes -->
    <div class="about-card">
        <h2>FAVORITE QUOTES</h2>
        <p>"Hard work beats talent when talent doesn't work hard."</p>
        
    </div>

</div>

</body>
</html>