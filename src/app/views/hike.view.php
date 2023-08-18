<h2> <?= $hike['name'] ?> </h2>

<h4> Distance </h4>
<p> <?= $hike['distance'] ?> km</p>

<h4> Durée </h4>
<p>
    <?php
    list($hours, $minutes, $seconds) = explode(':', $hike['duration']);
    $formatedDuration = $hours . 'h' . $minutes;
    echo $formatedDuration;
    ?>
</p>

<h4> Dénivelé positif </h4>
<p> <?= $hike['elevation_gain'] ?> m</p>

<h4> Description </h4>
<p> <?= $hike['description'] ?></p>

<h4> Créée le </h4>
<p> <?php $timestamp = strtotime($hike['created_at']);
    $formatedDate = date("d/m/Y", $timestamp);
    echo $formatedDate; ?></p>

<h4> Dernière MAJ </h4>
<p> <?php $timestamp = strtotime($hike['updated_at']);
    $formatedDate = date("d/m/Y", $timestamp);
    echo $formatedDate;
    ?></p>

<h4> Tags </h4>
<?php if (!empty($tags)) : ?>
    <ul>
        <?php foreach ($tags as $tag) : ?>
            <li>
                <?= $tag['name'] ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>