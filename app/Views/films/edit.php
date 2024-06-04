<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Film</title>
    <link rel="stylesheet" href="/css/styles.css">
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
                    <li><a href="/films">Films</a></li>
                    <li><a href="/logout">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="main-content container">
        <h2>Edit Film</h2>
        <form method="post" action="/films/update" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= $film['id'] ?>">

            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" name="genre" id="genre" value="<?= $film['genre'] ?>" required>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="<?= $film['title'] ?>" required>
            </div>

            <div class="form-group">
                <label for="rilis">Release Date</label>
                <input type="date" name="rilis" id="rilis" value="<?= $film['rilis'] ?>" required>
            </div>

            <div class="form-group">
                <label for="synopsis">Synopsis</label>
                <textarea name="synopsis" id="synopsis" required><?= $film['synopsis'] ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image">
                <input type="hidden" name="current_image" value="<?= $film['image'] ?>">
                <p>Current Image: <img src="/<?= $film['image'] ?>" alt="<?= $film['title'] ?>" width="100"></p>
            </div>

            <div class="form-group">
                <label for="link">Trailer URL</label>
                <input type="text" name="link" id="link" value="<?= $film['link'] ?>" required>
            </div>

            </div>

            <div class="form-group">
                <input type="submit" value="Update">
            </div>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Movie Database</p>
    </footer>
</body>
</html>
