<?php
class ContentModel {

    function openConn() {
        $conn = new mysqli("127.0.0.1", "root", "", "ftp_server");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    public function getAllCategories() {
        $conn = $this->openConn();
        $sql = "SELECT * FROM categories ORDER BY parent_id IS NULL DESC, name ASC";
        $result = $conn->query($sql);

        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }

        $conn->close();
        return $categories;
    }

    public function insertContent($title, $description, $filePath, $categoryId, $uploaderId) {
        $conn = $this->openConn();
        $sql = "INSERT INTO contents (title, description, file_path, category_id, uploader_id) VALUES
        ('$title', '$description', '$filePath', '$categoryId', '$uploaderId')";
        $success = $conn->query($sql);
        $conn->close();
        return $success;
    }

    public function getAllContents() {
        $conn = $this->openConn();
        $sql = "SELECT c.*, u.name AS uploader_name, u.role AS uploader_role, cat.name AS category_name
                FROM contents c
                JOIN users u ON c.uploader_id = u.id
                JOIN categories cat ON c.category_id = cat.id
                ORDER BY c.id DESC";
        $result = $conn->query($sql);

        $contents = [];
        while ($row = $result->fetch_assoc()) {
            $contents[] = $row;
        }

        $conn->close();
        return $contents;
    }

    public function getContentById($id) {
        $conn = $this->openConn();
        $sql = "SELECT * FROM contents WHERE id = $id";
        $result = $conn->query($sql);
        $content = $result->fetch_assoc();
        $conn->close();
        return $content;
    }

    public function updateContent($id, $title, $description, $categoryId, $filePath = null) {
        $conn = $this->openConn();

        if ($filePath !== null) {
            $sql = "UPDATE contents SET title = '$title', description = '$description',
                    category_id = '$categoryId', file_path = '$filePath' WHERE id = $id";
        } else {
            $sql = "UPDATE contents SET title = '$title', description = '$description',
                    category_id = '$categoryId' WHERE id = $id";
        }

        $success = $conn->query($sql);
        $conn->close();
        return $success;
    }

    public function deleteContent($id) {
        $conn = $this->openConn();
        $sql = "DELETE FROM contents WHERE id = $id";
        $success = $conn->query($sql);
        $conn->close();
        return $success;
    }
}
?>