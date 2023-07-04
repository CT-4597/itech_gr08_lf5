<?php
    include('includes/config.php');
    include('includes/helper.php');
    include('includes/sql_logger.php');

    # Check for page var. Get the default page if needed.
    if(isset($_GET['page'])) {
        $page = 'content/' . htmlspecialchars($_GET["page"]) . '.php';
    } else {
        $page = 'content/' . $default_page . '.php';
    }

    if (session_status() == PHP_SESSION_ACTIVE) {
        echo "session is running";
    } else {
        session_start();
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
        <div class="sql_logger" id="sql_logger"></div>
        <img src="/images/user_icon.png" class="header_user_icon">
    </div>
    <div class="navigation">
        <a href="/" class="navitem">Home</a>
        <a href="/zutaten" class="navitem">Zutaten</a>
        <a href="/index.php" class="navitem">Rabatt-Boxen</a>
        <a href="/index.php" class="navitem">Bio-Boxen</a>
        <a href="/index.php" class="navitem">Rezept-Boxen</a>
    </div>

    <div class="content">
        <?php include($page); ?>
    </div>

</body>
<script>
    document.getElementById("sql_logger").innerHTML = '<?php sql_print(); ?>';
</script>
<?php
    $conn->close();
?>
