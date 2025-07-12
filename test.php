<?php
$conn = new mysqli('127.0.0.1', 'root', '', 'iti2_db', 3306); 

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}
echo "✅ Connected to MySQL successfully!";
?>
