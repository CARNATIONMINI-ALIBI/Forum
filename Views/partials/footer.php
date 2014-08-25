<?php /* @var $this \ANSR\View */ ?>
<?php $lastUserInfo = $this->getFrontController()->getController()->getApp()->UserModel->getLastRegisteredUser(); ?>
</main>
<footer>
    <section class="whoIsOnline">
        <a href="<?= $this->url('users', 'online'); ?>"><h3>Who is Online </h3></a>
        <div>
            <p>Our users have posted <span><?= $this->getFrontController()->getController()->getApp()->TopicModel->getTopicsCount();?></span> articles</p>
            <p>The newest registered user is <a href="<?= $this->url('users', 'profile', 'id', $lastUserInfo['id']);?>"><?= $lastUserInfo['username']; ?></a>.</p>
        </div>
    </section>
    <h4>Powered By ANSR Framework</h4>
</footer>
</div>
</body>
</html>