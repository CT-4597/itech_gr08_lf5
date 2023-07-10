<table>

<?php foreach($vars['cart_ingeredients'] as $ingredient) { ?>
    <tr>
        <td><?php echo $ingredient['ZUTATENNR']; ?></td>
        <td><?php echo $ingredient['BEZEICHNUNG']; ?></td>
    </tr>
<?php } ?>
</table>

<table>

<?php foreach($vars['cart_boxes'] as $box) { ?>
    <tr>
        <td><?php echo $box['SAMMLUNGSNR']; ?></td>
        <td><?php echo $box['SAMMLUNGSBEZEICHNUNG']; ?></td>
    </tr>
<?php } ?>
</table>

<?php foreach($vars['cart_boxes'] as $ingredient) { ?>

<?php } ?>
