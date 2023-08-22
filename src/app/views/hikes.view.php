<h1 class="py-4">Hike's List</h1>
<style>
    .card>img {
        width: 100%;
        height: 100%;
    }
</style>
<?php if (!empty($hikes)) : ?>
    <div class="row gy-5">
        <?php foreach ($hikes as $hike) : ?>

            <div class="col">
                <div class="card h-100" style="width: 18rem;">
                    <?php if (empty($hike['image'])) : ?>
                        <img src="/assets/default.jpg" class="img-thumbnail card-img-top h-200">
                    <?php else : ?>
                        <img src="<?= $hike['image'] ?>" class="img-thumbnail card-img-top h-200">
                    <?php endif; ?>
                    <div class="card-body">
                        <a href="/hike?hikeId=<?= $hike['ID'] ?>">
                            <h5 class="card-title"> <?= $hike['name'] ?></h5>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>