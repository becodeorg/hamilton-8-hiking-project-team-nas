<ul>
<?php foreach ($names as $name):
extract($name) ?>
<li><a href="/name?id=<?= $id ?>"><?= $name ?></a></li>
<?php endforeach; ?>
</ul>