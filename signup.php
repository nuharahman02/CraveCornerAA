<?php
include 'config.php';

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $password);

    if ($stmt->execute()) {
        $success_message = "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        $error_message = "Error: Could not register.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup Page</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <div class="form-section">
      <h2>Register</h2>

      <?php if ($error_message): ?>
        <p style="color: red;"><?= $error_message ?></p>
      <?php endif; ?>
      <?php if ($success_message): ?>
        <p style="color: green;"><?= $success_message ?></p>
      <?php endif; ?>

      <form action="signup.php" method="POST">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" name="name" placeholder="Enter your name" required>
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="form-group">
          <label for="phone">Phone:</label>
          <input type="text" name="phone" placeholder="01793-xxxxxx" required>
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="password" placeholder="Enter your password" required>
        </div>

        <div class="form-buttons">
          <button type="submit" class="btn btn-register">Register</button>
          <button type="button" class="btn btn-login"><a href="login.php">Login</a></button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
