<?php
session_start();
require_once 'Database.php';

$db = new Database();
$db->connect('localhost', 'root', '', 'iti2_db',3306);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $db->findUserByEmail($email);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit;
    }

    $error = "Invalid email or password.";
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(-45deg, #93c5fd, #fca5a5, #fcd34d, #6ee7b7);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      flex-direction: column;
    }
    @keyframes gradientBG {
      0% {background-position: 0% 50%;}
      50% {background-position: 100% 50%;}
      100% {background-position: 0% 50%;}
    }
    form {
      background: rgba(255, 255, 255, 0.85);
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
    }
    input, button {
      width: 100%;
      padding: 0.6rem;
      margin-bottom: 1rem;
      border-radius: 0.5rem;
      border: 1px solid #ccc;
    }
    button {
      background-color: #3b82f6;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }
    button:hover {
      background-color: #2563eb;
    }
    .error { color: red; text-align: center; }
  </style>
</head>
<body>

<nav style='margin-bottom:2rem;'>
  <a href='login.php' style='margin-right:1rem;'>Login</a>
  <a href='register.php'>Register</a>
</nav>

  <form method="POST">
    <h2>🔐 Login</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
</body>
</html>
