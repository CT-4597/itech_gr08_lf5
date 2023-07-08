<form method="post">
    <h3>Allergene</h3>
    <?php foreach($vars['allergies'] as $allergy) { ?>
        <label for="<?php echo  $allergy['ALLERGENNR']; ?>"><?php echo  $allergy['ALLERGENBEZEICHNUNG']; ?></label>
        <input type="checkbox" id="<?php echo  $allergy['ALLERGENNR']; ?>" name="allergies[]" value="<?php echo  $allergy['ALLERGENNR']; ?>">
    <?php }?>
    <h3>Kategorien</h3>
    <?php foreach($vars['nutrition_categories'] as $category) { ?>
        <label for="<?php echo  $category['KATEGORIENR']; ?>"><?php echo  $category['KATEGORIEBEZEICHNUNG']; ?></label>
        <input type="checkbox" id="<?php echo  $allergy['KATEGORIENR']; ?>" name="allergies[]" value="<?php echo  $category['KATEGORIENR']; ?>">
    <?php }?>

<input type="submit" name="ApplyFilter" value="Übernehmen">
</form>