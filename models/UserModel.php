<?php
class UserModel {

    function openConn() {
        $conn = new mysqli("127.0.0.1", "root", "", "ftp_server");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    public function emailExists($email) {
        $conn = $this->openConn();
        $sql = "SELECT id FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        $exists = $result->num_rows > 0;
        $conn->close();
        return $exists;
    }

    public function insertUser($name, $email, $password, $role, $profilePicture) {
        $conn = $this->openConn();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password_hash, role, profile_picture) VALUES
        ('$name', '$email', '$hashedPassword', '$role', '$profilePicture')";
        $success = $conn->query($sql);

        $conn->close();
        return $success;
    }

    public function deleteModerator($id) {
        $conn = $this->openConn();
        $sql = "DELETE FROM users WHERE id = $id";
        $success = $conn->query($sql);
        $conn->close();
        return $success;
    }

    public function getAllUsers() {
        $conn = $this->openConn();
        $sql = "SELECT id, name, email, role, profile_picture, created_at FROM users ORDER BY id ASC";
        $result = $conn->query($sql);

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        $conn->close();
        return $users;
    }
}
?>