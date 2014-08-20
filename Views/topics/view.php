<?php if (!isset($this->topic)): ?>
    <p>There's no such topic </p>
<?php else: ?>
    <table border="1">
        <tr>
            <td>Body</td>
            <td>Posted By ID</td>
            <td> Posted On </td>
        </tr>
        <tr>
            <td><?=$this->topic['body'];?></td>
            <td><?=$this->topic['user_id'];?></td>
            <td><?=$this->topic['created_on'];?></td>
        </tr>
    </table>
<?php endif; ?>
