<?php
session_start();
$users = file_exists('users.json') ? json_decode(file_get_contents('users.json'), true) : [];

function saveUser($user) {
  global $users;
  $users[] = $user;
  file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm = $_POST['confirm'];
  $phone = $_POST['phone'];
  $gender = $_POST['gender'];
  $dob = $_POST['dob'];
  $country = $_POST['country'];

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format.";
  } elseif ($password !== $confirm) {
    $error = "Passwords do not match.";
  } else {
    foreach ($users as $u) {
      if ($u['email'] === $email) {
        $error = "Email already registered.";
        break;
      }
    }
  }

  if (!isset($error)) {
    $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    $photo = uniqid() . "." . $ext;
    move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/$photo");

    $newUser = [
      "name" => $name,
      "email" => $email,
      "password" => password_hash($password, PASSWORD_DEFAULT),
      "phone" => $phone,
      "gender" => $gender,
      "dob" => $dob,
      "country" => $country,
      "photo" => $photo
    ];

    saveUser($newUser);
    $_SESSION['user'] = $newUser;
    header("Location: dashboard.php");
    exit;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(-45deg, #93c5fd, #fca5a5, #fcd34d, #6ee7b7);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
      padding: 2rem 1rem;
    }

    @keyframes gradientBG {
      0% {background-position: 0% 50%;}
      50% {background-position: 100% 50%;}
      100% {background-position: 0% 50%;}
    }

    nav {
      background: white;
      padding: 1rem 2rem;
      border-radius: 0.7rem;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      margin-bottom: 2rem;
    }

    nav a {
      text-decoration: none;
      margin: 0 1rem;
      color: #2563eb;
      font-weight: bold;
    }

    form {
      background: rgba(255, 255, 255, 0.9);
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 420px;
      text-align: center;
    }

    form h2 {
      margin-bottom: 1.5rem;
      color: #1e3a8a;
    }

    input, select, button {
      width: 100%;
      padding: 0.7rem;
      margin-bottom: 1rem;
      border-radius: 0.5rem;
      border: 1px solid #ccc;
      text-align: center;
    }

    input[type="radio"] {
      width: auto;
      margin-right: 0.4rem;
    }

    label {
      display: block;
      font-weight: bold;
      color: #1f2937;
      text-align: left;
      margin-bottom: 0.3rem;
    }

    button {
      background-color: #3b82f6;
      color: white;
      font-weight: bold;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #2563eb;
    }

    .error {
      color: red;
      font-weight: bold;
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>

  <nav>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
  </nav>

  <form method="POST" enctype="multipart/form-data">
    <h2>📝 Register</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    
    <label>Name:</label>
    <input type="text" name="name" placeholder="Full Name" required>

    <label>Email:</label>
    <input type="email" name="email" placeholder="Email" required>

    <label>Password:</label>
    <input type="password" name="password" placeholder="Password" required>

    <label>Confirm Password:</label>
    <input type="password" name="confirm" placeholder="Confirm Password" required>

    <label>Phone:</label>
    <input type="tel" name="phone" placeholder="Phone Number" required>

    <label>Gender:</label>
    <label><input type="radio" name="gender" value="male" required> Male</label>
    <label><input type="radio" name="gender" value="female" required> Female</label>

    <label>Date of Birth:</label>
    <input type="date" name="dob" required>

    <label>Country:</label>
    <select name="country" required>
      <option value="">--Select--</option>
      <option value="Egypt">Egypt</option>
      <option value="KSA">KSA</option>
      <option value="USA">USA</option>
    </select>

    <label>Photo:</label>
    <input type="file" name="photo" accept="image/*" required>

    <button type="submit">Register</button>
  </form>

</body>
</html>
