<form action="/bestellen" method="post">

<table>

<?php foreach($vars['cart_ingeredients'] as $ingredient) { ?>
    <tr>
        <td><?php echo $ingredient['ZUTATENNR']; ?></td>
        <td><?php echo $ingredient['BEZEICHNUNG']; ?></td>
        <td><input type="number" data-id="<?php echo $ingredient['ZUTATENNR']; ?>" data-amount="<?php echo $ingredient['MENGE']; ?>" value="<?php echo $ingredient['MENGE']; ?>" onblur="cartEdit(event, 'ingredient')" onchange="cartEdit(event, 'ingredient')" onkeydown="cartEditKeyDown(event, 'ingredient')"></td>
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
        <td><input type="number" data-id="<?php echo $box['SAMMLUNGSNR']; ?>" data-amount="<?php echo $box['MENGE']; ?>" value="<?php echo $box['MENGE']; ?>" onblur="cartEdit(event, 'box')" onchange="cartEdit(event, 'box')" onkeydown="cartEditKeyDown(event, 'box')"></td>
        <td><?php echo $box['EINZELPREIS']; ?></td>
        <td><?php echo $box['GESAMTPREIS']; ?></td>
    </tr>
<?php } ?>
</table>

<h3 style="text-align: right;"><?php echo $vars['order_price_total']; ?> €</h3>

<input type="submit" name="Order" value="Bestellen">

</form>

<script>

function cartEditKeyDown(event, type) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Verhindere das Absenden des Formulars
        cartEdit(event, type); // Rufe die Funktion auf, um den Wert zu verarbeiten
    }
}

function cartEdit(event, type) {
    var sender = event.target;
    if(sender.getAttribute('data-amount') !== sender.value){
        console.log('boxid:', sender.getAttribute('data-boxid'));
        console.log('New Amount:', sender.value);
        if(type == 'box') {
            console.log('box')
        } else {
            console.log('ingredient')
        }
    }
}
</script>
