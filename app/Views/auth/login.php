<!DOCTYPE html>
<html>
<head>
    <title>Login - Film Synopsys Website</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/login.css') ?>">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="/loginAuth" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
