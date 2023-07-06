<form>
<?php
# $result = sql_fetch();

# Building query for Ingredients
if (isset($_SESSION['shopping_card_ingredients']) && count($_SESSION['shopping_card_ingredients']) > 0) {
    // Schleife über den Warenkorb
    $query = "SELECT ZUTATENNR, BEZEICHNUNG FROM ZUTAT WHERE";
    $first = True;
    foreach ($_SESSION['shopping_card_ingredients'] as $ingredient => $amount) {
      echo "Produkt: " . $ingredient . ", Menge: " . $amount . "<br>";
      $query .= ($first ? ' ': ' OR ') . "ZUTATENNR=$ingredient";
      $first = False;
    }
}
 ?>

<?php
$result = sql_fetch($query, False);
if($result != False)
  while($row = $result->fetch_assoc()) {
    echo $row['BEZEICHNUNG'] . '&nbsp;' . $_SESSION['shopping_card_ingredients'][(string)$row['shopping_card_ingredients']] . '</br>';
  }
 ?>

 <?php
  if(isset($_SESSION['userid']))
    echo "<input type=\"button\" name=\"Order\" value=\"Bestellen\">";
  else
    echo "<p>Bitte loggen sie sich ein um zu Bestellen.</p>";
 ?>
</form>
