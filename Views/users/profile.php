<?php if (!isset($this->user) || empty($this->user)): ?>
    <h2> No such user  </h2>
<?php elseif ($this->isOwnProfile): ?>
    <section class="profile">
        <h2><label style="font-size: 20px;">Name: <input type="text" name="username" value="<?= $this->user['username'];?>"></label></h2>
        <h3><?= $this->user['role'];?></h3>
        <p>Registered: <span><?= $this->user['register_date'];?></span></p>
        <p><label>Email: <span><input type="text" name="email" value="<?= $this->user['email'];?>"</span></label></p>
        <p>Posts: <span><?= $this->user['posts']; ?></span></p>
        <p>Votes: <span><?= $this->user['votes']; ?></span></p>
        <input type="submit" />
    </section>
<?php else: ?>
<section class="profile">
    <h2><?= $this->user['username'];?></h2>
    <h3><?= $this->user['role'];?></h3>
    <p>Registered: <span><?= $this->user['register_date'];?></span></p>
    <p>Email: <span><?= $this->user['email'];?></span></p>
    <p>Posts: <span><?= $this->user['posts']; ?></span></p>
    <p>Votes: <span><?= $this->user['votes']; ?></span></p>
</section>
<?php endif; ?>
