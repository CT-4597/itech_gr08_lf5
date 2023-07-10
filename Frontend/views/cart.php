<table>

<?php foreach($vars['cart_ingeredients'] as $ingredient) { ?>
    <tr>
        <td><?php $ingredient['ZUTATENNR'] ?></td>
        <td><?php $ingredient['BEZEICHNUNG'] ?></td>
    </tr>
<?php } ?>
</table>

<table>

<?php foreach($vars['cart_boxes'] as $box) { ?>
    <tr>
        <td><?php $box['SAMMLUNGSNR'] ?></td>
        <td><?php $box['SAMMLUNGSBEZEICHNUNG'] ?></td>
    </tr>
<?php } ?>
</table>

<?php foreach($vars['cart_boxes'] as $ingredient) { ?>

<?php } ?>
