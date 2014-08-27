<?php if (!isset($this->user)) die; ?>
<li>
    <li><a href="<?= $this->url('users', 'profile', 'id', $this->user['id']); ?>">Users</a><span></span></li>
</li>