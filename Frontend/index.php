<?php
    include('includes/config.php');
    include('includes/helper.php');
    include('includes/sql_logger.php');
    include('includes/log.php');
    include('includes/sql_helper.php');

    session_start();

    # DESTRUCTION
    # in case something went wrong an we need the vars to be reseted
    if(isset($_GET['newsession']) || !isset($_SESSION['userid'])) {
      $_SESSION['userid'] = NULL;
      $_SESSION['shopping_card_ingredients'] = array();
      $_SESSION['allergies'] = array();
      $_SESSION['categories'] = NULL;
    }

    # Check for page var. Get the default page if needed.
    if(isset($_GET['page'])) {
        $page = 'content/' . htmlspecialchars($_GET["page"]) . '.php';
    } else {
        $page = 'content/' . $default_page . '.php';
    }

    # Filtering
    if(isset($_POST['filter'])) {
      if($_POST['filter'] == "apply") {
        if($_POST['categories'] == 'NULL')
          $_SESSION['categories'] = NULL;
        else
          $_SESSION['categories'] = $_POST['categories'];
        # if no allergies are selected, the var isn set
        if(isset($_POST['allergies']))
          $_SESSION['allergies'] = $_POST['allergies']
        else
          $_SESSION['allergies'] = array();
        debug_log(var_dump($_POST['allergies']));
      }
    }

    if (session_status() == PHP_SESSION_ACTIVE) {
      debug_log("acitve session: " . session_id());
    } else {
      debug_log("no active session</br>");
    }

    if(isset($_GET['newsession'])) {
      debug_log("Session Vars reinitialised.</br>");
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
        <div class="header_login">
        <?php
          if($_SESSION['userid'] == NULL){
            echo '<a href="/login">Login</a>&nbsp;';
            echo '<a href="/registrieren">Register</a>';
          } else {
            $userid = $_SESSION['userid'];
            $result = sql_fetch("SELECT VORNAME, NACHNAME FROM KUNDE WHERE KUNDENNR=$userid");

            echo 'Hallo, ' .  $result['VORNAME'] . ' ' . $result['NACHNAME'] . '</br>';
            echo '</br>';
            echo '<a href="/profil">Profil</a> &nbsp;';
            echo '<a href="/logout">Logout</a>';
          }
         ?>
         </div>
    </div>
    <div class="navigation">
        <a href="/" class="navitem"><img src="/images/icon_home.svg" width="48" height="48">&nbsp;</a>
        <a href="/zutaten" class="navitem">Zutaten</a>
        <a href="/box/rabatte" class="navitem">Rabatt-Boxen</a>
        <a href="/box/bio" class="navitem">Bio-Boxen</a>
        <a href="/box/rezepte" class="navitem">Rezept-Boxen</a>
        <a href="/warenkorb" class="navitem"><img src="/images/icon_shopping_card.svg" width="48" height="48">&nbsp;</a>
        <a href="#" class="navitem" onclick="toggleFilter()"><img src="/images/icon_filter.svg" width="48" height="48">&nbsp;</a>
    </div>

    <div class="filterbox" id="filterbox" style="display: none">
        <form method="post">
          <input type="hidden" name="filter" value="apply" />
        <?php
        echo "allergies(array):";
        var_dump($_SESSION['allergies']);
        echo "</br> categories:";
        var_dump($_SESSION['categories']);
        echo "</br>";
        $sql = log_sql("SELECT * FROM ALLERGEN");
	      $result = $conn->query($sql);


        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $alnr = 'Allergen' . $row['ALLERGENNR'];
            echo '<label for="' . $alnr . '">' . $row['ALLERGENBEZEICHNUNG'] . '</label>';
            echo '<input type="checkbox" id="' . $alnr . '" name="allergies[]" value="' . $row['ALLERGENNR'] . '">';
          }
        }
        $sql = log_sql("SELECT * FROM ERNAEHRUNGSKATEGORIE");
	      $result = $conn->query($sql);

          echo '<label for="all">Alle</label>';
          if($_SESSION['categories'] == NULL)
            echo '<input type="radio" id="all" name="categories" value="NULL" checked>';
          else
            echo '<input type="radio" id="all" name="categories" value="NULL">';
          if ($result->num_rows > 0) {
	        while($row = $result->fetch_assoc()) {
              $canr = 'Kategorie' . $row['KATEGORIENR'];
              echo '<label for="' . $canr . '">' . $row['KATEGORIEBEZEICHNUNG'] . '</label>';
              if($row['KATEGORIENR'] == $_SESSION['categories'])
                echo '<input type="radio" id="' . $canr . '" name="categories" value="' . $row['KATEGORIENR'] . '" checked>';
              else
                echo '<input type="radio" id="' . $canr . '" name="categories" value="' . $row['KATEGORIENR'] . '">';
            }
          }

        ?>
        <input type="submit" value="OK">
        </form>
    </div>

    <div class="content">
        <?php include($page); ?>
    </div>

    <div class="sql_logger_inner" id="sql_logger_inner">
      <?php
      sql_print();
      if($debugging) {
        log_print();
      }
      ?>
    </div>
</body>
<script>
      var logger_container = document.getElementById('sql_logger_inner');
      document.getElementById('sql_logger').appendChild(logger_container);
      function toggleFilter() {
        var x = document.getElementById("filterbox");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
      }
</script>
<?php
    $conn->close();
?>
