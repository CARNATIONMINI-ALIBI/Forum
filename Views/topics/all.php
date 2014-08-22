
<?php foreach ($this->topics as $topic):?>
    <div class="topics">
        <a href="<?=$this->url('topics', 'view', 'id', $topic['forum_id']);?>"><?= $topic['summary']; ?> </a> [ <?= $topic['created_on']; ?> ]
    </div>
<?php endforeach; ?>
</div>
