<?php 
include '../models/Berita.php';
$news = new Berita();

$id = $_GET['id'];
$article = $news->getById($id);


// function limit_words($text, $limit = 50) {
//     $words = explode(' ', strip_tags($text));
//     if (count($words) <= $limit) {
//         return implode(' ', $words);
//     }
//     return implode(' ', array_slice($words, 0, $limit)) . '...';
// }
?>

<?php include '../views/header.php'?>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
  <style>
    .article-img {
      max-height: 400px;
      object-fit: cover;
      width: 100%;
    }
  </style>
<body>

  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Nama Situs</a>
  </nav>

  <!-- Main Container -->
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8">

        <!-- Judul Artikel -->
        <h1 class="mb-3"><?= htmlspecialchars($article['title']); ?></h1>
        <p class="text-muted">Dipublikasikan pada 22 Mei 2025</p>

        <!-- Gambar Artikel -->
        <img src="../<?= htmlspecialchars($article['thumbnail']); ?>" alt="Gambar Artikel" class="article-img mb-4 rounded">

        <!-- Isi Artikel -->
        <div class="article-content">
          <?= $article['content']; ?>
        </div>

      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-light text-center py-3">
    <p class="mb-0">&copy; 2025 Nama Situs. All rights reserved.</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
