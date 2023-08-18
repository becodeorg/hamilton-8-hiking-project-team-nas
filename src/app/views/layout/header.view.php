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
    <ul class="nav justify-content-end">
        <?php if (!empty($_SESSION['user'])) : ?>
            <li class="nav-item">
                <span class="nav-link">Bonjour <?= $_SESSION['user']['username'] ?></span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout">Logout</a>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/register">Register</a>
            </li>
        <?php endif; ?>
    </ul>
</header>
<main class="container">