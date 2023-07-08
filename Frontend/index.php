<?php
    include('includes/logger.php');
    include('includes/config.php');
    include('includes/database.php');

    # establish database connection
    $db = new DatabaseConnection($CONFIG['dbhost'], $CONFIG['dbuser'], $CONFIG['dbpassword'], $CONFIG['dbname']);

    Logger::log("Dies ist ein Logger.");
    Logger::log("Hier kann ganz viel tolles rein.");
    Logger::log("Und Fehler auch.");
    Logger::log("DBUser: {$CONFIG['dbuser']}");

    if(isset($_GET['page'])){

    } else {
        $controller = "controller/{$CONFIG['default_page']}.php"
        $viewer = "viewer/{$CONFIG['default_page']}.php"
    }
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kraut & Rüben</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <div class="header">
        <img src="/images/Logo.png" class="header_logo">
        <div class="sql_logger" id="sql_logger"><?php if($CONFIG['logger']) Logger::printLog(); ?></div>
        <img src="/images/user_icon.png" class="header_user_icon">
        <div class="header_login">User Krams</div>
    </div>
    <div class="navigation">
        <a href="/" class="navitem"><img src="/images/icon_home.svg" width="48" height="48">&nbsp;</a>
        <a href="/zutaten" class="navitem">Zutaten</a>
        <a href="/box/rabatte" class="navitem">Rabatt-Boxen</a>
        <a href="/box/bio" class="navitem">Bio-Boxen</a>
        <a href="/box/rezepte" class="navitem">Rezept-Boxen</a>
        <a href="/warenkorb" class="navitem" id="order_item_count">&nbsp;</a>
        <a href="#" class="navitem" onclick="toggleFilter()"><img src="/images/icon_filter.svg" width="48" height="48">&nbsp;</a>
    </div>

    <div class="filterbox" id="filterbox" style="display: none">
        <form method="post">
          <h3>Allergene</h3>
        <h3>Kategorien</h3>
        <input type="submit" name="ApplyFilter" value="Übernehmen">
        </form>
    </div>

    <div class="content">
        Content
    </div>
</body>
