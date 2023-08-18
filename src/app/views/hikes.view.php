<h2>Hike's List</h2>

<?php if (!empty($hikes)) : ?>
    <ul>
        <?php foreach ($hikes as $hike) : ?>
            <li>
                <a href="/hike?hikeId=<?= $hike['ID'] ?>">
                    <?= $hike['name'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>