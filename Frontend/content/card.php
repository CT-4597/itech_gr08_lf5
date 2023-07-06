<form>
<?php
# $result = sql_fetch();

# Building query for Ingredients
if (isset($_SESSION['shopping_card_ingredients']) && count($_SESSION['shopping_card_ingredients']) > 0) {
    // Schleife über den Warenkorb
    $query_ingredients = "SELECT ZUTATENNR, BEZEICHNUNG, EINHEIT, NETTOPREIS FROM ZUTAT WHERE";
    $first = True;
    foreach ($_SESSION['shopping_card_ingredients'] as $ingredient => $amount) {
      $query_ingredients .= ($first ? ' ': ' OR ') . "ZUTATENNR=$ingredient";
      $first = False;
    }
}

# Building query for Boxes
if (isset($_SESSION['shopping_card_boxes']) && count($_SESSION['shopping_card_boxes']) > 0) {
    // Schleife über den Warenkorb
    $query_boxes = "SELECT SAMMLUNG.SAMMLUNGSBEZEICHNUNG, sum(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE) AS 'Gesamtpreis',
                      sum(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE)-round(sum(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE)*(SAMMLUNG.RABATT/100),2) AS 'RabattPreis'
                      FROM SAMMLUNG
                      LEFT JOIN SAMMLUNGZUTAT ON SAMMLUNGZUTAT.SAMMLUNGSNR = SAMMLUNG.SAMMLUNGSNR
                      LEFT JOIN ZUTAT ON ZUTAT.ZUTATENNR = SAMMLUNGZUTAT.ZUTATENNR
                      WHERE";
    $first = True;
    foreach ($_SESSION['shopping_card_boxes'] as $box => $amount) {
      $query_boxes .= ($first ? ' ': ' OR ') . " SAMMLUNG.SAMMLUNGSNR =$box";
      $first = False;
    }
}
?>
<table>
<?php
  $price_ingredients = 0;
  # getting ingredients
  if (isset($_SESSION['shopping_card_ingredients']) && count($_SESSION['shopping_card_ingredients']) > 0) {
    $result = sql_fetch($query_ingredients, False);
    if($result != False)
      while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "  <td>" . $row['BEZEICHNUNG'] . "</td>";
      echo "  <td>" . $row['NETTOPREIS'] . "</td>";
      echo "  <td>" . $row['EINHEIT'] . "</td>";
      echo "  <td>" . $_SESSION['shopping_card_ingredients'][$row['ZUTATENNR']] . "</td>";
      echo "  <td>" . $_SESSION['shopping_card_ingredients'][$row['ZUTATENNR']] *  $row['NETTOPREIS'] . "</td>";
      echo "<tr>";
      $price_ingredients += $_SESSION['shopping_card_ingredients'][$row['ZUTATENNR']] *  $row['NETTOPREIS'];
      # echo $row['BEZEICHNUNG'] . '&nbsp;' . $_SESSION['shopping_card_ingredients'][$row['ZUTATENNR']] . '</br>';
    }
  }
?>
<tr>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td><?php echo $price_ingredients; ?></td>
</tr>
</table>
<?php
  # getting boxes
  var_dump($_SESSION['shopping_card_boxes']);
  if(isset($_SESSION['shopping_card_boxes']) && count($_SESSION['shopping_card_boxes']) > 0){
    $result = sql_fetch($query_boxes, False);
    if($result != False)
      while($row = $result->fetch_assoc()) {
      echo $row['SAMMLUNGSBEZEICHNUNG'] . '&nbsp;' . $_SESSION['shopping_card_boxes'][$row['SAMMLUNGSNR']] . '</br>';
    }
  }
?>
<?php
  if(isset($_SESSION['userid']))
    echo "<input type=\"submit\" name=\"Order\" value=\"Bestellen\">";
  else
    echo "<p>Bitte loggen sie sich ein um zu Bestellen.</p>";
?>
</form>
