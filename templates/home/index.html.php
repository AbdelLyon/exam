<?php foreach ($velos as $velo) : ?>
    <a class='card list' href='/?type=home&action=show&id=<?= $velo->getId() ?>'>
        <div class='d-flex flex-column align-items-center'>
            <h5 class='fw-bold fs-6'> <?= $velo->getName() ?> </h5>
            <img height="200" src='<?= $velo->getImage() ?>' />
        </div>
    </a>
<?php endforeach ?>