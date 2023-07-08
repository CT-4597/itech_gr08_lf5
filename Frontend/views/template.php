<table>
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Lieferant</td>
        <td>Einheit</td>
        <td>Preis</td>
    </tr>
<?php foreach($controller_vars['ingredients'] as $ingredient) { ?>
    <tr>
        <td><?php echo $ingredient['ZUTATENNR']; ?></td>
        <td><?php echo $ingredient['BEZEICHNUNG']; ?></td>
        <td><?php echo $ingredient['EINHEIT']; ?></td>
        <td><?php echo $ingredient['LIEFERANT']; ?></td>
        <td><?php echo $ingredient['NETTOPREIS']; ?></td>
        
    </tr>
 <?php } ?>
 </table>
