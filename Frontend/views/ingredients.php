<table>
    <tr>
        <td>ID</td>
        <td>Name</td>
    </tr>
<?php foreach($vars['ingredients'] as $ingredient) { ?>
    <tr>
        <td><?php echo $ingredient['ZUTATENNR']; ?></td>
        <td><a href="zutat/<?php echo $ingredient['ZUTATENNR']; ?>"><?php echo $ingredient['BEZEICHNUNG']; ?></a></td>
    </tr>
 <?php } ?>
 </table>
