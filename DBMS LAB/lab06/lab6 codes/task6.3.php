<?php
$dsn = 'mysql:host=localhost;dbname=mohsinproject;charset=utf8';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    // Enable exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // INSERT
    if (isset($_POST['insert'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, created_at, updated_at) 
                               VALUES (?, ?, ?, NOW(), NOW())");
        $stmt->execute([$name, $email, $passwordHash]);
    }

    // UPDATE
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("UPDATE users SET name=?, email=?, password=?, updated_at=NOW() WHERE id=?");
        $stmt->execute([$name, $email, $passwordHash, $id]);
    }

    // DELETE
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];

        $stmt = $pdo->prepare("DELETE FROM users WHERE id=?");
        $stmt->execute([$id]);
    }

    // SELECT
    $stmt = $pdo->query("SELECT id, name, email, created_at FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users CRUD with PDO</title>
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
    <table border="1" cellpadding="5">
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Created At</th></tr>
        <?php if (!empty($users)) {
            foreach ($users as $user) {
                echo "<tr>
                        <td>{$user['id']}</td>
                        <td>{$user['name']}</td>
                        <td>{$user['email']}</td>
                        <td>{$user['created_at']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        } ?>
    </table>
</body>
</html>
