<?php
class Berita {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "simple_news");
    }

    public function getAll() {
        $query = "SELECT * FROM berita ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function create($title, $thumbnail, $content) {
        $stmt = $this->conn->prepare("INSERT INTO berita (title, thumbnail, content) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $thumbnail, $content);
        return $stmt->execute();
    }

    public function destroy($id) {
        $stmt = $this->conn->prepare("DELETE FROM berita WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function update($id, $title, $thumbnail, $content) {
        if ($thumbnail !== null) {
            // Update dengan thumbnail
            $stmt = $this->conn->prepare("UPDATE berita SET title = ?, thumbnail = ?, content = ? WHERE id = ?");
            $stmt->bind_param("sssi", $title, $thumbnail, $content, $id);
        } else {
            // Update tanpa mengubah thumbnail
            $stmt = $this->conn->prepare("UPDATE berita SET title = ?, content = ? WHERE id = ?");
            $stmt->bind_param("ssi", $title, $content, $id);
        }

        return $stmt->execute();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM berita WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

}
