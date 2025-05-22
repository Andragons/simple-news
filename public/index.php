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

<?php if (isset($_GET['message']) && $_GET['message'] === 'deleted'): ?>
    <!-- <div class="alert alert-success">Artikel berhasil dihapus.</div> -->
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong>Artikel berhasil dihapus.</strong> 
    </div>
    
    <script>
      $(".alert").alert();
    </script>
<?php endif; ?>


<style>
    body {
        font-family: Arial, sans-serif;
    }

    #sidebar {
        min-height: 100vh;
        background: #343a40;
        color: white;
    }

    #sidebar .nav-link {
        color: #ccc;
    }

    #sidebar .nav-link:hover {
        background: #495057;
        color: #fff;
    }

    @media (max-width: 768px) {
        #sidebar {
            position: absolute;
            z-index: 1000;
            width: 200px;
            left: -200px;
            transition: all 0.3s;
        }

        #sidebar.active {
            left: 0;
        }
    }
</style>

<body>

    <?php include '../views/navbar.php'; ?>

    <!-- Main content -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-4">


        <div class="container">
            <h1>Artikel</h1>
            <a name="" id="" class="btn btn-primary mb-3" href="tambah.php" role="button">Buat Artikel</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Content</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $key => $article): ?>
                        <tr>
                            <th scope="row"><?= $key + 1; ?></th>
                            <td><?= htmlspecialchars($article['title']); ?></td>
                            <td><img src="../<?= htmlspecialchars($article['thumbnail']); ?>" alt="Thumbnail" style="width: 100px; object-fit: cover;"></td>
                            <td><?= htmlspecialchars(limit_words($article['content'], 20)); ?></td>
                            <td><?= $article['created_at']; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $article['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger delete" data-id="<?= $article['id']; ?>">
                                    Delete
                                </button>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </main>
    </div>
    </div>


    <script>
        const buttons = document.querySelectorAll(".delete")

        buttons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const id = btn.getAttribute('data-id')
                const konfirmasi = confirm('Yakin ingin menghapus artikel ini?')

                if (konfirmasi) {
                    window.location.href = `delete.php?id=${id}`
                }
            })
        })
    </script>

    <?php include '../views/footer.php'; ?>