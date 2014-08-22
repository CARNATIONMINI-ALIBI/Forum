<?php if (!isset($this->forums)): ?>
    <p> Forum does not exists </p>
<?php else: ?>
    <table border=1">
        <tr>
            <td>Forum name</td>
        </tr>
        <?php foreach ($this->forums as $forum): ?>
        <tr>
            <td><a href="<?=$this->url('forums', 'topics', 'id', $forum['id']);?>"><?=$forum['name'];?></a></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
