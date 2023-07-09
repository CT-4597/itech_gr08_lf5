<?php
# Needs to be the same as class [NAME]
new ControllerHeaderUser($controllers, $db, ["HeaderUser" => "header_user"]);
# Be sure to give it a unique name.
class ControllerHeaderUser extends BaseController {
    public function RunDefault() {
        global $vars;
        global $auth;

        if($auth->logged_in()) {
            # DB Request with only a single row expected
            # Take a look at controllers/header_user.php for a better example
            $query = "SELECT VORNAME, NACHNAME FROM KUNDE WHERE SESSIONID=:sessionid";
            $params = array(':sessionid' => session_id());
            $vars['user_header'][] = $this->db->executeSingleRowQuery($query, $params);
        }
    }
}
?>
