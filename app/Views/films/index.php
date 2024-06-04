<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film List</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/add.css') ?>">
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Movie Database</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/logout">Logout</a></li>
                    <li><a href="/films">Add Film</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="main-content container">
        <h2>Add Film</h2>
        <form method="post" action="/film/store" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>

            <label for="image">Image</label>
            <input type="file" name="image" id="image" required accept="image/*">

            <label for="genre">Genre</label>
            <input type="text" name="genre" id="genre" required>

            <label for="rilis">Release Date</label>
            <input type="date" name="rilis" id="rilis" required>

            <label for="synopsis">Synopsis</label>
            <textarea name="synopsis" id="synopsis" required></textarea>

            <label for="link">trailer</label>
            <input type="text" name="link" id="link" required>

            <input type="submit" value="Add">
        </form>

        <div class="films">
            <?php foreach ($films as $film): ?>
                <div class="film">
                    <h3><?= $film['title']; ?></h3>
                    <a href="/films/edit/<?= $film['id']; ?>"><img src="<?= base_url($film['image']); ?>" alt="<?= $film['title']; ?>"></a>
                    <p><?= $film['synopsis']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Movie Database</p>
    </footer>
</body>
</html>
