<section class="viewTopic">
    <header>
        <h1>Title of the topic</h1>
        <a href="#" class="postReply">Postreply</a>
        <a href="<?= $this->url('topics', 'edit', 'id', $this->topic['id']);?>">Edit</a>
        <a href="<?= $this->url('topics', 'close', 'id', $this->topic['id']);?>">Close</a>
        <a href="<?= $this->url('topics', 'delete', 'id', $this->topic['id']);?>">Delete</a>
    </header>
    <div class="topic">
        <p><?= $this->topic['body']; ?></p>
    </div>
    <?php foreach ($this->answers as $answer): ?>
    <div class="answer">
        <a href="<?= $this->url('answers', 'edit', 'id', $answer['id']);?>">Edit</a>
        <a href="<?= $this->url('answers', 'close', 'id', $answer['id']);?>">Close</a>
        <a href="<?= $this->url('answers', 'delete', 'id', $answer['id']);?>">Delete</a>
        <p><?= $answer['body']; ?></p>
    </div>
    <?php endforeach; ?>
</section>