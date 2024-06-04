<!DOCTYPE html>
<html>
<head>
    <title>Film Synopsys Website</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/header.css') ?>">
    
</head>
<body>
    <header>
        <h1>PlotSite</h1>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <?php if(session()->get('logged_in')): ?>
                    <li><a href="/logout">Logout</a></li>
                    <?php if(session()->get('role') == 'admin'): ?>
                        <li><a href="/film/add">Add Film</a></li>
                    <?php endif; ?>
                <?php else: ?>
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
