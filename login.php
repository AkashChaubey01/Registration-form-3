<?php
include 'database.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = 'Please fill in all fields.';
    } else {
        $query = "SELECT username, password FROM authLogin WHERE username='$username'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            $hashed_password = $user_data['password'];

            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['username'] = $username;
                header('Location: home.php');
                exit;
            } else {
                $error = 'Invalid password.';
            }
        } else {
            $error = 'User not found.';
        }
    }
}
?>

<!-- Login form -->
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h1 {
        display: flex;
        justify-content: center;
        }
        .login-form {
            width: 300px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-form input[type="text"], .login-form input[type="password"] {
            width: 90%;
            height: 30px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            outline: none;
        }
        .login-form input[type="submit"] {
            width: 100%;
            height: 40px;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-form input[type="submit"]:hover {
            background-color: #3e8e41;
        }
        .error-message {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h1>Login Form</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input placeholder="Username" type="text" name="username"><br>
            <input placeholder="Password" type="password" name="password"><br>
            <input type="submit" name="login" value="Login">
        </form>
        <?php if (isset($error)) { echo '<p class="error-message">' . $error . '</p>'; } ?>
    </div>
</body>
</html>