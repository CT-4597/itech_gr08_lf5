<?php
# Needs to be the same as class [NAME]
new ControllerBoxesDetails($controllers, $db);
# Be sure to give it a unique name.
class ControllerBoxesDetails extends BaseController {
    public function RunDefault() {
        global $vars;

        # DB Request with only a single row expected
        # Take a look at controllers/header_user.php for a better example
        $query = "SELECT * FROM SAMMLUNG WHERE SAMMLUNGSNR=:id";
        $params = array(':id' => $_GET['id']);
        $vars['box'] = $this->db->executeSingleRowQuery($query, $params);
    }
}
?>
