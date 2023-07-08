<form method="post">
    <h3>Allergene</h3>
    <?php foreach($vars['allergies'] as $allergy) { ?>
        <label for="<?php echo  $allergy['ALLERGENNR']; ?>"><?php echo  $allergy['ALLERGENBEZEICHNUNG']; ?></label>
        <input type="checkbox" id="<?php echo  $allergy['ALLERGENNR']; ?>" name="allergies[]" value="<?php echo  $allergy['ALLERGENNR']; ?>"<?php  (in_array((string)$allergy['ALLERGENNR'], $_SESSION['allergies']) ? ' checked>':''; ?>>
    <?php }?>
    <h3>Kategorien</h3>
    <?php foreach($vars['nutrition_categories'] as $category) { ?>
        <label for="<?php echo  $category['KATEGORIENR']; ?>"><?php echo  $category['KATEGORIEBEZEICHNUNG']; ?></label>
        <input type="radio" id="<?php echo  $allergy['KATEGORIENR']; ?>" name="category" value="<?php echo  $category['KATEGORIENR']; ?>"<?php ($allergy['KATEGORIENR'] == $_SESSION['category']) ? '' : ' checked'; ?>>
    <?php }?>

<input type="submit" name="FiltersApply" value="Übernehmen">
<input type="submit" name="FiltersClear" value="Zurücksetzen">
</form>
