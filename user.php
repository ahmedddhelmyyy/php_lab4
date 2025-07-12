<?php
require_once 'Database.php';

if (!isset($_GET['email'])) die("User not found.");

$db = new Database();
$db->connect('localhost', 'root', '', 'iti2_db');

$user = $db->findUserByEmail($_GET['email']);
if (!$user) die("User not found.");
?>


<!DOCTYPE html>
<html>
<head>
  <title><?= htmlspecialchars($user['name']) ?>'s Profile</title>
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
  <div class="card">
    <h2><?= htmlspecialchars($user['name']) ?>'s Info</h2>
    <img src="uploads/<?= $user['photo'] ?>" alt="Profile Picture">
    <p><strong>Email:</strong> <?= $user['email'] ?></p>
    <p><strong>Phone:</strong> <?= $user['phone'] ?></p>
    <p><strong>Gender:</strong> <?= $user['gender'] ?></p>
    <p><strong>DOB:</strong> <?= $user['dob'] ?></p>
    <p><strong>Country:</strong> <?= $user['country'] ?></p>
    <a href="userss.php">⬅ Back to Users</a>
  </div>
</body>
</html>
