<h1 class="py-4">Modify my data</h1>
<form action="/modify?value=account" method="post">
    <div class="mb-3">
        <label for="firstname" class="form-label">Firstname</label>
        <input type="text" class="form-control" name="firstname" id="firstname" value="<?= $_SESSION['hamilton-8-NAS_user']['firstname'] ?>" placeholder="Prénom..." required>
    </div>
    <div class="mb-3">
        <label for="lastname" class="form-label">Lastname</label>
        <input type="text" class="form-control" name="lastname" id="lastname" value="<?= $_SESSION['hamilton-8-NAS_user']['lastname'] ?>" placeholder="Nom..." required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Update infos</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password required" required>
    </div>
    <button type="submit" class="btn btn-primary">Modify</button>
</form>
<?php if (isset($error_value)) :
    if ($error_value == "101") : ?>
        <p>Please fill in the fields above with your details.</p>
    <?php elseif ($error_value == "202") : ?>
        <p>This password is not valid.</p>
    <?php elseif ($error_value == "500") : ?>
        <p>Try later.</p>
    <?php elseif ($error_value == "301") : ?>
        <p>No changes detected.</p>
    <?php endif; ?>
<?php endif; ?>
<?php if (isset($modify)) : ?>
    <?php if ($modify == "true") : ?>
        <p class="py-4">Your information has been modified.</p>
    <?php endif; ?>
<?php endif; ?>
<p class=" py-4">
    <a role="button" class="btn btn-secondary" href="/">Go back home !</a>
</p>