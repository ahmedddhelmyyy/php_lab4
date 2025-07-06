<?php
session_start();
if (!isset($_SESSION['user'])) header("Location: login.php");
$user = $_SESSION['user'];
$users = file_exists("users.json") ? json_decode(file_get_contents("users.json"), true) : [];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(-45deg, #93c5fd, #fca5a5, #fcd34d, #6ee7b7);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      padding: 2rem;
    }
    @keyframes gradientBG {
      0% {background-position: 0% 50%;}
      50% {background-position: 100% 50%;}
      100% {background-position: 0% 50%;}
    }
    nav {
      background: white;
      padding: 1rem;
      border-radius: 0.5rem;
      margin-bottom: 2rem;
      text-align: center;
    }
    nav a {
      margin: 0 1rem;
      text-decoration: none;
      font-weight: bold;
      color: #1e40af;
    }
    .card {
      background: white;
      padding: 1rem;
      border-radius: 1rem;
      max-width: 600px;
      margin: auto;
      text-align: center;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    img {
      border-radius: 50%;
      width: 120px;
      height: 120px;
      object-fit: cover;
    }
    table {
      width: 100%;
      margin-top: 2rem;
      border-collapse: collapse;
      background: white;
    }
    th, td {
      padding: 0.7rem;
      border-bottom: 1px solid #ccc;
    }
    th {
      background: #1e40af;
      color: white;
    }
  </style>
</head>
<body>
  <nav>
    <a href="dashboard.php">Welcome</a>
    <a href="profile.php">Profile</a>
    <a href="userss.php">All Users</a>
    <a href="logout.php">Logout</a>
  </nav>

  <div class="card">
    <h2>Welcome, <?= htmlspecialchars($user['name']) ?> 👋</h2>
    <img src="uploads/<?= $user['photo'] ?>" alt="profile" />
    <p><strong>Email:</strong> <?= $user['email'] ?></p>
    <p><strong>Phone:</strong> <?= $user['phone'] ?></p>
    <p><strong>Gender:</strong> <?= $user['gender'] ?></p>
    <p><strong>DOB:</strong> <?= $user['dob'] ?></p>
    <p><strong>Country:</strong> <?= $user['country'] ?></p>
  </div>
</body>
</html>
