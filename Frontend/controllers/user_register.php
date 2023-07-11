<?php
# Needs to be the same as class [NAME]
new ControllerUserRegister($controllers, $db, ["Content" => "user_register"]);
# Be sure to give it a unique name.
class ControllerUserRegister extends BaseController {
    public function RunDefault() {
        global $vars;

        $errors = [];
        # TODO Add Checks for fields
        # TODO Check if EMAILS already exists
        if(isset($_POST['RegisterUser'])) {
            $err = False;
            $err = $err || (!validateEmail($errors['email'], $_POST['email']));
            $err = $err || (!validatePassword($errors['passwd'], $_POST['passwd'], $_POST['passwd2']));
            $err = $err || (!validateString($errors['vorname'], $_POST['vorname'], '/^[A-Za-z]{3,20}$/', 'Ungültiger Vorname.'));
            $err = $err || (!validateString($errors['nachname'], $_POST['nachname'], '/^[A-Za-z]{3,20}$/', 'Ungültiger Nachname.'));
            $err = $err || (!validateDate($errors['geburtsdatum'], $_POST['geburtsdatum']));
            $err = $err || (!validateString($errors['strasse'], $_POST['strasse'], '/^[A-Za-z]{3,20}$/', 'Ungültige Strasse.'));
            $err = $err || (!validateString($errors['hausnummer'], $_POST['hausnummer'], '/^[A-Za-z]{3,20}$/', 'Ungültige Hausnummer.'));
            $err = $err || (!validateString($errors['plz'], $_POST['plz'], '/^[0-9]{3,5}$/', 'Ungültige PLZ.'));
            $err = $err || (!validateString($errors['ort'], $_POST['ort'], '/^[A-Za-z0-9-]{3,20}$/', 'Ungültiger Ort.'));
            $err = $err || (!validateString($errors['telefon'], $_POST['telefon'], '/^[0-9\/+]{0,20}$/', 'Ungültige Telefonnummer.'));

            if($err) {
                Logger::log("Some Error: " . implode(' - ', array_keys($errors)));
            } else {
                Logger::log("Form looks good.");
            }
        }

        if(False) {
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
}


?>
