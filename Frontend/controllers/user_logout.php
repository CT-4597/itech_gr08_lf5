<?php
# Needs to be the same as class [NAME]
new ControllerUserLogout($controllers, $db);
# Be sure to give it a unique name.
class ControllerUserLogout extends BaseController {
    public function RunEarly() {
        global $vars;
        $query = "UPDATE KUNDE SET SESSIONID=null WHERE SESSIONID=:sessionid";
        $params = array(':sessionid' => session_id());
        $this->db->execute($query, $params);
        header("Location: /");
        exit();

    }
    public function RunDefault() {
        global $vars;

        # DB Request without params
        /*$query = "SELECT * FROM ZUTAT";
        $vars['ingredients'] = $this->db->executeQuery($query, array());*/

        # DB Request with params
        /*$query = "SELECT * FROM ZUTAT WHERE EINHEIT=:unit";
        $params = array(':unit' => 'Stück');
        $vars['ingredients'] = $this->db->executeQuery($query, $params);*/

        # DB Request with only a single row expected
        # Take a look at controllers/header_user.php for a better example
        $query = "SELECT * FROM ZUTAT WHERE ZUTATENNR=:id";
        $params = array(':id' => 1001);
        $vars['ingredients'][] = $this->db->executeSingleRowQuery($query, $params);
    }
}


?>
