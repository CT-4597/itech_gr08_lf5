<form>
    <table>
        <tr>
            <td>Bestellnummer</td>
            <td style="text-align: right;">Bestelldatum</td>
            <td style="text-align: right;">Rechnungsbetrag</td>
            <td style="text-align: right;">Status</td>
        </tr>
    <?php foreach($vars['orders'] as $order) { ?>
        <tr onclick="window.location.href = '/bestellung/<?php echo $order['BESTELLNR']; ?>'">
            <td><?php echo $order['BESTELLNR']; ?></td>
            <td style="text-align: right;"><?php echo $order['BESTELLDATUM']; ?></td>
            <td style="text-align: right;"><?php echo $order['RECHNUNGSBETRAG']; ?></td>
            <td style="text-align: right;"><?php echo $order['STATUS']; ?></td>
        </tr>
     <?php } ?>
     </table>
</form>
