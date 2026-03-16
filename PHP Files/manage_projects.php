<?php 
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio_db";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}

/* CREATE TABLE */

$conn->query("CREATE TABLE IF NOT EXISTS Projects_Tbl(
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(150) NOT NULL,
purpose TEXT NOT NULL,
github_link VARCHAR(255),
image LONGBLOB
)");

/* INSERT OR UPDATE */

if(isset($_POST['submit'])){

$id      = $_POST['id'] ?? '';
$title   = $_POST['title'];
$purpose = $_POST['purpose'];
$link    = $_POST['github_link'];

$image = "";

if(!empty($_FILES['image']['tmp_name'])){
$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
}

if($id == ""){

$conn->query("INSERT INTO Projects_Tbl(title,purpose,github_link,image)
VALUES('$title','$purpose','$link','$image')");

}else{

if($image != ""){
$conn->query("UPDATE Projects_Tbl
SET title='$title',
purpose='$purpose',
github_link='$link',
image='$image'
WHERE id=$id");
}else{
$conn->query("UPDATE Projects_Tbl
SET title='$title',
purpose='$purpose',
github_link='$link'
WHERE id=$id");
}

}
}

/* DELETE */

if(isset($_POST['delete_id'])){
$id = (int)$_POST['delete_id'];
$conn->query("DELETE FROM Projects_Tbl WHERE id=$id");
}

/* LOAD FOR EDIT */

$edit_id="";
$edit_title="";
$edit_purpose="";
$edit_link="";

if(isset($_POST['edit_id'])){

$edit_id = (int)$_POST['edit_id'];

$result = $conn->query("SELECT * FROM Projects_Tbl WHERE id=$edit_id");

$row = $result->fetch_assoc();

$edit_title = $row['title'];
$edit_purpose = $row['purpose'];
$edit_link = $row['github_link'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Projects</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<nav class="navbar">

<h2>Admin Dashboard</h2>



</nav>

<a href="admin_dashboard.php">< Back to Dashboard</a>

<hr>

<h2><?php echo $edit_id ? "Edit Project" : "Add Project"; ?></h2>

<form method="POST" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?php echo $edit_id; ?>">

<input type="text" name="title"
value="<?php echo $edit_title; ?>"
placeholder="Project Title" required>

<textarea name="purpose"
placeholder="Purpose"
required><?php echo $edit_purpose; ?></textarea>

<input type="text" name="github_link"
value="<?php echo $edit_link; ?>"
placeholder="GitHub / Figma Link">

<input type="file" name="image">

<button type="submit" name="submit">
<?php echo $edit_id ? "Update" : "Save"; ?>
</button>

</form>

<hr>

<h2>Project List</h2>

<table border="1" cellpadding="10">

<tr>
<th>ID</th>
<th>Title</th>
<th>Purpose</th>
<th>Image</th>
<th>Action</th>
</tr>

<?php

$result = $conn->query("SELECT * FROM Projects_Tbl");

while($row = $result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row['id']."</td>";
echo "<td>".$row['title']."</td>";
echo "<td>".$row['purpose']."</td>";

echo "<td>
<img width='80'
src='data:image/jpeg;base64,".base64_encode($row['image'])."'>
</td>";

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