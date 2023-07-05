<?php
  if(isset($_POST['email']) && isset($_POST['passwd'])) {

    $sql = log_sql("SELECT count(*) FROM KUNDE WHERE EMAIL='" . $_POST['email'] . "' AND PASSWORT='" . $_POST['passwd']) . "'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    	$row = $result->fetch_assoc();
      $_SESSION['userid'] = $_POST['customer'];
      header("Location: /");
      exit();
    } else {
      $_SESSION['userid'] = NULL;
        debug_log("Failed to login" . $_POST['customer']);
    }
  }
 ?>


<?php
 # If we do have the post data, we werent redirected = Failed Login
  if(isset($_POST['customer']) && isset($_POST['passwd'])) {
    echo "Failed login.";
  }
 ?>
<form action="/login" method="post">
 <label for="email">E-Mail:</label><br>
 <input type="text" id="email" name="email"><br>
 <label for="passwd">Passwort:</label><br>
 <input type="password" id="passwd" name="passwd">
 <input type="submit" value="Login">
</form>
