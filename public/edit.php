<?php
require_once '../models/Berita.php';
$beritaModel = new Berita();

$id = $_GET['id'];
$data = $beritaModel->getById($id);
?>

<?php include '../views/header.php'; ?>

<div class="container mt-5">
    <h2>Edit Berita</h2>
    <form method="POST" action="update.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $data['id']; ?>">
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="<?= $data['title'] ?>" required>
        </div>
        <div class="form-group">
            <label>Thumbnail Saat Ini:</label><br>
            <img src="<?= $data['thumbnail'] ?>" alt="Thumbnail" width="150"><br><br>

            <label>Ganti Thumbnail (opsional)</label>
            <input type="file" name="thumbnail" class="form-control" accept="image/*">
        </div>
        <div class="form-group">
            <label>Konten</label>
            <textarea id="summernote" name="content"><?= $data['content'] ?></textarea>
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