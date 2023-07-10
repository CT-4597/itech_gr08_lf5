<?php
    include('includes/logger.php');
    include('includes/helper.php');
    include('includes/config.php');
    include('includes/database.php');
    include('includes/BaseController.php');

    # establish database connection
    $db = new DatabaseConnection($CONFIG['dbhost'], $CONFIG['dbuser'], $CONFIG['dbpassword'], $CONFIG['dbname']);

    # Authentification
    session_start();
    include('includes/auth.php');
    $auth = new authentification($db);

    # Array of all controller classes
    $controllers = array();
    $vars = array();

    include("controllers/header_user.php");
    include("controllers/filters.php");
    include("controllers/cart_manager.php");

    # Set controller and model to page or to the default page
    if(isset($_GET['page'])){
        $PageController = "controllers/{$_GET['page']}.php";
    } else {
        $PageController = "controllers/{$CONFIG['default_page']}.php";
    }

    # Load the page controller
    include($PageController);

    # Execute all early methods
    foreach ($controllers as $controller)
        if (method_exists($controller, 'RunEarly')) {
            $controller->RunEarly();
        }
    # Execute all default methods
    foreach ($controllers as $controller)
        if (method_exists($controller, 'RunDefault')) {
            $controller->RunDefault();
        }
    # Execute all late methods
    foreach ($controllers as $controller)
        if (method_exists($controller, 'RunLate')) {
            $controller->RunLate();
        }

    function loadViewer($container) {
        global $auth;
        global $vars;
        global $controllers;
        foreach ($controllers as $controller)
            if($controller->HasView($container)) {
                include("views/{$controller->GetView($container)}.php");
                return;
            }
        Logger::log("No view found for container {$container}.");
    }

    $db->closeConnection();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kraut & Rüben</title>
    <link rel="stylesheet" href="/style.css">
    <script src="/scripts.js"></script>
</head>
<body>
    <div class="header">
        <div style="position: relative; left: 0px; top: 0px; border: 1px solid blue; height: 100%; width: 200px;">&nbsp</div>
        <div style="border: 1px solid blue; height: 100%;">&nbsp</div>
        <div style="position: relative; right: 0px; top: 0px; border: 1px solid blue; height: 100%; width: 200px;">&nbsp</div>

    </div>
    <div class="navigation">
        <a href="/" class="navitem"><img src="/images/icon_home.svg" width="48" height="48">&nbsp;</a>
        <a href="/zutaten" class="navitem">Zutaten</a>
        <a href="/box/rabatte" class="navitem">Rabatt-Boxen</a>
        <a href="/box/bio" class="navitem">Bio-Boxen</a>
        <a href="/box/rezepte" class="navitem">Rezept-Boxen</a>
        <a href="/warenkorb" class="navitem" id="order_item_count"><img src="/images/icon_shopping_cart.svg" width="48" height="48"><?php loadViewer("CartDisplay"); ?></a>
        <a href="#" class="navitem" onclick="toggleFilter()"><img src="/images/icon_filter<?php if($vars['filters_active']) echo "_used"; ?>.svg" width="48" height="48">&nbsp;</a>
    </div>

    <div class="filterbox" id="filterbox" style="display: none">
        <?php loadViewer("Filters"); ?>
    </div>

    <div class="content">
        <?php loadViewer("Content"); ?>
    </div>
    <div class="sql_logger_inner" id="sql_logger_inner"><?php if($CONFIG['logger']) Logger::printLog(); ?></div>
    <script>
        moveLogger();
    </script>
</body>
