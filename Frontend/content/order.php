<?php
if(isset($_POST['Order'])) {
  $userid = $_SESSION['userid'];
  $price_total = (float)$_POST['price_total'];
  $query = "INSERT INTO BESTELLUNG (KUNDENNR, BESTELLDATUM, RECHNUNGSBETRAG) VALUES ($userid, now(), $price_total)";
  $last_id = sql_execute($query);
} else {
  header("Location: /");
}
?>

<form action="/" method="post">
  <?php echo $query; ?><br>
  <?php echo $last_id; ?><br>
  Vielen dank für ihre Bestellung.
  <input type="submit" name="back" value="Zurück zur Startseite">
</form>
