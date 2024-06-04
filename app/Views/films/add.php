<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film List</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/add.css') ?>">
    <title>Add Film</title>
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>PlotSite</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/logout">Logout</a></li>
                    <li><a href="/film/add">Add Film</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="main-content container">
        <h2>Add Film</h2>
        <form method="post" action="/film/store" enctype="multipart/form-data">
            <label for="image">Image</label>
            <input type="file" name="image" id="image">

            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>

            <label for="genre">Genre</label>
            <input type="text" name="genre" id="genre" required>

            <label for="rilis">Release Date</label>
            <input type="date" name="rilis" id="rilis" required>

            <label for="synopsis">Synopsis</label>
            <textarea name="synopsis" id="synopsis" required></textarea>

            <label for="link">Trailer URL</label>
            <input type="url" name="link" id="link" required>

            <input type="submit" value="Add">
        </form>
        
    </section>

    <footer>
        <p>&copy; 2024 PlotSite Synopsis Website</p>
    </footer>
</body>
</html>
