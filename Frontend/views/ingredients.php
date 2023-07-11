<div class="ingredients_flexbox">
    <?php foreach($vars['ingredients'] as $ingredient) { ?>
    <a href="/zutat/<?php echo $ingredient['ZUTATENNR']; ?>" class="ingredients_flexitem">
        <div><img src="<?php get_image("z", $ingredient['ZUTATENNR']); ?>" alt="Bild der Zutat" class="ingredients_pic"></div>
        <div><?php echo $ingredient['BEZEICHNUNG']; ?></div>
    </a>
    <?php } ?>
</div>
