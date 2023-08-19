<?php extract($user); ?>
<section>
    <?php if ($_SESSION['hamilton-8-NAS_user']['id'] == $id): ?>
        <h2>Your profile</h2>
    <?php else: ?>
        <h2>Profile de <?= $nickname ?></h2>
    <?php endif; ?>
    <ul>
        <li>Name: <?= $firstname . " " . $lastname ?></li>
        <li>Nickname: <?= $nickname ?></li>
        <li>Email: <?= $email ?></li>
    </ul>
    <?php if (!isset($_GET['id']) || $_SESSION['hamilton-8-NAS_user']['id'] == $_GET['id']): ?>
        <a href="/modify?value=account" role="button">Modifier mes informations</a>
    <?php endif; ?>
</section>
<section class="cards-wrapper">
    <?php if ($_SESSION['hamilton-8-NAS_user']['id'] == $id): ?>
        <h2>Your hikes</h2>
    <?php else: ?>
        <h2>Hikes de <?= $nickname ?></h2>
    <?php endif; ?>
    <ul>
        <?php if (!empty($hikes)):
            foreach ($hikes as $hike):
                extract($hike); ?>
                <li class="card">
                    <img src="<?= $image_url ?>" alt="photo-rando">
                    <div>
                        <h4><a href="/hike?hikeid=<?= $id ?>"><?= $name ?></a></h4>
                        <p><?= $distance ?> km</p>
                        <p><?= $duration ?></p>
                        <a href="/profile?id=<?= $id ?>"><?= $nickname ?></a>
                    </div>
                    <?php if ($_SESSION['hamilton-8-NAS_user']['id'] == $id || $_SESSION['hamilton-8-NAS_user']['id'] == '1'): ?>
                        <div class="float">
                            <a href="/modify?value=hike&id=<?= $id ?>"></a>
                            <a href="/delete-hike?id=<?= $id ?>" onclick="return confirm('Delete hike?')"></a>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endforeach;
            else: ?>
            <a href="/creation">You haven't created any hikes</a>
        <?php endif; ?>
    </ul>
</section>