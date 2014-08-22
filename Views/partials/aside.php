<?php /* @var $this \ANSR\View */ ?>
<script>

</script>
<ul id="aside">
    <?php foreach ($this->getFrontController()->getController()->getApp()->CategoryModel->getCategories() as $category): ?>

        <li class="aside"><?php echo $category["name"]; ?>
            <ul>
               <?php foreach ($this->getFrontController()->getController()->getApp()->ForumModel->getForums() as $forum): ?>

               <a href="<?=$this->url('topics', 'view', 'forumid', $forum["id"]);?>"><li class="asideForums"><?php echo $forum["name"]; ?></li></a>
                <?php endforeach ?>
            </ul>
        </li>
    <?php endforeach ?>
</ul>
<div id="mainSection">
