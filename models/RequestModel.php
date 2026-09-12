<?php
class RequestModel {

    function openConn() {
        $conn = new mysqli("127.0.0.1", "root", "", "ftp_server");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    // ---- Browse: shob content anha (category filter soho) ----
    public function getContentsByCategory($categoryId = null) {
        $conn = $this->openConn();

        if ($categoryId != null && $categoryId != "") {
            $sql = "SELECT c.*, cat.name AS category_name
                    FROM contents c
                    JOIN categories cat ON c.category_id = cat.id
                    WHERE c.category_id = '$categoryId'
                    ORDER BY c.uploaded_at DESC";
        } else {
            $sql = "SELECT c.*, cat.name AS category_name
                    FROM contents c
                    JOIN categories cat ON c.category_id = cat.id
                    ORDER BY c.uploaded_at DESC";
        }

        $result = $conn->query($sql);

        $contents = [];
        while ($row = $result->fetch_assoc()) {
            $contents[] = $row;
        }

        $conn->close();
        return $contents;
    }

    // ---- Search: title/description diye khoja ----
    public function searchContents($keyword) {
        $conn = $this->openConn();

        $sql = "SELECT c.*, cat.name AS category_name
                FROM contents c
                JOIN categories cat ON c.category_id = cat.id
                WHERE c.title LIKE '%$keyword%' OR c.description LIKE '%$keyword%'
                ORDER BY c.uploaded_at DESC";

        $result = $conn->query($sql);

        $contents = [];
        while ($row = $result->fetch_assoc()) {
            $contents[] = $row;
        }

        $conn->close();
        return $contents;
    }

    // ---- Shob top-level category anha (home page tabs er jonno) ----
    public function getTopCategories() {
        $conn = $this->openConn();
        $sql = "SELECT * FROM categories WHERE parent_id IS NULL ORDER BY name ASC";
        $result = $conn->query($sql);

        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }

        $conn->close();
        return $categories;
    }

    // ---- Ekta category er sub-category anha (dependent dropdown er jonno) ----
    public function getSubCategories($parentId) {
        $conn = $this->openConn();
        $sql = "SELECT * FROM categories WHERE parent_id = '$parentId' ORDER BY name ASC";
        $result = $conn->query($sql);

        $subCategories = [];
        while ($row = $result->fetch_assoc()) {
            $subCategories[] = $row;
        }

        $conn->close();
        return $subCategories;
    }

    // ---- Shob category (dropdown er jonno, top-level + sub shob) ----
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

    // ---- Download count barhano ----
    public function incrementDownloadCount($contentId) {
        $conn = $this->openConn();
        $sql = "UPDATE contents SET download_count = download_count + 1 WHERE id = '$contentId'";
        $success = $conn->query($sql);
        $conn->close();
        return $success;
    }

    // ---- Content Request add kora (Member er request box theke) ----
    public function addRequest($contentTitle, $categoryRequested, $message, $requesterIp) {
        $conn = $this->openConn();

        $sql = "INSERT INTO content_requests (requester_ip, content_title, category_requested, message, status) VALUES
        ('$requesterIp', '$contentTitle', '$categoryRequested', '$message', 'pending')";

        $success = $conn->query($sql);
        $conn->close();
        return $success;
    }

    // ---- Shob request anha (Admin/Moderator dekhar jonno) ----
    public function getAllRequests() {
        $conn = $this->openConn();
        $sql = "SELECT * FROM content_requests ORDER BY created_at DESC";
        $result = $conn->query($sql);

        $requests = [];
        while ($row = $result->fetch_assoc()) {
            $requests[] = $row;
        }

        $conn->close();
        return $requests;
    }

    // ---- Request status update kora (fulfilled/rejected) ----
    public function updateRequestStatus($requestId, $status) {
        $conn = $this->openConn();
        $sql = "UPDATE content_requests SET status = '$status' WHERE id = '$requestId'";
        $success = $conn->query($sql);
        $conn->close();
        return $success;
    }
}
?>