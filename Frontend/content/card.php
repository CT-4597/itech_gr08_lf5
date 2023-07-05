<?php
if (isset($_SESSION['shopping_card_ingredients'])) {
    // Schleife über den Warenkorb
    foreach ($_SESSION['shopping_card_ingredients'] as $ingredient => $amount) {
        echo "Produkt: " . $ingredient . ", Menge: " . $amount . "<br>";
    }
}
 ?>
