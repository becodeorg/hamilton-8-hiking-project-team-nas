<h1 class="py-4">Error 500 - Something's Wrong</h1>
<?php if (!empty($error)) : ?>
    <p><?= $error ?></p>
<?php endif; ?>
<div class="py-4">
    <a role="button" class="btn btn-secondary" href="/">Go back home !</a>
</div>