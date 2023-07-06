<?php
if(isset($_POST['Order'])) {

} else {
  header("Location: /");
}
?>

<form action="/" method="post">
  Vielen dank für ihre Bestellung.
  <input type="submit" name="back" value="Zurück zur Startseite">
</form>
