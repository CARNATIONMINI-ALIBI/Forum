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
            $.post("<?=$this->url('topics', 'find');?>", {
                keyword: $('#searchbox').val()
            }).done(function (response) {
                var json = $.parseJSON(response);
                if (json.success == 0) {
                    alert('nishto');
                } else {
                    $.each(json, function (i, item) {
                        var href = "<a href='<?=HOST;?>topics/view/id/" + item.id + "'>" + item.summary + "</a><br />";
                        $("#topics").append(href);
                    })
                }
            });
        }
    </script>
</head>

<body>
<div id="wrapper">

    <header>
        <h1>Space Odisey Forum</h1>

        <h2>Welcome to our space adventure</h2>
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
            <button onclick="searchTopics()">Search</button>
        </div>
        <div id="topics"></div>
    </header>
    <main>