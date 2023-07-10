<form action="/bestellen" method="post">

<table>

<?php foreach($vars['cart_ingeredients'] as $ingredient) { ?>
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

<table>

<?php foreach($vars['cart_boxes'] as $box) { ?>
    <tr>
        <td><?php echo $box['SAMMLUNGSNR']; ?></td>
        <td><?php echo $box['SAMMLUNGSBEZEICHNUNG']; ?></td>
        <td><?php echo $box['MENGE']; ?></td>
        <td><?php echo $box['EINZELPREIS']; ?></td>
        <td><?php echo $box['GESAMTPREIS']; ?></td>
    </tr>
<?php } ?>
</table>

<?php foreach($vars['cart_boxes'] as $ingredient) { ?>

<?php } ?>

</form>
