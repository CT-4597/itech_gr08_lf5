<?php
  # $user_id = $_SESSION['userid'];
  $order_id = $_GET['id']
  $query = "SELECT * FROM BESTELLUNG WHERE BESTELLNR=$order_id";

  $result = sql_fetch($query, False);
  if($result != False)
    while($row = $result->fetch_assoc()) {
 ?>
 <table>
   <tr>
     <th>Bestellnummer<th>
     <th>Bestelldatum<th>
     <th>Betrag<th>
   </tr>
   <tr>
     <td><?php echo $row['BESTELLNR']; ?></td>
     <td><?php echo $row['BESTELLDATUM']; ?></td>
     <td><?php echo $row['RECHNUNGSBETRAG']; ?></td>
   </tr>
 </table>
 <?php
  }
?>
