<div class="card" style="width: 18rem;">
    <h2> <?= $hike['name'] ?> </h2>

    <h4> Distance </h4>
    <p class="card-text"> <?= $hike['distance'] ?> km</p>

    <h4> Duration </h4>
    <p class="card-text">
        <?php
        list($hours, $minutes, $seconds) = explode(':', $hike['duration']);
        $formatedDuration = $hours . 'h' . $minutes;
        echo $formatedDuration;
        ?>
    </p>

    <h4> Elevation Gain </h4>
    <p class="card-text"> <?= $hike['elevation_gain'] ?> m</p>

    <h4> Description </h4>
    <p class="card-text"> <?= $hike['description'] ?></p>

    <h4> Created at </h4>
    <p class="card-text"> <?php $timestamp = strtotime($hike['created_at']);
                            $formatedDate = date("d/m/Y", $timestamp);
                            echo $formatedDate; ?></p>

    <h4> Last Update</h4>
    <p class="card-text"> <?php $timestamp = strtotime($hike['updated_at']);
                            $formatedDate = date("d/m/Y", $timestamp);
                            echo $formatedDate;
                            ?></p>

    <h4> Tags </h4>
    <?php if (!empty($tags)) : ?>
        <ul>
            <?php foreach ($tags as $tag) : ?>
                <p>
                    <a href="/tag?tagId=<?= $tag['ID'] ?>">
                        <p class="card-link"><?= $tag['name'] ?>
                    </a>
                </p>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
<a role=" button" href="/">Go back home !</a>