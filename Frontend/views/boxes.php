<table>
    <tr>
        <td>ID</td>
        <td>Name</td>
    </tr>
<?php foreach($vars['boxes'] as $box) { ?>
    <tr>
        <td><?php echo $box['SAMMLUNGSNR']; ?></td>
        <td><a href="/box/<?php echo $box['SAMMLUNGSNR']; ?>"><?php echo $box['SAMMLUNGSBEZEICHNUNG']; ?></a></td>
    </tr>
 <?php } ?>
 </table>
