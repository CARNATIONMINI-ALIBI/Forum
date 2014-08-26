<section class="viewTopic">
    <h2>Title of the topic</h2>

    <div class="viewTopicButtons">
        <a class="button" href="#">Postreply</a>
        <a class="button" href="<?= $this->url('topics', 'edit', 'id', $this->topic['id']); ?>">Edit</a>
        <a class="button" href="<?= $this->url('topics', 'close', 'id', $this->topic['id']); ?>">Close</a>
        <a class="button" href="<?= $this->url('topics', 'delete', 'id', $this->topic['id']); ?>">Delete</a>
    </div>
    <div class="topic">
        <p><?= $this->topic['body']; ?></p>
    </div>
    <?php foreach ($this->answers as $answer): ?>
        <div class="answer">
            <div class="answerButtons">
                <a class="button" href="<?= $this->url('answers', 'edit', 'id', $answer['id']); ?>">Edit</a>
                <a class="button" href="<?= $this->url('answers', 'close', 'id', $answer['id']); ?>">Close</a>
                <a class="button" href="<?= $this->url('answers', 'delete', 'id', $answer['id']); ?>">Delete</a>
            </div>

            <div class="answerBody">
                <p><?= $answer['body']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</section>