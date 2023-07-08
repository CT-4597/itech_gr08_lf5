<table>
    <tr>
        <td>ID</td>
        <td>Name</td>
    </tr>
<?php foreach($vars['ingredients'] as $ingredient) { ?>
    <tr>
        <td><?php echo $ingredient['ZUTATENNR']; ?></td>
        <td><?php echo $ingredient['BEZEICHNUNG']; ?></td>
    </tr>
 <?php } ?>
 </table>
