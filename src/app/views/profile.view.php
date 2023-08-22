<?php extract($user); ?>
<section>
    <?php if ($_SESSION['hamilton-8-NAS_user']['id'] == $id) : ?>
        <h2 class="py-4">Your profile</h2>
    <?php else : ?>
        <h2>Profile de <?= $nickname ?></h2>
    <?php endif; ?>
    <p>Name : <?= $firstname . " " . $lastname ?></p>
    <p>Nickname : <?= $nickname ?></p>
    <p>Email : <?= $email ?></p>
    <?php if (!isset($_GET['id']) || $_SESSION['hamilton-8-NAS_user']['id'] == $_GET['id']) : ?>
        <a href="/modify?value=account" role="button" class="btn btn-secondary">Edit my profile</a>
    <?php endif; ?>
</section>
<section class="cards-wrapper">
    <?php if ($_SESSION['hamilton-8-NAS_user']['id'] == $id) : ?>
        <h2 class="py-4">Your hikes</h2>
    <?php else : ?>
        <h2>Hikes de <?= $nickname ?></h2>
    <?php endif; ?>

    <?php if (!empty($hikes)) :
        foreach ($hikes as $hike) :
            extract($hike); ?>
            <div>
                <h4><a href="/hike?hikeId=<?= $hike['ID'] ?>"><?= $hike['name'] ?></a></h4>
                <p><?= $distance ?> km</p>
                <p><?= $duration ?></p>
                <a href="/profile?id=<?= $id ?>"><?= $nickname ?></a>
            </div>
            <?php if ($_SESSION['hamilton-8-NAS_user']['id'] == $id || $_SESSION['hamilton-8-NAS_user']['id'] == '1') : ?>
                <div>
                    <a href="/modify?value=hike&id=<?= $id ?>"></a>
                    <a href="/delete-hike?id=<?= $id ?>" onclick="return confirm('Delete hike?')"></a>
                </div>
            <?php endif; ?>

        <?php endforeach;
    else : ?>
        <a href="/creation" role="button" class="btn btn-secondary">You haven't created any hikes</a>
    <?php endif; ?>
    <p class="py-4">
        <a role="button" class="btn btn-secondary" href="/">Go back home !</a>
    </p>
</section>