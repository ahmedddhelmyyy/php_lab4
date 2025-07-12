<?php
class Database {
    private $conn;

    public function connect($host, $username, $password, $dbname, $port = 3306) {
        $this->conn = new mysqli($host, $username, $password, $dbname, $port);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function insert($table, $data) {
        $columns = implode(',', array_keys($data));
        $values = "'" . implode("','", array_map([$this->conn, 'real_escape_string'], array_values($data))) . "'";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        return $this->conn->query($sql);
    }

    public function findUserByEmail($email) {
        $email = $this->conn->real_escape_string($email);
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $this->conn->query($sql);
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function close() {
        $this->conn->close();
    }
}
