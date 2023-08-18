<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="/dist/output.css" rel="stylesheet">
    <title>Hike's Life</title>
</head>

<header>
    <nav>
        <ul>
            <li><a href="/"><strong>Hiking's life</strong></a></li>
        </ul>
        <ul>
            <?php if (isset($_SESSION['hamilton-8-NAS_user'])) : ?>
                <li>Bonjour <?= $_SESSION['hamilton-8-NAS_user']['nickname'] ?></li>
                <li><a href="/logout">Logout</a></li>
            <?php else : ?>
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main class="container">