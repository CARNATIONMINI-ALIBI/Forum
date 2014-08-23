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
            $.post( "<?=$this->url('topics', 'find');?>", { 
                keyword : $('#searchbox').val()
            }).done(function( response ) {
                var json = $.parseJSON(response);
                if (json.success == 0) {
                    alert('nishto');
                } else {
                    $.each(json, function(i, item) {
                        var href = "<a href='<?=HOST;?>topics/view/id/" + item.id + "'>" + item.summary + "</a><br />";
                        $("#topics").append(href);
                    } )
                }
            });
        }
    </script>
</head>

<body>
<div id="wrapper">
        
    <header>
        <h1>The best forum ever!!!</h1>
        <h2>(: You just have to love it :)</h2>
        <ul>
            <li>
                <a href="#" id="loginButton">Login</a>
            </li>
            <li>
                <a href="#" id="registerButton">Register</a>
            </li>
        </ul>
        
            <input type="text" id="searchbox" placeholder="search..." />
            <a href="#" onclick="searchTopics()">Search</a>
            <div id="topics"></div>
    </header>
    <main>