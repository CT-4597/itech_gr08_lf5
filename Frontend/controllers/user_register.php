<?php
# Needs to be the same as class [NAME]
new ControllerUserRegister($controllers, $db, ["Content" => "user_register"]);
# Be sure to give it a unique name.
class ControllerUserRegister extends BaseController {
    public function RunDefault() {
        global $vars;

        # TODO Add Checks for fields
        # TODO Check if EMAILS already exists
        if(isset($_POST['RegisterUser'])) {
            $query = "INSERT INTO KUNDE
                        (EMAIL, PASSWORT, VORNAME, NACHNAME, GEBURTSDATUM, STRASSE, HAUSNR, PLZ, ORT, TELEFON)
                        VALUES
                        (:email, :passwort, :vorname, :nachname, :geburtsdatum, :strasse, :hausnr, :plz, :ort, :telefon)";
            $params = [':email' => $_POST['email'],
                        ':passwort' => $_POST['passwd'],
                        ':vorname' => $_POST['vorname'],
                        ':nachname' => $_POST['nachname'],
                        ':geburtsdatum' => date('Y-m-d', strtotime($_POST['geburtsdatum'])),
                        ':strasse' => $_POST['strasse'],
                        ':hausnr' => $_POST['hausnummer'],
                        ':plz' => $_POST['plz'],
                        ':ort' => $_POST['ort'],
                        ':telefon' => $_POST['telefon']];
            $this->db->execute($query, $params);

            header("Location: /login");
            exit();
        }
    }
}


?>
