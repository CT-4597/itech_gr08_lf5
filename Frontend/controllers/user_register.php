<?php
# Needs to be the same as class [NAME]
new ControllerUserRegister($controllers, $db, ["Content" => "user_register"]);
# Be sure to give it a unique name.
class ControllerUserRegister extends BaseController {
    public function RunDefault() {
        global $vars;

        # TODO Add Checks for fields
        if(isset($_POST['RegisterUser'])) {
            $query = "INSERT INTO KUNDE
                        (EMAIL, PASSWORT, VORNAME, NACHNAME, GEBURTSDATUM, STRASSE, HAUSNR, PLZ, ORT, TELEFON)
                        VALUES
                        (:email, :passwort, :vorname, :nachname, STR_TO_DATE(':geburtsdatum', '%Y-%m-%d'), :strasse, :hausnr, :plz, :ort, :telefon)";
            $params = [':email' => $_POST['email'],
                        ':passwort' => $_POST['passwd'],
                        ':vorname' => $_POST['vorname'],
                        ':nachname' => $_POST['nachname'],
                        ':geburtsdatum' => $_POST['geburtsdatum'],
                        ':strasse' => $_POST['strasse'],
                        ':hausnr' => $_POST['hausnummer'],
                        ':plz' => $_POST['plz'],
                        ':ort' => $_POST['ort'],
                        ':telefon' => $_POST['telefon']];
            $this->db->execute($query, $params);
        }
    }
}


?>
