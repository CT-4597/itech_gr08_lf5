<?php
  if(isset($_POST['customer']) && isset($_Post['passwd'])) {
    debug_log("Login as " . $_POST['customer']);
  }
 ?>
<form method="post">
 <label for="customer">Kundennummer:</label><br>
 <input type="text" id="customer" name="customer"><br>
 <label for="passwd">Passwort:</label><br>
 <input type="text" id="passwd" name="passwd">
 <input type="submit" value="Login">
</form>
