<?php 
include '../models/Berita.php';

$news = new Berita();
$articles = $news->getAll();

function limit_words($text, $limit = 50) {
    $words = explode(' ', strip_tags($text));
    if (count($words) <= $limit) {
        return implode(' ', $words);
    }
    return implode(' ', array_slice($words, 0, $limit)) . '...';
}

?>


<?php include '../views/header.php'; ?>

<div class="container my-3">
    <div class="d-flex" style="gap: 5%;">
        <?php foreach ($articles as $article): ?>
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="../<?= htmlspecialchars($article['thumbnail']); ?>" alt="Card image cap" style="height: 190px;">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($article['title']); ?></h5>
                    <p class="card-text"><?= htmlspecialchars(limit_words($article['content'], 20)); ?></p>
                    <a href="article.php?id=<?= $article['id']; ?>" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php include '../views/footer.php'; ?>