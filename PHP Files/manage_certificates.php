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

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) die("Connection failed: ".$conn->connect_error);

$conn->query("CREATE TABLE IF NOT EXISTS Certificates_Tbl (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    image LONGBLOB
)");

if(isset($_POST['submit'])){
    $id = $_POST['id'] ?? '';
    $title = $_POST['title'];
    $image = "";

    if(!empty($_FILES['image']['tmp_name'])){
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    }

    if($id == ""){
        $conn->query("INSERT INTO Certificates_Tbl(title, image) VALUES('$title','$image')");
    } else {
        if($image != ""){
            $conn->query("UPDATE Certificates_Tbl SET title='$title', image='$image' WHERE id=$id");
        } else {
            $conn->query("UPDATE Certificates_Tbl SET title='$title' WHERE id=$id");
        }
    }
}

if(isset($_POST['delete_id'])){
    $id = (int)$_POST['delete_id'];
    $conn->query("DELETE FROM Certificates_Tbl WHERE id=$id");
}

$edit_id = $edit_title = "";
if(isset($_POST['edit_id'])){
    $edit_id = (int)$_POST['edit_id'];
    $row = $conn->query("SELECT * FROM Certificates_Tbl WHERE id=$edit_id")->fetch_assoc();
    $edit_title = $row['title'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Certificates</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <h2>Admin Dashboard</h2>
</nav>

<a href="admin_dashboard.php">< Back to Dashboard</a>
<hr>

<h2><?php echo $edit_id ? "Edit Certificate" : "Add Certificate"; ?></h2>

<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $edit_id; ?>">

    <input type="text" name="title" value="<?php echo $edit_title; ?>" placeholder="Certificate Title" required>
    <input type="file" name="image">

    <button type="submit" name="submit"><?php echo $edit_id ? "Update" : "Save"; ?></button>
</form>

<hr>

<h2>Certificates List</h2>
<table border="1" cellpadding="10">
<tr>
<th>ID</th>
<th>Title</th>
<th>Image</th>
<th>Action</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM Certificates_Tbl");
while($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['title']."</td>";
    echo "<td>";
    if(!empty($row['image'])){
        echo "<img width='80' src='data:image/jpeg;base64,".base64_encode($row['image'])."'>";
    }
    echo "</td>";
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