<?php
# Needs to be the same as class [NAME]
new ControllerIngredients($controllers, $db, ["Content" => "ingredients"]);
# Be sure to give it a unique name.
class ControllerIngredients extends BaseController {
    public function RunDefault() {
        global $vars;
        $query = "SELECT DISTINCT ZUTAT.ZUTATENNR, ZUTAT.BEZEICHNUNG FROM ZUTAT
            LEFT JOIN ZUTATALLERGEN ON ZUTATALLERGEN.ZUTATENNR = ZUTAT.ZUTATENNR
            LEFT JOIN ALLERGEN ON ALLERGEN.ALLERGENNR = ZUTATALLERGEN.ALLERGENNR
            LEFT JOIN ZUTATKATEGORIE ON ZUTATKATEGORIE.ZUTATENNR = ZUTAT.ZUTATENNR
            LEFT JOIN ERNAEHRUNGSKATEGORIE ON ERNAEHRUNGSKATEGORIE.KATEGORIENR = ZUTATKATEGORIE.KATEGORIENR
            WHERE ((ZUTATALLERGEN.ALLERGENNR != 0)" . ")"; # Pulsar highlighting is shit with it.... so i need to add a ) and remove it in the next line
        $query = substr($query, 0, -1); # Still the workaround for the hightlighting

        $params = array();
        $placeholders = array();

        foreach ($_SESSION['allergies'] as $id) {
            $placeholders[] = 'ZUTATALLERGEN.ALLERGENNR != :allergen_' . $id;
            $params[':allergen_' . $id] = $id;
        }
        if(count($_SESSION['allergies']) > 0)
            $query .= ' AND (' . implode(' AND ', $placeholders) . ')';

        $query .= ' OR ZUTATALLERGEN.ALLERGENNR IS NULL)';

        if ($_SESSION['category'] != NULL && $_SESSION['category'] != "0") {
            $query .= ' AND ERNAEHRUNGSKATEGORIE.KATEGORIENR = :category';
            $params[':category'] = $_SESSION['category'];
        }

        $vars['ingredients'] = $this->db->executeQuery($query, $params);
    }
}
?>
