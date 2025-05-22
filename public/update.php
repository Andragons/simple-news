<?php
require_once '../models/Berita.php';

$berita = new Berita();

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];
$thumbnail = null;

if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../uploads/';
    $filename = basename($_FILES['thumbnail']['name']);
    $targetFilePath = $uploadDir . time() . '_' . $filename;

    // Cek dan buat folder upload jika belum ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $targetFilePath)) {
        $thumbnail = $targetFilePath;
    } else {
        die("Gagal mengunggah gambar.");
    }
}

// Panggil method update
$berita->update($id, $title, $thumbnail, $content);

header("Location: index.php"); // Redirect setelah update
exit();
?>