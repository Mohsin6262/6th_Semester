<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mohsinproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// INSERT
if (isset($_POST['insert'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password, created_at, updated_at) 
            VALUES ('$name', '$email', '$password', NOW(), NOW())";
    $conn->query($sql);
}

// UPDATE
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "UPDATE users 
            SET name='$name', email='$email', password='$password', updated_at=NOW() 
            WHERE id=$id";
    $conn->query($sql);
}

// DELETE
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM users WHERE id=$id";
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users CRUD - Mohsin Project</title>
</head>
<body>
    <h2>Insert User</h2>
    <form method="post">
        Name: <input type="text" name="name" required><br>
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" name="insert" value="Insert">
    </form>

    <h2>Update User</h2>
    <form method="post">
        ID: <input type="number" name="id" required><br>
        New Name: <input type="text" name="name"><br>
        New Email: <input type="email" name="email"><br>
        New Password: <input type="password" name="password"><br>
        <input type="submit" name="update" value="Update">
    </form>

    <h2>Delete User</h2>
    <form method="post">
        ID: <input type="number" name="id" required><br>
        <input type="submit" name="delete" value="Delete">
    </form>

    <h2>All Users</h2>
    <?php
    $sql = "SELECT id, name, email, created_at FROM users";
    $result = $conn->query($sql);

    echo "<table border='1' cellpadding='5'><tr><th>ID</th><th>Name</th><th>Email</th><th>Created At</th></tr>";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['created_at']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No users found</td></tr>";
    }
    echo "</table>";

    $result->free();
    $conn->close();
    ?>
</body>
</html>
