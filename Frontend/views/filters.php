<form method="post">
    <h3>Allergene</h3>
    <?php foreach($vars['allergies'] as $allergy) { ?>
        <label class="FilterLabel" for="allergy<?php echo  $allergy['ALLERGENNR']; ?>"><?php echo  $allergy['ALLERGENBEZEICHNUNG']; ?></label>
        <input type="checkbox" id="allergy<?php echo  $allergy['ALLERGENNR']; ?>" name="allergies[]" value="<?php echo  $allergy['ALLERGENNR']; ?>"<?php  echo in_array((string)$allergy['ALLERGENNR'], $_SESSION['allergies']) ? ' checked':''; ?>>
    <?php }?>
    <h3>Kategorien</h3>
    <label class="Filter"  for="categoryall">Alle</label>
    <input type="radio" id="categoryall" name="category" value="NULL"<?php echo ($_SESSION['category'] == NULL) ? ' checked' : '';?>>
    <?php foreach($vars['nutrition_categories'] as $category) { ?>
        <label class="FilterLabel"  for="category<?php echo  $category['KATEGORIENR']; ?>"><?php echo  $category['KATEGORIEBEZEICHNUNG']; ?></label>
        <input type="radio" id="category<?php echo  $category['KATEGORIENR']; ?>" name="category" value="<?php echo  $category['KATEGORIENR']; ?>"<?php echo ($category['KATEGORIENR'] == $_SESSION['category']) ? ' checked' : ''; ?>>
    <?php }?>

<input type="submit" name="FiltersApply" value="Übernehmen">
<input type="submit" name="FiltersClear" value="Zurücksetzen">
</form>
