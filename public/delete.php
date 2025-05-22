<?php
include '../models/Berita.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $berita = new Berita();
    $id = intval($_GET['id']);

    if ($berita->destroy($id)) {
        header("Location: index.php?message=deleted");
        exit;
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID tidak valid.";
}
?>
