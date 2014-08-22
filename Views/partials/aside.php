<?php /* @var $this \ANSR\View */ ?>

<ul id="aside">
    <?php foreach ($this->getFrontController()->getController()->getApp()->CategoryModel->getCategories() as $value): ?>
<!--        --><?php //var_dump($value)?>
        <li class="aside"><?php echo $value["name"]; ?></li>
    <?php endforeach ?>



<!--    --><?php //foreach ($this->getFrontController()->getController()->getApp()->CategoryModel->getCategories("") as $value): ?>
<!--        <li class="aside">--><?php //echo $value ?><!--</li>-->
<!--    --><?php //endforeach ?>

</ul>

