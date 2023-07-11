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
            $query = "SELECT KUNDENNR, PASSWORT FROM KUNDE WHERE EMAIL=:email";
            $params = array(':email' => $_POST['email']);

            $row = $this->db->executeSingleRowQuery($query, $params);

            # TODO Check if email even exists
            if($row !== false) {

                if(password_verify($_POST['passwd'], $row['PASSWORT'])){
                    # Set Session ID
                    $query = "UPDATE KUNDE SET SESSIONID=:sessionid WHERE KUNDENNR=:kundennr";
                    $params = array(':sessionid' => session_id(),
                                    ':kundennr' => $row['KUNDENNR']);
                    $this->db->execute($query, $params);
                    header("Location: /zutaten");
                    exit();
                } else {
                    Logger::log('Wrong Password.');
                }
            } else {
                Logger::log('EMail not found.');
            }

        }
    }
}

?>
