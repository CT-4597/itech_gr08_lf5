<div class="ingredients_flexbox">
    <?php foreach($vars['boxes'] as $box) { ?>
        <a href="/box/<?php echo $box["SAMMLUNGSNR"]; ?>" class="ingredients_flexitem">
            <div><img src="<?php get_image("s", $box['SAMMLUNGSNR']); ?>" alt="Bild der Box" class="ingredients_pic"></div>
            <div><?php echo $box['SAMMLUNGSBEZEICHNUNG']; ?></div>
        </a>
    <?php } ?>
</div>
