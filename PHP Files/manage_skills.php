<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

// Database variables
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "portfolio_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Create table if it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS Skills_Tbl(
    id INT AUTO_INCREMENT PRIMARY KEY,
    skill_name VARCHAR(150) NOT NULL,
    description TEXT NOT NULL
)");

// Initialize variables
$edit_id = "";
$edit_skill = "";
$edit_description = "";

// Insert or Update
if(isset($_POST['submit'])){
    $id = $_POST['id'] ?? '';
    $skill = $_POST['skill_name'];
    $desc = $_POST['description'];

    if($id == ""){
        $conn->query("INSERT INTO Skills_Tbl(skill_name, description) VALUES('$skill','$desc')");
    } else {
        $conn->query("UPDATE Skills_Tbl SET skill_name='$skill', description='$desc' WHERE id=$id");
    }
}

// Delete
if(isset($_POST['delete_id'])){
    $id = (int)$_POST['delete_id'];
    $conn->query("DELETE FROM Skills_Tbl WHERE id=$id");
}

// Load for edit
if(isset($_POST['edit_id'])){
    $edit_id = (int)$_POST['edit_id'];
    $row = $conn->query("SELECT * FROM Skills_Tbl WHERE id=$edit_id")->fetch_assoc();
    $edit_skill = $row['skill_name'];
    $edit_description = $row['description'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Skills</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <h2>Admin Dashboard</h2>
</nav>

<a href="admin_dashboard.php">< Back to Dashboard</a>

<hr>

<h2><?php echo $edit_id ? "Edit Skill" : "Add Skill"; ?></h2>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $edit_id; ?>">

    <input type="text" name="skill_name" placeholder="Skill Name" value="<?php echo $edit_skill; ?>" required>
    <textarea name="description" placeholder="Description" required><?php echo $edit_description; ?></textarea>

    <button type="submit" name="submit"><?php echo $edit_id ? "Update" : "Save"; ?></button>
</form>

<hr>

<h2>Skill List</h2>
<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Skill Name</th>
    <th>Description</th>
    <th>Action</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM Skills_Tbl");
while($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['skill_name']."</td>";
    echo "<td>".$row['description']."</td>";
    echo "<td>
        <form method='POST' style='display:inline'>
            <input type='hidden' name='edit_id' value='".$row['id']."'>
            <button type='submit'>Edit</button>
        </form>
        <form method='POST' style='display:inline'>
            <input type='hidden' name='delete_id' value='".$row['id']."'>
            <button type='submit'>Delete</button>
        </form>
    </td>";
    echo "</tr>";
}
?>

</table>

</body>
</html>

<?php $conn->close(); ?>