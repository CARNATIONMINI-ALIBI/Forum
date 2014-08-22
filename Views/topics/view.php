
<?php if (!isset($this->topic)): ?>

<input type="text" name="summary" id="summary"/>
<input type="text" name="body" id="body"/>

<script>
    
function addTopic() {
    $.post( "<?=$this->url('topics', 'add', 'forumid', 1);?>", { 
        summary: $('#summary').val(), 
        body: $('#body').val()
    }).done(function( response ) {
        var json = $.parseJSON(response);
        if (json.success == 1) {
            $("#response").html("<h1>Topic has been added successfully</h1>");
        }
    });
}
</script>
<a href="#" onclick="addTopic()">Add topic</a>
<div id="response"></div>

<?php else: ?>
    <table border="1">
        <tr>
            <td>Body</td>
            <td>Posted By ID</td>
            <td>Posted On </td>
        </tr>
        <tr>
            <td><?=$this->topic['body'];?></td>
            <td><?=$this->topic['user_id'];?></td>
            <td><?=$this->topic['created_on'];?></td>
        </tr>
    </table>
<?php endif; ?>
