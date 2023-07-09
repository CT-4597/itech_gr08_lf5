<?php
# Needs to be the same as class [NAME]
new ControllerUserProfile($controllers, $db, ["Content" => "user_profile"]);
# Be sure to give it a unique name.
class ControllerUserProfile extends BaseController {
    public function RunDefault() {
        global $vars;
        # DB Request with only a single row expected
        # Take a look at controllers/header_user.php for a better example
        $query = "SELECT * FROM KUNDE WHERE SESSIONID=:sessionid";
        $params = array(':sessionid' => session_id());
        $vars['user_profile'] = $this->db->executeSingleRowQuery($query, $params);
    }
}


?>
