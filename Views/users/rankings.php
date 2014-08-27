<?php $position = 0; ?>
<table class="online">
    <tr>
        <th>#</th>
        <th>Username</th>
        <th>Email</th>
        <th>Joined</th>
        <th>Posts</th>
        <th>Votes</th>
    </tr>
    <?php foreach ($this->users as $user): ?>
    <tr>
        <td><?= ++$position; ?></td>
        <td><a href="<?= $this->url('users', 'profile', 'id', $user['id']);?>"><?= $user['username']; ?></a></td>
        <td><a href="mailto:<?= $user['email']; ?>"><?= $user['email']; ?></a></td>
        <td><?= $user['register_date']; ?></td>
        <td><?= $user['posts']; ?></td>
        <td><?= $user['votes']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
