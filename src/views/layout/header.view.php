<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiker's life</title>
    <script src="http://cdn.tailwindcss.com/?plugins=forms%22%3E"></script>
</head>
<body>
<header>
<nav>
  <ul>
    <li><a href="/"><strong>Hiking's life</strong></a></li>
  </ul>
  <ul>
    <?php if (isset($_SESSION['hamilton-8-NAS_user'])): ?>
      <li>Bonjour <?= $_SESSION['hamilton-8-NAS_user']['nickname'] ?></li>
      <li><a href="/logout">Logout</a></li>
      <?php else: ?>
    <li><a href="/login">Login</a></li>
    <li><a href="/register">Register</a></li>
    <?php endif; ?>
  </ul>
</nav>
</header>
<main>