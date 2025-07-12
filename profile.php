<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Your Profile</title>
  <style>
    body { font-family: sans-serif; background: #f3f4f6; padding: 2rem; text-align: center; }
    .card {
      background: white;
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      max-width: 500px;
      margin: auto;
    }
    img {
      width: 150px; height: 150px;
      border-radius: 50%; object-fit: cover;
    }
  </style>
</head>
<body>
  <nav>
  <a href="dashboard.php">Dashboard</a> |
  <a href="profile.php">My Profile</a> |
  <a href="userss.php">All Users</a> |
  <a href="logout.php">Logout</a>
</nav>

  <div class="card">
    <h2>Your Profile</h2>
    <img src="uploads/<?= $user['photo'] ?>" alt="Profile Picture">
    <p><strong>Name:</strong> <?= $user['name'] ?></p>
    <p><strong>Email:</strong> <?= $user['email'] ?></p>
    <p><strong>Phone:</strong> <?= $user['phone'] ?></p>
    <p><strong>Gender:</strong> <?= $user['gender'] ?></p>
    <p><strong>DOB:</strong> <?= $user['dob'] ?></p>
    <p><strong>Country:</strong> <?= $user['country'] ?></p>
    <a href="dashboard.php">⬅ Back</a>
  </div>
</body>
</html>
