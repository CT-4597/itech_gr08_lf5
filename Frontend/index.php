<?php
    include('includes/config.php');

    # Check for page var. Get the default page if needed.
    if(isset($_GET['page'])) {
        $page = 'content/' . htmlspecialchars($_GET["page"]) . '.php';
    } else {
        $page = 'content/' . $default_page . '.php';
    }
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kraut & Rüben</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="header">
        <img src="/images/Logo.png" class="logo">
        <h1>KuR-Verwaltung</h1>
        <img src="/images/user_icon.png" class="user_icon">
    </div>
    <div class="navigation">
        <a href="/index.php?page=ingredients" class="navitem">Zutaten</a>
        <a href="/index.php" class="navitem">Rabatt-Boxen</a>
        <a href="/index.php" class="navitem">Bio-Boxen</a>
        <a href="/index.php" class="navitem">Rezept-Boxen</a>
    </div>

    <div class="content">
        <?php include($page); ?>
    </div>

</body>
<?php
    $conn->close();
?>