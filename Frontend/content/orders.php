<?php
  $user_id = $_SESSION['userid'];
  $query = "SELECT * FROM BESTELLUNG WHERE KUNDENNR=$user_id";

  $result = sql_fetch($query, False);
?>
<table>
<?php
  if($result != False)
    while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "  <td>" . $row['BESTELLNR'] . "</td>";
      echo "  <td>" . $row['BESTELLDATUM'] . "</td>";
      echo "  <td style=\"text-align: right;\">" . $row['RECHNUNGSBETRAG'] . " €</td>";
      echo "</tr>";
    }
?>
</table>
