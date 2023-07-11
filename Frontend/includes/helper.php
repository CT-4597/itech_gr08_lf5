<?php
	/*
	Function call:
		get_image([ImageType], [ID]);

	Example:
		<img src="<?php get_image("z",1001);?>">
    */
function get_image($type, $id){
	$image_path = "images/" . $type . "_" . $id . ".png";
	if(file_exists($image_path)){
		echo "/" . $image_path;
	} else {
		echo "/images/noimage.svg";
	}
}
# pattern

# A-Z a-z     3 bis 20 zeichen
# $pattern = '/^[A-Za-z]{3,20}$/';

# A-Z a-z 0-9 -     3 bis 20 zeichen
# $pattern = '/^[A-Za-z0-9-]{3,20}$/';

# A-Z a-z 0-9     3 bis 20 zeichen
# $pattern = '/^[A-Za-z0-9_]{3,20}$/';

# Telefon
# 0-9 - + /     0 bis 20 Zeichen. Da optional
# $pattern = '/^[0-9\/+]{0,20}$/';

# Session ID
# '/^[a-zA-Z0-9]+$/'
/*
if (filter_var($username, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $pattern)))) {
    // Der Benutzername ist gültig
} else {
    // Der Benutzername ist ungültig
}
*/

function validateString(&$err, $str, $pattern, $errmsg) {
    if (filter_var($str, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $pattern)))) {
        return True;
    }
    $err = $errmsg;
    return False;
}

function validateEmail(&$err, $str) {
    if(filter_var($str, FILTER_VALIDATE_EMAIL))
        return True;
    $err = "Keine gültige E-Mail Adresse.";
    return False;
}

function validatePassword(&$err, $password, $password2 = Null) {

    // Mindestlänge überprüfen
    if (strlen($password) < 8 || strlen($password) > 20) {
        $err[] = "Das Passwort muss zwischen 8 und 20 Zeichen lang sein.";
    }

    // Groß- und Kleinbuchstaben überprüfen
    if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)) {
        $err[] = "Das Passwort muss sowohl Groß- als auch Kleinbuchstaben enthalten.";
    }

    // Zahlen überprüfen
    if (!preg_match('/[0-9]/', $password)) {
        $err[] = "Das Passwort muss mindestens eine Zahl enthalten.";
    }

    // Sonderzeichen überprüfen
    if (!preg_match('/[!@#$%^&*()_+-]/', $password)) {
        $err[] = "Das Passwort muss mindestens ein Sonderzeichen enthalten.";
    }
    // Test if repeat matches
    if(!is_null($password2) && $password != $password2){
        $err[] = "Die Passwörter stimmen nicht überein.";
    }

    if(empty($err))
        return True;
    else
        return False;
}

function validateDate(&$err, $date, $min = 1900) {
    if (strtotime($date) !== false) {
        $year = date('Y', strtotime($date));
        if ($year >= $min) {
            return true;
        } else {
            $err = "Das Datum darf nicht vor $min liegen.";
        }
    } else {
        $err = "Da ist etwas schief gelaufen...";
    }
    return False;
}
?>

<?php
$errors = [];
if(isset($_POST['validate'])){
    $err = False;
    $err = $err || (!validatePassword($errors['pw'], $_POST['pw1'], $_POST['pw2']));
    $err = $err || (!validateDate($errors['date'], $_POST['date']));
    $err = $err || (!validateEmail($errors['email'], $_POST['email']));
    $err = $err || (!validateString($errors['firstname'], $_POST['firstname'], '/^[A-Za-z]{3,20}$/', 'Ungültiger Name.'));

    if($err) {
        echo "Some Error: " . implode(' - ', array_keys($errors));
    } else {
        echo "looks good";
    }

}
 ?>
