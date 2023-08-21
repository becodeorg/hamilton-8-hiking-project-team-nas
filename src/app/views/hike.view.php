<div class="card p-4 my-4">
    <h1> <?= $hike['name'] ?> </h1>
    <p class="fw-lighter">Created on
        <?php $timestamp = strtotime($hike['created_at']);
        $formatedDate = date("d/m/Y", $timestamp);
        echo $formatedDate; ?>, last update on
        <?php $timestamp = strtotime($hike['updated_at']);
        $formatedDate = date("d/m/Y", $timestamp);
        echo $formatedDate;
        ?>
    </p>


    <h4 class="mt-4"> Distance </h4>
    <p class="card-text"> <?= $hike['distance'] ?> km</p>

    <h4 class="mt-4"> Duration </h4>
    <p class="card-text">
        <?php
        list($hours, $minutes, $seconds) = explode(':', $hike['duration']);
        $formatedDuration = $hours . 'h' . $minutes;
        echo $formatedDuration;
        ?>
    </p>

    <h4 class="mt-4"> Elevation Gain </h4>
    <p class="card-text"> <?= $hike['elevation_gain'] ?> m</p>

    <h4 class="mt-4"> Description </h4>
    <p class="card-text"> <?= $hike['description'] ?></p>

    <div class="mb-4">
        <?php if (empty($hike['image'])) : ?>
            <img src="/assets/default.jpg" class="img-thumbnail card-img-top h-200">
        <?php else : ?>
            <img src="<?= $hike['image'] ?>" class="img-thumbnail card-img-top h-200">
        <?php endif; ?>
    </div>

    <?php if (!empty($tags)) : ?>

        <p>
            <?php foreach ($tags as $tag) : ?>

                <a href="/tag?tagId=<?= $tag['ID'] ?>" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                    <?= $tag['name'] ?>
                </a>&nbsp;

            <?php endforeach; ?>
        </p>
    <?php endif; ?>
</div>
<a role="button" class="btn btn-secondary" href="/">Go back home !</a>