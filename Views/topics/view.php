<section class="viewTopic">
    <h2>Title of the topic</h2>

    <div class="topic">
        <p><?= $this->topic['body']; ?></p>
    </div>
    <div class="viewTopicButtons">
        <button id="answerButton">Answer</button>
        <a class="button" href="<?= $this->url('topics', 'edit', 'id', $this->topic['id']); ?>">Edit</a>
        <a class="button" href="<?= $this->url('topics', 'close', 'id', $this->topic['id']); ?>">Close</a>
        <a class="button" href="<?= $this->url('topics', 'delete', 'id', $this->topic['id']); ?>">Delete</a>
    </div>
    <div id="answerField"></div>

    <?php foreach ($this->answers as $answer): ?>

        <div class="answer">
            <div class="answerBody">
                <p><?= $answer['body']; ?></p>
            </div>
            <div class="answerButtons">
                <a class="button" href="<?= $this->url('answers', 'edit', 'id', $answer['id']); ?>">Edit</a>
                <a class="button" href="<?= $this->url('answers', 'close', 'id', $answer['id']); ?>">Close</a>
                <a class="button" href="<?= $this->url('answers', 'delete', 'id', $answer['id']); ?>">Delete</a>
            </div>


        </div>
    <?php endforeach; ?>
</section>
<script>
    var buttonAnswer = $('#answerButton');
    var answerField = $('#answerField');
    var buttonClose = $('#closeAnswerField');
    buttonAnswer.click(function () {
        answerField.html(
            '<label for="outername">Your Name</label>' +
            '<input type="text" id="outername" /><br />' +
            '<label for="answer">Answer</label>' +
            '<textarea id="answer""></textarea><br />' +
            '<a href="#" id="submitAnswer">Submit</a>');
        answerField.css("padding", "20px");
    });

</script>