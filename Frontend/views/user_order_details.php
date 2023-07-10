<form>
    <table>
      <tr>
        <th>Bestellnummer</th>
        <th>Bestelldatum</th>
        <th>Betrag</th>
      </tr>
      <tr>
        <td><?php echo $vars['orderdetails']['BESTELLNR']; ?></td>
        <td><?php echo $vars['orderdetails']['BESTELLDATUM']; ?></td>
        <td><?php echo $vars['orderdetails']['RECHNUNGSBETRAG']; ?></td>
      </tr>
    </table>
    <table>

    <?php foreach($vars['order_ingredients'] as $ingredient) { ?>
        <tr>
            <td><?php echo $ingredient['ZUTATENNR']; ?></td>
            <td><?php echo $ingredient['BEZEICHNUNG']; ?></td>
            <td><?php echo $ingredient['MENGE']; ?></td>
            <td><?php echo $ingredient['EINHEIT']; ?></td>
            <td><?php echo $ingredient['NETTOPREIS']; ?></td>
            <td><?php echo $ingredient['GESAMTPREIS']; ?></td>
        </tr>
    <?php } ?>
    </table>
    <br>
    <table>

    <?php foreach($vars['order_boxes'] as $box) { ?>
        <tr>
            <td><?php echo $box['SAMMLUNGSNR']; ?></td>
            <td><?php echo $box['SAMMLUNGSBEZEICHNUNG']; ?></td>
            <td><?php echo $box['MENGE']; ?></td>
            <td><?php echo $box['EINZELPREIS']; ?></td>
            <td><?php echo $box['GESAMTPREIS']; ?></td>
        </tr>
    <?php } ?>
    </table>

</form>
