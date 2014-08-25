<?php /* @var $this \ANSR\View */ ?>
<div id="response"></div>
<section id="loginRegisterField">
    
</section>
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
            by <a href="<?= $this->url('users', 'profiles', 'id', $this->getFrontController()->getController()->getApp()->UserModel->getIdByUsername($userInfo['username']));?>"><?= $userInfo['username']; ?></a><br/>
            <span><?= $userInfo['created_on']; ?></span>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<script>


    var loginRegisterField = $('#loginRegisterField');
    var loginButton = $('#loginButton');
    var registerButton = $('#registerButton');

    loginButton.click(function () {
        loginRegisterField.html('<h2>Login</h2>' +
            '<label for="userLogin">Username</label>' +
            '<input type="text" id="userLogin"/>' +
            '<label for="passLogin">Password</label>' +
            '<input type="password" id="passLogin"/>' +
            '<button id="submit" onclick="login();">Submit</button>');
        $('#response').html('');
        $('#topics').html('');

        $("#userLogin").keypress(function(e) {
           if (e.keyCode == 13) {
               $("#submit").click();
           }
        });

        $("#passLogin").keypress(function(e) {
           if (e.keyCode == 13) {
               $("#submit").click();
           }
        });
    });
    registerButton.click(function () {

        loginRegisterField.html('<h2>Register</h2>' +
            '<label for="userRegister">Username</label>' +
            '<input type="text" id="userRegister"/>' +
            '<label for="passRegister">Password</label>' +
            '<input type="password" id="passRegister"/>' +
            '<label for="passRepeat">Repeat password</label>' +
            '<input type="password" id="passRepeat"/>' +
            '<button id="submit" onclick="register();">Submit</button>');
        $('#response').html('');
        $('#topics').html('');
        $("#userRegister").keypress(function(e) {
            if (e.keyCode == 13) {
                $("#submit").click();
            }
        });

        $("#passRegister").keypress(function(e) {
            if (e.keyCode == 13) {
                $("#submit").click();
            }
        });
        $("#passRepeat").keypress(function(e) {
            if (e.keyCode == 13) {
                $("#submit").click();
            }
        });

    });


    function login() {
        $.post("<?=$this->url('users', 'login');?>", {
            username: $('#userLogin').val(),
            password: $('#passLogin').val()
        }).done(function (response) {
            var json = $.parseJSON(response);
            if (json.success == 1) {
                $('#response').html('');
                window.location = "<?=$this->url('topics', 'all');?>";
            } else {
                $('#response').html('<h2 class="incorrect">' + 'Incorrect username or password' + '</h2>');
            }
        });
    }

    function register() {

        alert('Register')
    }
</script>
