<table>
    <tr>
        <td>Bestellnummer</td>
        <td style="text-align: right;">Bestelldatum</td>
        <td style="text-align: right;">Rechnungsbetrag</td>
    </tr>
<?php foreach($vars['orders'] as $order) { ?>
    <tr>
        <td><a href="/bestellung/<?php echo $order['BESTELLNR']; ?>"><?php echo $order['BESTELLNR']; ?></a></td>
        <td style="text-align: right;"><?php echo $order['BESTELLDATUM']; ?></td>
        <td style="text-align: right;"><?php echo $order['RECHNUNGSBETRAG']; ?></td>
    </tr>
 <?php } ?>
 </table>
