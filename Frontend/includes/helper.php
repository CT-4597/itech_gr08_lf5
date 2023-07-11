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

# A-Z a-z 0-9 _     3 bis 20 zeichen
# $pattern = '/^[A-Za-z0-9_]{3,20}$/';

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
function validateEmail($str) {
    return filter_var($str, FILTER_VALIDATE_EMAIL);
}

function validatePassword(&$err, $key, $password, $password2 = Null) {

    // Mindestlänge überprüfen
    if (strlen($password) < 8 || strlen($password) > 20) {
        $err[$key][] = "Das Passwort muss zwischen 8 und 20 Zeichen lang sein.";
    }

    // Groß- und Kleinbuchstaben überprüfen
    if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)) {
        $err[$key][] = "Das Passwort muss sowohl Groß- als auch Kleinbuchstaben enthalten.";
    }

    // Zahlen überprüfen
    if (!preg_match('/[0-9]/', $password)) {
        $err[$key][] = "Das Passwort muss mindestens eine Zahl enthalten.";
    }

    // Sonderzeichen überprüfen
    if (!preg_match('/[!@#$%^&*()_+-]/', $password)) {
        $err[$key][] = "Das Passwort muss mindestens ein Sonderzeichen enthalten.";
    }
    // Test if repeat matches
    if(!is_null($password2) && $password != $password2){
        $err[$key][] = "Die Passwörter stimmen nicht überein.";
    }

    if(empty($err[$key]))
        return True;
    else
        return False;
}

function validateDate(&$err, $date, $min = 1900) {
    if (strtotime($date) !== false) {
        // Das Datum ist im gültigen Format (z.B. '2000-01-01')

        // Überprüfen des Jahres
        $year = date('Y', strtotime($date));
        if ($year >= $min) {
            // Das Datum ist gültig und liegt nicht vor 1900
        } else {
            // Das Datum liegt vor 1900
        }
    } else {
        // Das Datum ist nicht im gültigen Format
    }
}
?>

<?php
$errors = [];
if(isset($_POST['validate'])){

    validatePassword($errors, 'pw', $_POST['pw1'], $_POST['pw2']);

    if(empty($errors)) {
        echo "looks good";
    }

}
 ?>
<form method="POST">
Password: <input type="text" name="pw1" value="<?php if(isset($_POST['pw1'])) echo $_POST['pw1']; ?>"><br>
<?php if(isset($errors['pw'])) echo implode('<br>', $errors['pw']) . "<br>"; ?>
Repeat: <input type="text" name="pw2" value="<?php if(isset($_POST['pw1'])) echo $_POST['pw2']; ?>">
Date: <input type="date" name="date" value="<?php if(isset($_POST['date'])) echo $_POST['date']; ?>"><br>

<br>
<input type="submit" name="validate" value="check">
</form>
