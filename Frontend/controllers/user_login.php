<?php
# Needs to be the same as class [NAME]
new ControllerUserLogin($controllers, $db, ["Content" => "user_login"]);
# Be sure to give it a unique name.
class ControllerUserLogin extends BaseController {
    public function RunDefault() {
        global $vars;

        # TODO Add Checks for fields
        # TODO Check if EMAILS already exists

        # DB Request with only a single row expected
        # Take a look at controllers/header_user.php for a better example
        if(isset($_POST['LoginUser'])) {
            $query = "SELECT id FROM KUNDE WHERE EMAIL=:email AND PASSWORT=:password";
            $params = array(':email' => $_GET['email'],
                            ':password' => $_GET['passwd']);
            $vars['userlogin'] = $this->db->executeSingleRowQuery($query, $params);
            Logger::log('User ID: ' . $vars['userlogin']['KUNDENNR']);
        }
    }
}

?>
