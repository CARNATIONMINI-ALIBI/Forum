<script>
    
    function postReply() {
        var answerHtml = "<section class=\"answer\">";
        
        <?php if (!$this->getFrontController()->getController()->getApp()->UserModel->isLogged()): ?>
        answerHtml +=     "<label for=\"author\">Your Name</label>"+
                          "<input type=\"text\" id=\"author\" />";
        <?php endif; ?>
                            
        answerHtml +=     "<label for=\"answer\">Description</label>"+
                          "<textarea id=\"answer\"></textarea>"+
                          "<button onclick=\"addReply()\" id=\"submitAnswer\">Submit</button>"+
                          "</section>"
        $('#newAnswer').html(answerHtml);
    }
    
    function addReply() {
            $.post("<?= $this->url('answers', 'add', 'topicid', $this->topic['id']);?>", {
                username: $('#author').val(),
                body: $('#answer').val()
            }).done(function (response) {
                var json = $.parseJSON(response);
                if (json.success == 1) {
                    window.location = "<?= $this->url('topics', 'view', 'id', $this->topic['id']);?>";
                }
            });
   }
</script>
<section class="viewTopic">
    <header>
        <h1>Title of the topic</h1>
        <a href="#" class="postReply" onclick="postReply()">Postreply</a>
        <a href="<?= $this->url('topics', 'edit', 'id', $this->topic['id']);?>">Edit</a>
        <a href="<?= $this->url('topics', 'close', 'id', $this->topic['id']);?>">Close</a>
        <a href="<?= $this->url('topics', 'delete', 'id', $this->topic['id']);?>">Delete</a>
    </header>
    <div id="newAnswer"></div>
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