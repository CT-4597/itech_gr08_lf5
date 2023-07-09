<form method="post">
    <h3>Allergene</h3>
    <?php foreach($vars['allergies'] as $allergy) { ?>
    <input type="checkbox" id="allergy<?php echo  $allergy['ALLERGENNR']; ?>" name="allergies[]" value="<?php echo  $allergy['ALLERGENNR']; ?>"<?php  echo in_array((string)$allergy['ALLERGENNR'], $_SESSION['allergies']) ? ' checked':''; ?>>
    <label class="FilterLabel" for="allergy<?php echo  $allergy['ALLERGENNR']; ?>">&nbsp;<?php echo  $allergy['ALLERGENBEZEICHNUNG']; ?>&nbsp;</label>
    <?php }?>
    <h3>Kategorien</h3>
    <input type="radio" id="categoryall" name="category" value="NULL"<?php echo ($_SESSION['category'] == NULL) ? ' checked' : '';?>>
    <label class="FilterLabel"  for="categoryall">&nbsp;Alle&nbsp;</label>
    <?php foreach($vars['nutrition_categories'] as $category) { ?>
        <input type="radio" id="category<?php echo  $category['KATEGORIENR']; ?>" name="category" value="<?php echo  $category['KATEGORIENR']; ?>"<?php echo ($category['KATEGORIENR'] == $_SESSION['category']) ? ' checked' : ''; ?>>
        <label class="FilterLabel"  for="category<?php echo  $category['KATEGORIENR']; ?>">&nbsp;<?php echo  $category['KATEGORIEBEZEICHNUNG']; ?>&nbsp;</label>
    <?php }?>

<input type="submit" name="FiltersApply" value="Übernehmen">
<input type="submit" name="FiltersClear" value="Zurücksetzen">
</form>
