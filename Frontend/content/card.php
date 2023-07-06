<form>
<?php
# $result = sql_fetch();
if (isset($_SESSION['shopping_card_ingredients']) && count($_SESSION['shopping_card_ingredients']) > 0) {
    // Schleife über den Warenkorb
    $query = "SELECT BEZEICHNUNG FROM ZUTAT WHERE";
    $first = True;
    foreach ($_SESSION['shopping_card_ingredients'] as $ingredient => $amount) {
      echo "Produkt: " . $ingredient . ", Menge: " . $amount . "<br>";
      $query .= ($first ? '': ' OR ') . "ZUTATENNR=$ingredient";
      $first = False;
    }
    echo $query;
}
 ?>
 <?php
  if(isset($_SESSION['userid']))
    echo "<input type=\"button\" name=\"Order\" value=\"Bestellen\">";
  else
    echo "<p>Bitte loggen sie sich ein um zu Bestellen.</p>";
 ?>
</form>
