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
            $query = "SELECT KUNDENNR FROM KUNDE WHERE EMAIL=:email AND PASSWORT=:password";
            $params = array(':email' => $_POST['email'],
                            ':password' => $_POST['passwd']);
            $row = $this->db->executeSingleRowQuery($query, $params);
            Logger::log('User ID: ' . $row['KUNDENNR']);

            # Set Session ID
            $query = "UPDATE KUNDE SET SESSIONID=:sessionid WHERE KUNDENNR=:kundennr";
            $params = array(':sessionid' => session_id(),
                            ':kundennr' => $row['KUNDENNR']);
            $this->db->execute($query, $params);
        }
    }
}

?>
