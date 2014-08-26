    <div id="addTopic">
        <div id="response"><h2>New Topic</h2></div>
        <input type="text" name="summary" id="summary" placeholder="Summary"/>
        <textarea name="body" id="body" placeholder="Description"></textarea>
        <input type="text" id="tags" placeholder="tags"/>
        <button onclick="addTopic()">Add topic</button>
    </div>
    <script>

        function addTopic() {
            $.post("<?=$this->url('topics', 'add', 'forumid', 1);?>", {
                summary: $('#summary').val(),
                body: $('#body').val()
            }).done(function (response) {
                var json = $.parseJSON(response);
                if (json.success == 1) {
                    $("#response").html("<h2>Topic has been added successfully</h2>");
                }
            });
        }
    </script>


