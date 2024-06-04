<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Film</title>
    <meta name="description" content="Informasi detail tentang film, termasuk sinopsis, genre, tanggal rilis, dan interaksi pengguna.">
    <meta name="keywords" content="film, detail, sinopsis, genre, tanggal rilis, trailer">
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/detail.css') ?>">
    <script src="<?= base_url('js/detailFilm.js') ?>" defer></script>
</head>
<body>
<header>
    <div class="container">
        <div id="branding">
            <h1>PlotSite</h1>
        </div>
        <nav>
            <ul>
                <li><a href="/">Beranda</a></li>
                <li><a href="/logout">Keluar</a></li>
                <li><a href="/films">Tambah Film</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="container">
    <div class="header">
        <img src="<?= base_url($film['image']) ?>" alt="<?= esc($film['title']) ?>" class="film-image">
        <div class="film-details">
            <h2><?= esc($film['title']) ?></h2>
            <div class="total-rating">
                <img src="<?= base_url('images/star.png') ?>" alt="Ikon Bintang">
                <span id="rating-display"><?= esc($film['rating']) ?></span>
            </div>
            <p class="meta">
                <strong>Genre:</strong> <?= esc($film['genre']) ?><br>
                <strong>Tanggal Rilis:</strong> <?= esc($film['rilis']) ?>
            </p>
            <p><?= esc($film['synopsis']) ?></p>
        </div>
    </div>
    <?php if ($film['trailer']) : ?>
    <div class="trailer-container">
        <div class="col-6">
            <iframe type="text/html" class="w-full" width="100%" height="655" src="<?= ($film['trailer']) ?>" frameborder="0"></iframe>
        </div>
    </div>
    <?php endif; ?>
    <div class="film-interactions">
        <div class="film-actions">
            <div>
                <img id="like-btn" src="<?= base_url('images/like.png') ?>" alt="Suka" onclick="likeFilm(<?= $film['id'] ?>)">
                <span id="likes-count"><?= esc($film['like']) ?></span>
            </div>
            <div>
                <img id="dislike-btn" src="<?= base_url('images/dislike.png') ?>" alt="Tidak Suka" onclick="dislikeFilm(<?= $film['id'] ?>)">
                <span id="dislikes-count"><?= esc($film['dislike']) ?></span>
            </div>
        </div>
        <div class="rating-form">
            <div class="star-rating">
                <input type="radio" id="5-stars" name="rating" value="5" onclick="rateFilm(<?= $film['id'] ?>, 5)">
                <label for="5-stars" class="star">&#9733;</label>
                <input type="radio" id="4-stars" name="rating" value="4" onclick="rateFilm(<?= $film['id'] ?>, 4)">
                <label for="4-stars" class="star">&#9733;</label>
                <input type="radio" id="3-stars" name="rating" value="3" onclick="rateFilm(<?= $film['id'] ?>, 3)">
                <label for="3-stars" class="star">&#9733;</label>
                <input type="radio" id="2-stars" name="rating" value="2" onclick="rateFilm(<?= $film['id'] ?>, 2)">
                <label for="2-stars" class="star">&#9733;</label>
                <input type="radio" id="1-stars" name="rating" value="1" onclick="rateFilm(<?= $film['id'] ?>, 1)">
                <label for="1-stars" class="star">&#9733;</label>
            </div>
        </div>
    </div>
</div>
<footer>
    <p>&copy; 2024 Situs PlotSite Sinopsis Film</p>
</footer>

<script>
    let liked = false;
    let disliked = false; 

    async function likeFilm(id) {
        try {
            const response = await fetch(liked ? `/films/unlike/${id}` : `/films/like/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
            });
            const data = await response.json();
            if (data.status === 'success') {
                document.getElementById('likes-count').innerText = data.likes;
                liked = !liked;
                document.getElementById('like-btn').src = liked ? '<?= base_url('images/liked.png') ?>' : '<?= base_url('images/like.png') ?>';
                if (disliked) {
                    disliked = false;
                    document.getElementById('dislike-btn').src = '<?= base_url('images/dislike.png') ?>';
                    document.getElementById('dislikes-count').innerText = data.dislikes;
                }
            }
        } catch (error) {
            console.error('Error menyukai film:', error);
        }
    }

    async function dislikeFilm(id) {
        try {
            const response = await fetch(disliked ? `/films/undislike/${id}` : `/films/dislike/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
            });
            const data = await response.json();
            if (data.status === 'success') {
                document.getElementById('dislikes-count').innerText = data.dislikes;
                disliked = !disliked;
                document.getElementById('dislike-btn').src = disliked ? '<?= base_url('images/disliked.png') ?>' : '<?= base_url('images/dislike.png') ?>';
                if (liked) {
                    liked = false;
                    document.getElementById('like-btn').src = '<?= base_url('images/like.png') ?>';
                    document.getElementById('likes-count').innerText = data.likes;
                }
            }
        } catch (error) {
            console.error('Error tidak menyukai film:', error);
        }
    }

    async function rateFilm(id, rating) {
        try {
            const response = await fetch(`/films/rate/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ rating: rating }),
            });
            const data = await response.json();
            if (data.status === 'success') {
                document.getElementById('rating-display').innerText = data.rating.toFixed(2);
            }
        } catch (error) {
            console.error('Error memberikan rating pada film:', error);
        }
    }
</script>
</body>
</html>
