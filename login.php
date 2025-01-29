<?php
session_start();
include 'config.php'; // Database Connection

$error_message = ""; // Variable to store error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prevent SQL Injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            header("Location: dashboard.php"); // Redirect to dashboard
            exit();
        } else {
            $error_message = "Invalid password!";
        }
    } else {
        $error_message = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body class="login-page">
  <div class="container">
    <div class="form-section">
      <h2>Login</h2>
      
      <!-- Show error message if login fails -->
      <?php if ($error_message): ?>
        <p style="color: red;"><?= $error_message ?></p>
      <?php endif; ?>
      
      <form action="login.php" method="POST">
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" placeholder="Enter your email" required>
        </div>
        
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" placeholder="Enter your password" required>
        </div>
        
        <div class="form-buttons">
          <button type="submit" class="btn btn-login">Login</button>
          <button type="button" class="btn btn-register"><a href="signup.php">Register</a></button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
