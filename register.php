<?php
session_start();
include 'database.php';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = 'Please fill in all fields.';
    } elseif ($password != $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        var_dump($hashed_password);
        $query = "INSERT INTO authLogin (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            $error = 'Registration failed. Please try again. Error: ' . $conn->error;
        } else {
            $stmt->bind_param("sss", $username, $email, $hashed_password);
            if (!$stmt->execute()) {
                $error = 'Registration failed. Please try again. Error: ' . $conn->error;
            } else {
                session_start();
                $_SESSION['username'] = $username;
                $success = 'User registered successfully!';
                header('Location: home.php');
                exit;
            }
        }
    }
}
?>

<!-- Registration form -->
<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="register.css">
 </head>
 <body>
    <div class="register-form">
        <h1>Registration Form</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input placeholder="Username" type="text" name="username"><br>
            <input placeholder="Email" type="email" name="email"><br>
            <input placeholder="Password" type="password" name="password"><br>
            <input placeholder="Confirm Password" type="password" name="confirm_password"><br><br>
            <input type="submit" name="register" value="Register">
        </form>
        <?php if (isset($error)) { echo '<p class="error-message">' . $error . '</p>'; } ?>
        <?php if (isset($success)) { echo '<p class="success-message">' . $success . '</p>'; } ?>
    </div>
 </body>
 </html>