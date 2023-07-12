<form action="/bestellen" method="post">

<table>

<?php foreach($vars['cart_ingeredients'] as $ingredient) { ?>
    <tr>
        <td><?php echo $ingredient['ZUTATENNR']; ?></td>
        <td><?php echo $ingredient['BEZEICHNUNG']; ?></td>
        <td><input type="number" value="<?php echo $ingredient['MENGE']; ?>"></td>
        <td><?php echo $ingredient['EINHEIT']; ?></td>
        <td><?php echo $ingredient['NETTOPREIS']; ?></td>
        <td><?php echo $ingredient['GESAMTPREIS']; ?></td>
    </tr>
<?php } ?>
</table>
<br>
<table>

<?php foreach($vars['cart_boxes'] as $box) { ?>
    <tr>
        <td><?php echo $box['SAMMLUNGSNR']; ?></td>
        <td><?php echo $box['SAMMLUNGSBEZEICHNUNG']; ?></td>
        <td><input type="number" value="<?php echo $box['MENGE']; ?>"></td>
        <td><?php echo $box['EINZELPREIS']; ?></td>
        <td><?php echo $box['GESAMTPREIS']; ?></td>
    </tr>
<?php } ?>
</table>

<h3 style="text-align: right;"><?php echo $vars['order_price_total']; ?> €</h3>

<input type="submit" name="Order" value="Bestellen">

</form>
