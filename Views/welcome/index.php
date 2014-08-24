<?php /* @var $this \ANSR\View */ ?>
<section id="loginRegisterField">
    <h2>Login if you are a member</h2>

    <h2>Register if you're not</h2>
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
    
    $(document).ready(function() {
        
    });
    
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
            '<button>Submit</button>');
        $('#response').html('');
    });


    function login() {
        $.post("<?=$this->url('users', 'login');?>", {
            username: $('#userLogin').val(),
            password: $('#passLogin').val()
        }).done(function (response) {
            var json = $.parseJSON(response);
            if (json.success == 1) {
                window.location = "<?=$this->url('topics', 'all');?>";
            } else {
                $('#response').html('<h2 class="incorrect">' + 'Incorrect username or password' + '</h2>');
            }
        });
    }
</script>
<div id="response"></div>