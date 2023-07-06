<form>
<?php
if (isset($_SESSION['shopping_card_ingredients'])) {
    // Schleife über den Warenkorb
    foreach ($_SESSION['shopping_card_ingredients'] as $ingredient => $amount) {
        echo "Produkt: " . $ingredient . ", Menge: " . $amount . "<br>";
    }
}
 ?>
 <?php
  if(isset($_SESSION['userid']))
    echo "<input type=\"button\" name=\"Order\" value=\"Bestellen\">";
  else
    echo "<p>Bitte loggen sie sich ein um zu Bestellen.</p>";
 ?>
</form>
