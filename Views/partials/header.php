<?php /* @var $this \ANSR\View */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Best Forum</title>
    <?php foreach ($this->getStyles() as $style): ?>
        <?= $style; ?>
    <?php endforeach; ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>

        function searchTopics() {
            $('#loginRegisterField').html('');
            $('#topics').html('');
            $('#response').html('');

            $.post("<?=$this->url('topics', 'find');?>", {
                keyword: $('#searchbox').val()
            }).done(function (response) {
                var json = $.parseJSON(response);
                if (json.success == 0) {
                    $('#topics').html('<p class="noResults">No results found</p>')
                } else {
                    $('#topics').html('<h2>Search results</h2>')
                    $.each(json, function (i, item) {
                        var href = "<a href='<?=HOST;?>topics/view/id/" + item.id + "'>" + item.summary + "</a><br />";
                        $('#topics').append(href);
                    })
                }
            });
        }

        $(document).ready(function () {
            $("#logoutButton").click(function () {
                $.post("<?=$this->url('users', 'logout');?>", {

                }).done(function () {
                    window.location = "<?=$this->url('welcome', 'index');?>";
                });
            })
        });
    </script>
</head>

<body>
<div id="wrapper">

    <header>
        <h1>Space Odyssey Forum</h1>

        <h2>Space Adventure</h2>

        <?php if (!$this->getFrontController()->getController()->getApp()->UserModel->isLogged()): ?>
            <ul>
                <li>
                    <button id="loginButton">Login</button>
                </li>
                <li>
                    <button id="registerButton">Register</button>
                </li>
            </ul>
            <div id="search">
                <input type="text" id="searchbox" placeholder="search..."/>
                <button onclick="searchTopics()">find</button>
            </div>
        <?php else: ?>
            <ul>
                <li>
                    <button id="logoutButton">Logout</button>
                </li>
            </ul>
            <div id="search">
                <input type="text" id="searchbox" placeholder="search..."/>
                <button onclick="searchTopics()">find</button>
            </div>

            <h2 class="welcomeUser">Welcome <?= $_SESSION['username']; ?></h2>
        <?php endif; ?>
        <div id="topics"></div>
    </header>
    <main>