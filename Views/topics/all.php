<div id="mainSection">
<?php foreach ($this->topics as $topic):?>
    <a href="<?=$this->url('topics', 'view', 'id', $topic['id']);?>"><?= $topic['summary']; ?> </a> [ <?= $topic['created_on']; ?> ] <br/>
<?php endforeach; ?>
</div>
