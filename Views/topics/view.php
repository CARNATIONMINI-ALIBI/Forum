<section class="viewTopic">
    <h2><?= $this->topic['summary']; ?></h2>

    <div class="topic">
        <p><span class="topicName">RoYaLL</span></p>
        <p id="topicBody"><?= $this->topic['body']; ?></p>
        <div id="topicEdit" style="display:none">
             <div id="addTopic">
                <div id="response"><h2>Edit Topic</h2></div>
                <input type="text" name="summary" id="summary" placeholder="Summary" value="<?=$this->topic['summary'];?>"/>
                <textarea name="body" id="body" placeholder="Description"><?=$this->topic['body'];?></textarea>
                <input type="text" id="tags" placeholder="tags" value="<?= $this->tags; ?>" />
                <button onclick="editTopic()">Edit topic</button>
                <button onclick="cancelEdit()">Cancel</button>
            </div>
        </div>
        <p class="dateTime">03:45 pm 25 Aug 2014</p>
        <p class="votesNumber">Votes: 256</p>
        <a href="#" class="vote">+</a>
        <a href="#" class="vote">-</a>
    </div>
    <div class="viewTopicButtons">
        <?php if($this->topic['is_closed'] == 0): ?>
            <button id="answerButton">Answer</button>
        <?php endif; ?>
        <?php if ($this->isOwnTopic || $this->isAdmin): ?>
            <a class="button" id="editTopic" href="#x">Edit</a>
            <?php if($this->topic['is_closed'] == 0):?>
                <a class="button" id="closeTopic" href="#">Close</a>
            <?php elseif($this->topic['is_closed'] == 1 && $this->isAdmin): ?>
                <a class="button" id="reopenTopic" href="#">Reopen</a>
            <?php endif; ?>
            <a class="button" id="deleteTopic" href="#">Delete</a>
        <?php endif; ?>
    </div>
    <div id="answerField"></div>

    <?php foreach ($this->answers as $answer): ?>
        <?php $isOwnAnswer = isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $answer['user_id']); ?>
        <div class="answer">
            <div class="answerBody">
                <p><span class="answerName">RoYaLL</span></p>
                <p class="answerBody" id="answerBody<?=$answer['id'];?>"><?= $answer['body']; ?></p>
                <?php if($isOwnAnswer || $this->isAdmin): ?>
                    <div id="answerEdit<?=$answer['id'];?>" style="display:none">
                        <div id="addAnswer<?=$answer['id'];?>">
                           <div id="response<?=$answer['id'];?>"><h2>Edit Answer</h2></div>
                           <textarea name="body" id="body<?=$answer['id'];?>" placeholder="Description"><?=$answer['body'];?></textarea>
                           <button onclick="editAnswer(<?=$answer['id'];?>)">Edit answer</button>
                           <button onclick="cancelAnswerEdit(<?=$answer['id'];?>)">Cancel</button>
                       </div>
                    </div> 
                <?php endif; ?>
                <p class="dateTime">03:45 pm 25 Aug 2014</p>
                <p class="votesNumber">Votes: 256</p>
                <a href="#" class="vote">+</a>
                <a href="#" class="vote">-</a>
            </div>
            <?php if($isOwnAnswer || $this->isAdmin): ?>
                <div class="answerButtons">
                    <a class="button" onclick="toggleEditAnswer(<?=$answer['id'];?>)" href="#">Edit</a>
                    <a class="button" onclick="deleteAnswer(<?=$answer['id'];?>)" href="#">Delete</a>
                </div>
            <?php endif; ?>

        </div>
    <?php endforeach; ?>
</section>
<script>
    var buttonAnswer = $('#answerButton');
    var answerField = $('#answerField');
    var buttonClose = $('#closeAnswerField');
    buttonAnswer.click(function () {
        var answerHtml = '';
        <?php if (!$this->getFrontController()->getController()->getApp()->UserModel->isLogged()): ?>
        answerHtml += '<label for="author">Your Name</label>' +
            '<input type="text" id="author" /><br />';
        <?php endif; ?>
        answerHtml += '<label for="answer">Answer</label>' +
            '<textarea id="answer""></textarea><br />' +
            '<a href="#" id="submitAnswer" onclick="addReply()">Submit</a>'
        answerField.html(answerHtml);
        answerField.css("padding", "20px");
    });
    
    $("#editTopic").click(function() {
        $("#topicBody").hide();
        $("#topicEdit").show();
    });
    
    $("#closeTopic").click(function() {
        $.post("<?= $this->url('topics', 'close', 'id', $this->topic['id']);?>", {
            
        }).done(function (response){
            var json = $.parseJSON(response);
            if (json.success == 1) {
                window.location = "<?= $this->url('topics', 'view', 'id', $this->topic['id']); ?>";
            }
        });
    });
    
    $("#reopenTopic").click(function() {
        $.post("<?= $this->url('topics', 'reopen', 'id', $this->topic['id']);?>", {
            
        }).done(function (response){
            var json = $.parseJSON(response);
            if (json.success == 1) {
                window.location = "<?= $this->url('topics', 'view', 'id', $this->topic['id']); ?>";
            }
        });
    });
    
    $("#deleteTopic").click(function() {
        $.post("<?= $this->url('topics', 'delete', 'id', $this->topic['id']);?>", {
            
        }).done(function (response){
            var json = $.parseJSON(response);
            if (json.success == 1) {
                window.location = "<?= $this->url('forums', 'view', 'id', $this->topic['forum_id']); ?>";
            }
        });
    })
    

    function addReply() {
        $.post("<?= $this->url('answers', 'add', 'topicid', $this->topic['id']); ?>", {
            username: $('#author').val(),
            body: $('#answer').val()
        }).done(function (response) {
            var json = $.parseJSON(response);
            if (json.success == 1) {
                window.location = "<?= $this->url('topics', 'view', 'id', $this->topic['id']); ?>";
            }
        });
    }
    
    function editTopic() {
        $.post("<?= $this->url('topics', 'edit', 'id', $this->topic['id']); ?>", {
            summary: $('#summary').val(),
            body: $('#body').val(),
            tags: $('#tags').val()
        }).done(function (response) {
            var json = $.parseJSON(response);
            if (json.success == 1) {
                window.location = "<?= $this->url('topics', 'view', 'id', $this->topic['id']); ?>";
            }
        });
    }
    
    function cancelEdit() {
        $("#topicBody").show();
        $("#topicEdit").hide();
    }
    
    function toggleEditAnswer(answer_id) {
        $("#answerBody" + answer_id).hide();
        $("#answerEdit" + answer_id).show();
    }
    
    function cancelAnswerEdit(answer_id) {
        $("#answerBody" + answer_id).show();
        $("#answerEdit" + answer_id).hide();
    }
    
    function editAnswer(answer_id) {
        $.post("<?= $this->url('answers', 'edit', 'id'); ?>" + answer_id , {
            body: $('#body' + answer_id).val()
        }).done(function (response) {
            var json = $.parseJSON(response);
            if (json.success == 1) {
                window.location = "<?= $this->url('topics', 'view', 'id', $this->topic['id']); ?>";
            }
        });
    }
    
    function deleteAnswer(answer_id) {
        $.post("<?= $this->url('answers', 'delete', 'id');?>" + answer_id , {
            
        }).done(function (response){
            var json = $.parseJSON(response);
            if (json.success == 1) {
                window.location = "<?= $this->url('topics', 'view', 'id', $this->topic['id']); ?>";
            }
        });
    }
    
</script>
