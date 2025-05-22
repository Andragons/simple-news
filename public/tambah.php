<?php
require_once '../models/Berita.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadDir = '../uploads/';

    // cek apakah folder upload sudah ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fileName = basename($_FILES["thumbnail"]["name"]);
    $targetFile = $uploadDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (getimagesize($_FILES["thumbnail"]["tmp_name"])) {
        if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $targetFile)) {
            $thumbnailPath = 'uploads/' . $fileName;
            $berita = new Berita();
            $berita->create($_POST['title'], $thumbnailPath, $_POST['content']);
            header("Location: index.php");
            exit;
        } else {
            echo "Upload gambar gagal.";
        }
    } else {
        echo "File bukan gambar.";
    }
}
?>

<?php include '../views/header.php'; ?>

<div class="container mt-5">
    <h2>Tambah Berita</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Thumbnail (Upload Gambar)</label>
            <input type="file" name="thumbnail" class="form-control" accept="image/*" required>
        </div>
        <div class="form-group">
            <label>Konten</label>
            <textarea id="summernote" name="content"></textarea>
        </div>
        <button class="btn btn-success" type="submit">Simpan</button>
    </form>
</div>

<script>
    $('#summernote').summernote({
        placeholder: 'Tulis konten beritanya di sini...',
        tabsize: 2,
        minHeight: null,
        maxHeight: null,
        focus: true, 
        height: 300,
        toolbar: [
            ['font', ['fontname', 'fontsize', 'fontsizeunit', 'color', 'forecolor', 'backcolor', 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['insert', ['picture', 'link', 'video', 'table', 'hr']],
            ['para', ['style', 'ol', 'ul', 'paragraph', 'height']],
            ['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
        ]
    });
</script>

<?php include '../views/footer.php'; ?>