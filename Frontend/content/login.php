<?php
  if(isset($_POST['email']) && isset($_POST['passwd'])) {

    # $sql = log_sql("SELECT KUNDENNR FROM KUNDE WHERE EMAIL='" . $_POST['email'] . "' AND PASSWORT='" . $_POST['passwd']) . "'";
    $email = $_POST['email'];
    $passwd = $_POST['passwd'];
    $sql = log_sql("SELECT KUNDENNR FROM KUNDE WHERE EMAIL='$email' AND PASSWORT='$passwd'");
    $result = $conn->query($sql);
    if (!$result) {
      $message  = 'Invalid query: ' .  $result->error . "\n";
      $message .= 'Whole query: ' . $sql;
      die($message);
    }
    if ($result->num_rows > 0) {
    	$row = $result->fetch_assoc();
      $_SESSION['userid'] = $row['KUNDENNR'];
      header("Location: /");
      exit();
    } else {
      $_SESSION['userid'] = NULL;
        debug_log("Failed to login");
    }
  }
 ?>


<?php
 # If we do have the post data, we werent redirected = Failed Login
  if(isset($_POST['customer']) && isset($_POST['passwd'])) {
    echo "Failed login.";
  }
 ?>

<div class="loginform">
    <form action="/login" method="post">
        <div class="logininput">
            <label for="email">E-Mail:</label><br>
            <input type="text" id="email" name="email"><br>
            <label for="passwd">Passwort:</label><br>
            <input type="password" id="passwd" name="passwd">
            <input type="submit" value="Login">
        </div>
    </form>
</div>