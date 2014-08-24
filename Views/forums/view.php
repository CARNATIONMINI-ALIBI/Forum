<?php /* @var $this \ANSR\View */ ?>

<script>
    $(document).ready(function() {
        $('#gotoforum').click(function () {
            var option = $('#forums option:selected').val();
            window.location = "<?=$this->url('forums', 'view', 'id');?>" + option;
        });
    });
</script>

<h2><?= $this->forum['name']; ?></h2>
<a href="#">New Topic</a>
<table>
    <tr>
        <th>Topics</th>
        <th>Replies</th>
        <th>Views</th>
        <th>Last post</th>
    </tr>
    <?php foreach ($this->topics as $topic): ?>
    <?php $userInfo = $this->getFrontController()->getController()->getApp()->TopicModel->getLastAuthorInfo($topic['id']);?>
    <tr>
        <td><a href="<?=$this->url('topics', 'view', 'id', $topic['id']);?>"><?= $topic['summary']; ?></a></td>
        <td><?= $this->getFrontController()->getController()->getApp()->TopicModel->getPostsCount($topic['id']); ?></td>
        <td><?= $topic['views']; ?></td>
        <td>
            by <a href="<?= $this->url('users', 'profiles', 'id', $this->getFrontController()->getController()->getApp()->UserModel->getIdByUsername($userInfo['username']));?>"><?= $userInfo['username']; ?></a><br/>
            <span><?= $userInfo['created_on']; ?></span>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="#">New Topic</a>
<a href="<?=$this->url('welcome', 'index');?>">Return to Index</a>
<select id="forums">
    <?php foreach ($this->forums as $forum): ?>
    <option value="<?= $forum['id']; ?>"><?= $forum['name']; ?></option>
    <?php endforeach; ?>
</select>
<button id="gotoforum">Go</button>


