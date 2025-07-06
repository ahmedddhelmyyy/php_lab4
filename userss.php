<?php
session_start();
if (!isset($_SESSION['user'])) header("Location: login.php");
$users = file_exists("users.json") ? json_decode(file_get_contents("users.json"), true) : [];
?>
<!DOCTYPE html>
<html>
<head>
  <title>All Users</title>
  <style>
    body { font-family: sans-serif; background: #f1f5f9; padding: 2rem; }
    nav { margin-bottom: 2rem; }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 1rem;
      border-bottom: 1px solid #ddd;
    }
    th {
      background: #1e3a8a;
      color: white;
    }
    a { text-decoration: none; color: #2563eb; }
  </style>
</head>
<body>

<nav>
  <a href="dashboard.php">Dashboard</a> |
  <a href="profile.php">My Profile</a> |
  <a href="logout.php">Logout</a>
</nav>

<h2>All Registered Users</h2>
<table>
  <tr><th>Name</th><th>Email</th><th>Action</th></tr>
  <?php foreach ($users as $u): ?>
    <tr>
      <td><?= htmlspecialchars($u['name']) ?></td>
      <td><?= htmlspecialchars($u['email']) ?></td>
      <td><a href="user.php?email=<?= urlencode($u['email']) ?>">View</a></td>
    </tr>
  <?php endforeach; ?>
</table>

</body>
</html>
