<?php
  if(isset($_POST['customer']) && isset($_POST['passwd'])) {
    debug_log("Login as " . $_POST['customer']);
    header("Location: /");
    exit();
  }
 ?>
<form action="/login" method="post">
 <label for="customer">Kundennummer:</label><br>
 <input type="text" id="customer" name="customer"><br>
 <label for="passwd">Passwort:</label><br>
 <input type="password" id="passwd" name="passwd">
 <input type="submit" value="Login">
</form>
