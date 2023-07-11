<?php
# Needs to be the same as class [NAME]
new ControllerUserRegister($controllers, $db, ["Content" => "user_register"]);
# Be sure to give it a unique name.
class ControllerUserRegister extends BaseController {
    public function RunDefault() {
        global $vars;

        $vars['errors'] = [];

        if(isset($_POST['RegisterUser'])) {
            # validate user input
            $err = False;
            $err = $err || (!validateEmail($vars['errors']['email'], $_POST['email']));
            $err = $err || (!validatePassword($vars['errors']['passwd'], $_POST['passwd'], $_POST['passwd2']));
            $err = $err || (!validateString($vars['errors']['vorname'], $_POST['vorname'], '/^[A-Za-z]{3,20}$/', 'Ungültiger Vorname.'));
            $err = $err || (!validateString($vars['errors']['nachname'], $_POST['nachname'], '/^[A-Za-z]{3,20}$/', 'Ungültiger Nachname.'));
            $err = $err || (!validateDate($vars['errors']['geburtsdatum'], $_POST['geburtsdatum']));
            $err = $err || (!validateString($vars['errors']['strasse'], $_POST['strasse'], '/^[0-1a-zA-Z\- ]{3,50}$/', 'Ungültige Strasse.'));
            $err = $err || (!validateString($vars['errors']['hausnummer'], $_POST['hausnummer'], '/^[A-Za-z0-9 ]{1,20}$/', 'Ungültige Hausnummer.'));
            $err = $err || (!validateString($vars['errors']['plz'], $_POST['plz'], '/^[0-9]{3,5}$/', 'Ungültige PLZ.'));
            $err = $err || (!validateString($vars['errors']['ort'], $_POST['ort'], '/^[A-Za-z0-9-]{3,20}$/', 'Ungültiger Ort.'));
            if(strlen($_POST['telefon']) > 0)
                $err = $err || (!validateString($vars['errors']['telefon'], $_POST['telefon'], '/^[-\/+0-9]{0,30}$/', 'Ungültige Telefonnummer.'));

            # Check if EMAILS already exists
            $query = "SELECT * FROM KUNDE WHERE EMAIL=:email";
            $params = [":email" => $_POST['email']];
            if($db->executeExists($query, $params)) {
                $err = True;
                $vars['errors']['emailexist'] = "Diese E-Mail Adresse ist bereits registriert.";
            }

            # insert
            if(!$err) {
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
