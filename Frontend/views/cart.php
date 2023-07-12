<form action="/bestellen" method="post">

<table>

<?php foreach($vars['cart_ingeredients'] as $ingredient) { ?>
    <tr>
        <td><?php echo $ingredient['ZUTATENNR']; ?></td>
        <td><?php echo $ingredient['BEZEICHNUNG']; ?></td>
        <td><input type="number" data-amount="<?php echo $ingredient['MENGE']; ?>" value="<?php echo $ingredient['MENGE']; ?>" onblur="cartEdit(event)" onchange="cartEdit(event)" onkeydown="cartEditKeyDown(event)"></td>
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

<script>

function cartEditKeyDown(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Verhindere das Absenden des Formulars
        cartEdit(event); // Rufe die Funktion auf, um den Wert zu verarbeiten
    }
}

function cartEdit(event) {
    var sender = event.target;
    console.log('Sender:', sender);
    if(sender.getAttribute('data-amount') !== sender.value){
        console.log('Old Amount:', sender.getAttribute('data-amount'));
        console.log('New Amount:', sender.value);
    }
}
</script>
