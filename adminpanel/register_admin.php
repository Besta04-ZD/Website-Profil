<?php

require "../koneksi.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<style>

.w-400{
    width: 400px;
}
</style>


<body class="main d-flex justify-content-center align-items-center vh-100">
    <div class="w-400 p-5 shadow rounded">
        <div class="d-flex justify-content-center align-items-center flex-column">
                <img src="../image1/chat.png" class="w-25">
                <h3 class="display-4 fs-1 text-center">SignUp</h3>
        </div>
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select class="form-control" name="role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary form-control">SignUp</button>
            </form>

    <div class="mt-3" style="width: 300px">
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email    = $_POST['email'];
                $username = $_POST['username'];
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $role = $_POST['role'];

                $stmt = $con->prepare("INSERT INTO login (email, username, password, role) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $email, $username, $password, $role);
                $stmt->execute();
                header("Location: login.php");
            }
        ?>
    </div>

</body>
</html>
