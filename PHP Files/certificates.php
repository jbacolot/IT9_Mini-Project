<?php
$conn = new mysqli("localhost","root","","portfolio_db");
if($conn->connect_error) die("Connection failed: ".$conn->connect_error);

$result = $conn->query("SELECT * FROM Certificates_Tbl");
?>

<!DOCTYPE html>
<html>
<head>
<title>My Certificates</title>
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

<div class="container">
<h1>My Certificates</h1>

<div class="projects-grid">
<?php while($row = $result->fetch_assoc()){ ?>
<div class="project-card">
    <h3><?php echo $row['title']; ?></h3>
    <?php if(!empty($row['image'])){ ?>
    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>">
    <?php } ?>
</div>
<?php } ?>
</div>

</div>
</body>
</html>