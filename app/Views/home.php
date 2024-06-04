<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film List</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/home.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h2><strong>Film List</strong></h2>
        <div class="films">
            <?php foreach ($films as $film): ?>
                <div class="film">
                    <a href="<?= base_url('films/detail/' . $film['id']); ?>">
                        <div class="film-header">
                            <h3><?= $film['title']; ?></h3>
                        </div>
                        <div class="film-body">
                            <img src="<?= base_url($film['image']); ?>" alt="<?= $film['title']; ?>">
                            <p><?= implode(' ', array_slice(explode(' ', $film['synopsis']), 0, 50)); ?>...</p>
                        </div>
                    </a>
                    <div class="film-info">
                        <div class="info-item">
                            <i class="fas fa-star"></i>
                            <p><?= $film['rating']; ?></p>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-thumbs-up"></i>
                            <p><?= $film['like']; ?></p>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-thumbs-down"></i>
                            <p><?= $film['dislike']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
