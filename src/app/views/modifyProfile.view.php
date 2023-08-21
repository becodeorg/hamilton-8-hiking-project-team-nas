<h1>Modify my data</h1>
<form action="/modify?value=account" method="post">
        <label for="firstname">Firstname</label>
        <input type="text" name="firstname" id="firstname" value="<?= $_SESSION['hamilton-8-NAS_user']['firstname'] ?>" placeholder="Prénom..." required>

        <label for="lastname">Lastname</label>
        <input type="text" name="lastname" id="lastname" value="<?= $_SESSION['hamilton-8-NAS_user']['lastname'] ?>" placeholder="Nom..." required>

        <label for="password">Update infos</label>
        <input type="password" name="password" id="password" placeholder="Password required" required>

    <button type="submit">Modify</button>
</form>
<?php if (isset($error_value)):
    if ($error_value == "101"): ?>
        <p>Please fill in the fields above with your details.</p>
    <?php elseif ($error_value == "202"): ?>
        <p>This password is not valid.</p>
    <?php elseif ($error_value == "500"): ?>
        <p>Try later.</p>
    <?php elseif ($error_value == "301"): ?>
        <p>No changes detected.</p>
    <?php endif; ?>
<?php endif; ?>
<?php if (isset($modify)): ?>
    <?php if ($modify == "true"): ?>
        <p>Your information has been modified.</p>
    <?php endif; ?>
<?php endif; ?>