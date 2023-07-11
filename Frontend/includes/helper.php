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
    $err = $err xor validatePassword($errors['pw'], $_POST['pw1'], $_POST['pw2']);
    $err = $err xor validateDate($errors['date'], $_POST['date']);
    $err = $err xor validateEmail($errors['email'], $_POST['email']);
    $err = $err xor validateString($errors['firstname'], $_POST['firstname'], '/^[A-Za-z]{3,20}$/', 'Ungültiger Name.');

    if(!$err) {
        echo "looks good";
    } else {
        echo implode(' - ', array_keys($errors));
    }

}
 ?>
<form method="POST">
Vorname: <input type="text" name="firstname" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname']; ?>"><br>
<?php if(isset($errors['firstname'])) echo $errors['firstname'] . "<br>"; ?>
E-Mail: <input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"><br>
<?php if(isset($errors['email'])) echo $errors['email'] . "<br>"; ?>
<hr>>
Password: <input type="text" name="pw1" value="<?php if(isset($_POST['pw1'])) echo $_POST['pw1']; ?>"><br>
<?php if(isset($errors['pw'])) echo implode('<br>', $errors['pw']) . "<br>"; ?>
Repeat: <input type="text" name="pw2" value="<?php if(isset($_POST['pw1'])) echo $_POST['pw2']; ?>"><br>
<hr>
Date: <input type="date" name="date" value="<?php if(isset($_POST['date'])) echo $_POST['date']; ?>"><br>
<?php if(isset($errors['date'])) echo $errors['date'] . "<br>"; ?>

<br>
<input type="submit" name="validate" value="check">
</form>
