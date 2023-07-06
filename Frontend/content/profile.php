<?php
  $err_pwcheck = False;
  $err_pwmatch = False;


  if(isset($_POST['action'])) {

    # Save changed profile Action Block
    if($_POST['action'] == 'save') {

    }

    # Change Passwort Action block
    if($_POST['action'] == 'changepw') {
      $err_pwcheck = True;
      # prpare vars for sql
      $userid = $_SESSION['userid'];
      $passwd = $_POST['passwd'];
      $passwd_new = $_POST['passwd_new'];
      $passwd_new2 = $_POST['passwd_new2'];
      $result = sql_fetch("SELECT * FROM KUNDE WHERE KUNDENNR=$userid AND PASSWORT='$passwd'");

      # if result is not False, the old password was correct.
      if($result != False){
        $err_pwcheck = False;
        $err_pwmatch = True;
        # Do the new Passwords Match??
        if($passwd_new == $passwd_new2){
          $err_pwmatch = False;
        }
      }
    }
  }

  $userid = $_SESSION['userid'];
  $result = sql_fetch("SELECT * FROM KUNDE WHERE KUNDENNR=$userid");

?>

<?php
  if($err_pwcheck) {
    echo "Ihr Passwort war nicht richtig.";
  }

  if($err_pwmatch) {
    echo "Die neuen Passwörter stimmen nicht überein.";
  }
 ?>

<form action="/profil" method="post">
  <input type="hidden" name="action" value="save">
  <h3> Profil </h3>
  <label for="email">E-Mail</label><br>
  <input type="text" id="email" name="email" value="<?php echo $result['EMAIL']; ?>" maxlength="50" required><br>
  <label for="vorname">Vorname</label><br>
  <input type="text" id="vorname" name="vorname" value="<?php echo $result['VORNAME']; ?>" maxlength="50" required><br>
  <label for="nachname">Nachname</label><br>
  <input type="text" id="nachname" name="nachname" value="<?php echo $result['NACHNAME']; ?>" maxlength="50" required><br>
  <label for="geburtsdatum">Geburtsdatum</label><br>
  <input type="date" id="geburtsdatum" name="geburtsdatum" value="<?php echo $result['GEBURTSDATUM']; ?>" min="1900-01-02" required><br>
  <label for="strasse">Straße</label><br>
  <input type="text" id="strasse" name="strasse" value="<?php echo $result['STRASSE']; ?>" maxlength="50" required><br>
  <label for="hausnummer">Hausnummer</label><br>
  <input type="text" id="hausnummer" name="hausnummer" value="<?php echo $result['HAUSNR']; ?>" required><br>
  <label for="plz">PLZ</label><br>
  <input type="text" id="plz" name="plz" value="<?php echo $result['PLZ']; ?>" maxlength="5" required><br>
  <label for="ort">Ort</label><br>
  <input type="text" id="ort" name="ort" value="<?php echo $result['ORT']; ?>" maxlength="50" required><br>
  <label for="telefon">Telefon</label><br>
  <input type="text" id="telefon" name="telefon" value="<?php echo $result['TELEFON']; ?>" maxlength="25" ><br>

  <input type="submit" value="Änderungen Speichern">
</form>
</br>
<form action="/profil" method="post">
  <input type="hidden" name="action" value="changepw">

  <h3> Passwort Ändern </h3>

  <label for="passwd">Altes Passwort</label><br>
  <input type="password" id="passwd" name="passwd"  maxlength="5" required><br>
  <label for="passwd_new">Neues Passwort</label><br>
  <input type="password" id="passwd_new" name="passwd_new"  maxlength="5" required><br>
  <label for="passwd_new2">Passwort Wiederholen</label><br>
  <input type="password" id="passwd_new2" name="passwd_new2"  maxlength="5" required><br>

  <input type="submit" value="Passwort Ändern">
</form>
