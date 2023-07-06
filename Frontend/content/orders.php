<?php
  $user_id = $_SESSION['userid'];
  $query = "SELECT * FROM BESTELLUNG WHERE KUNDENNR=$user_id";

  $result = sql_fetch($query, False);
?>
<table>
<tr>
  <td>Bestellnummer</td>
  <td style="text-align: right;">Bestelldatum</td>
  <td style="text-align: right;">Rechnungsbetrag</td>
</tr>
<?php
  if($result != False)
    while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "  <td>a href=\"/bestellungen/" . $row['BESTELLNR'] . "\">" . $row['BESTELLNR'] . "</a></td>";
      echo "  <td style=\"text-align: right;\">" . $row['BESTELLDATUM'] . "</td>";
      echo "  <td style=\"text-align: right;\">" . $row['RECHNUNGSBETRAG'] . " €</td>";
      echo "</tr>";
    }
?>
</table>
