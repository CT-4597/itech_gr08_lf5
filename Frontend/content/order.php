<?php
if(isset($_POST['Order'])) {
  $userid = $_SESSION['userid'];
  $price_total = (float)$_POST['price_total'];
  $query_order = "INSERT INTO BESTELLUNG (KUNDENNR, BESTELLDATUM, RECHNUNGSBETRAG) VALUES ($userid, now(), $price_total)";
  $order_id = sql_execute($query_order);

  # Order ingredients
  foreach ($_SESSION['shopping_card_ingredients'] as $ingredient => $amount) {
    $query_order_ingredient = "INSERT INTO BESTELLUNGZUTAT (BESTELLNR, ZUTATENNR, MENGE) VALUES ($order_id, $ingredient, $amount)";
    sql_execute($query_order_ingredient);
  }
  # Order boxes
  foreach ($_SESSION['shopping_card_boxes'] as $box => $amount) {
    $query_order_box = "INSERT INTO BESTELLUNGSAMMLUNG (BESTELLNR, SAMMLUNGSNR, MENGE) VALUES ($order_id, $box, $amount)";
    sql_execute($query_order_box);
  }
  $_SESSION['shopping_card_ingredients'] = array();
  $_SESSION['shopping_card_boxes'] = array();
} else {
  header("Location: /");
}
?>

<form action="/" method="post">
  <?php echo $query_order; ?><br>
  <?php echo $last_id; ?><br>
  Vielen dank für ihre Bestellung.
  <input type="submit" name="back" value="Zurück zur Startseite">
</form>
