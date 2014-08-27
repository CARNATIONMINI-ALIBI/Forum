<?php /* @var $this \ANSR\View */ ?>
<table class="mainTable">
    <tr>
        <th>
            <a href="#">Category</a>
        </th>
        <th>
            Topics
        </th>
        <th>
            Posts
        </th>
        <th>
            Last post
        </th>
    </tr>
    <?php foreach ($this->forums as $forum): ?>
    <?php $userInfo = $this->getFrontController()->getController()->getApp()->ForumModel->getLastAuthorInfo($forum['id']);?>
    <tr>
        <td>
            <a href="<?=$this->url('forums', 'view', 'id', $forum['id']);?>"> <?= $forum['name']; ?> </a>
        </td>
        <td>
            <?= $this->getFrontController()->getController()->getApp()->ForumModel->getTopicsCount($forum['id']); ?>
        </td>
        <td>
            <?= $this->getFrontController()->getController()->getApp()->ForumModel->getPostsCount($forum['id']); ?>
        </td>
        <td>
            by <a href="<?= $this->url('users', 'profile', 'id', $this->getFrontController()->getController()->getApp()->UserModel->getIdByUsername($userInfo['username']));?>"><?= $userInfo['username']; ?></a><br/>
            <span><?= $userInfo['created_on']; ?></span>
        </td>
    </tr>
    <?php endforeach; ?>
</table>