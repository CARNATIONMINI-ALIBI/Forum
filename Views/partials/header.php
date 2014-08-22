<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Best Forum</title>
    <?php foreach ($this->getStyles() as $style): ?>
        <?= $style; ?>
    <?php endforeach; ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
<div id="wrapper">
    <header>
        <h1>The best forum ever!!!</h1>
        <h2>(: You just have to love it :)</h2>
        <ul>
            <li>
                <a href="#">Login</a>
            </li>
            <li>
                <a href="#">Register</a>
            </li>
        </ul>
        <form>
            <input type="text" placeholder="search..." />
            <button type="submit">Search</button>
        </form>
    </header>
    <main>

