<?php
# Needs to be the same as class [NAME]
new ControllerIngredientsDetails($controllers, $db, 'ingredients_details', 'Content');
# Be sure to give it a unique name.
class ControllerIngredientsDetails extends BaseController {
    public function RunDefault() {
        global $vars;

        # DB Request with only a single row expected
        # Take a look at controllers/header_user.php for a better example
        $query = "SELECT * FROM ZUTAT WHERE ZUTATENNR=:id";
        $params = array(':id' => $_GET['id']);
        $vars['ingredient'] = $this->db->executeSingleRowQuery($query, $params);
    }
}
?>
