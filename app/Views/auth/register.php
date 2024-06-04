<!DOCTYPE html>
<html>
<head>
    <title>Register - Film Synopsys Website</title>
    <link rel="icon" href="<?= base_url('images/logo.ico') ?>" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/register.css') ?>">
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form action="/registerSave" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <label for="confpassword">Confirm Password</label>
            <input type="password" name="confpassword" id="confpassword" required>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
