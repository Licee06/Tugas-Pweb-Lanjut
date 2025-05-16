<?php
require_once 'config.php';

class Mahasiswa {
    public function getAll() {
        global $conn;
        $sql = "SELECT * FROM mahasiswa";
        $result = $conn->query($sql);
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function add($data) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO mahasiswa (nama, nim) VALUES (?, ?)");
        $stmt->bind_param("ss", $data['nama'], $data['nim']);
        $stmt->execute();
        $stmt->close();
    }

    public function getById($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($data) {
        global $conn;
        $stmt = $conn->prepare("UPDATE mahasiswa SET nama = ?, nim = ? WHERE id = ?");
        $stmt->bind_param("ssi", $data['nama'], $data['nim'], $data['id']);
        $stmt->execute();
        $stmt->close();
    }

    public function delete($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}
?>
