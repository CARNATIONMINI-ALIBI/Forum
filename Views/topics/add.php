
    <script>
        function addTopic() {
            $.post("", {
                summary: $('#summary').val(),
                body: $('#body').val(),
                tags: $('#tags').val()
            }).done(function (response) {
                var json = $.parseJSON(response);
                if (json.success == 1) {
                    $("#response").html("<h1>Topic has been added successfully</h1>");
                    window.location = "<?= $this->url('topics', 'view', 'id');?>" + json.topic_id
                }
            });
        }
    </script>
    
    <div id="addTopic">
        <h1>New Topic</h1>
        <label for="summaty">Summary</label>
        <input type="text" name="summary" id="summary"/>
        <label for="body">Description</label>
        <textarea name="body" id="body"/></textarea>
        <label for="tags">Tags</label>
        <input type="text" id="tags"/>
        <button onclick="addTopic()">Add topic</button>
    </div>

    <div id="response"></div>


