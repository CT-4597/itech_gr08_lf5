<?php
# Needs to be the same as class [NAME]
new ControllerUserProfile($controllers, $db, ["Content" => "user_profile"]);
# Be sure to give it a unique name.
class ControllerUserProfile extends BaseController {
    public function RunEarly() {
        # Save Profile
        if(isset($_POST['SaveProfile'])){
            # TODO Check for wrong data
            $query = "UPDATE KUNDE SET  EMAIL=:email,
                                        VORNAME=:vorname,
                                        NACHNAME=:nachname,
                                        GEBURTSDATUM=:geburtsdatum,
                                        STRASSE=:strasse,
                                        HAUSNR=:hausnr,
                                        PLZ=:plz,
                                        ORT=:ort,
                                        TELEFON=:telefon
                                        WHERE SESSIONID=:sessionid";
            $params = [':email' => $_POST['email'],
                        ':vorname' => $_POST['vorname'],
                        ':nachname' => $_POST['nachname'],
                        ':geburtsdatum' => date('Y-m-d', strtotime($_POST['geburtsdatum'])),
                        ':strasse' => $_POST['strasse'],
                        ':hausnr' => $_POST['hausnummer'],
                        ':plz' => $_POST['plz'],
                        ':ort' => $_POST['ort'],
                        ':telefon' => $_POST['telefon'],
                        ':sessionid' => session_id()];
            $this->db->execute($query, $params);
        }

        # Change Passwort
        if(isset($_POST['ChangePassword'])){
            # TODO Check password
            # TODO Check password Repeat
            $query = "UPDATE KUNDE SET PASSWORT=:password WHERE SESSIONID=:sessionid";
            $params =[':password' => password_hash($_POST['passwd_new'], PASSWORD_DEFAULT),
                        ':sessionid' => session_id()];
            $this->db->execute($query, $params);
        }
        if(isset($_POST['dsgvo_form_delete'])){
            $query = "UPDATE KUNDE SET  EMAIL=:email,
                                        VORNAME=:vorname,
                                        NACHNAME=:nachname,
                                        GEBURTSDATUM=:geburtsdatum,
                                        STRASSE=:strasse,
                                        HAUSNR=:hausnr,
                                        PLZ=:plz,
                                        ORT=:ort,
                                        TELEFON=:telefon
                                        WHERE SESSIONID=:sessionid";
            $params = [':email' => '',
                        ':vorname' => '',
                        ':nachname' => '',
                        ':geburtsdatum' => '',
                        ':strasse' => '',
                        ':hausnr' => '',
                        ':plz' => '',
                        ':ort' => '',
                        ':telefon' => '',
                        ':sessionid' => session_id()];
            $this->db->execute($query, $params);
            header("Location: /logout");
            exit();
        }
    }

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
