<?php
  $err = NULL;

  # DSGVO DELETE
  if(isset($_POST['dsgvo_form_delete'])) {
    $query_dsgvo_delete = "UPDATE KUNDE SET EMAIL='', PASSWORT='', VORNAME='', NACHNAME='', GEBURTSDATUM=now(), STRASSE='', HAUSNR='', PLZ='', ORT='', TELEFON='' WHERE KUNDENNR=$userid";
    sql_execute($query);
    header("Location: /logout");
  }

  # Save changed profile Action Block
  if(isset($_POST['SaveProfile'])) {
    $EMAIL = $_POST['email'];
    $VORNAME = $_POST['vorname'];
    $NACHNAME = $_POST['nachname'];
    $GEBURTSDATUM = $_POST['geburtsdatum'];
    $STRASSE = $_POST['strasse'];
    $HAUSNR = $_POST['hausnummer'];
    $PLZ = $_POST['plz'];
    $ORT = $_POST['ort'];
    $TELEFON = $_POST['telefon'];
    sql_execute("UPDATE KUNDE SET
      EMAIL='$EMAIL',
      VORNAME='$VORNAME',
      NACHNAME='$NACHNAME',
      GEBURTSDATUM=STR_TO_DATE('$GEBURTSDATUM', '%Y-%m-%d'),
      STRASSE='$STRASSE',
      HAUSNR='$HAUSNR',
      PLZ='$PLZ',
      ORT='$ORT',
      TELEFON='$TELEFON'
      WHERE KUNDENNR=$userid");
  }

  # Change Passwort Action block
  if(isset($_POST['ChangePassword'])) {
    # prpare vars for sql
    $userid = $_SESSION['userid'];
    $passwd = $_POST['passwd'];
    $passwd_new = $_POST['passwd_new'];
    $passwd_new2 = $_POST['passwd_new2'];
    $result = sql_fetch("SELECT * FROM KUNDE WHERE KUNDENNR=$userid AND PASSWORT='$passwd'");

    # if result is not False, the old password was correct.
    if($result != False){
      # Do the new Passwords Match??
      if($passwd_new == $passwd_new2){
        sql_execute("UPDATE KUNDE SET PASSWORT='$passwd_new' WHERE KUNDENNR=$userid");
      } else {
        $err = 'pwmatch';
      }
    } else {
      $err = 'pwcheck';
    }
  }

  $userid = $_SESSION['userid'];
  $result = sql_fetch("SELECT * FROM KUNDE WHERE KUNDENNR=$userid");

?>

<?php if($err != NULL){ ?>
  <form>
  <?php
    if($err == 'pwcheck') echo "<p class=\"error\">Falsches Passwort.</p>";
    if($err == 'pwmatch') echo "<p class=\"error\">Die neuen Passwörter stimmen nicht überein.";
   ?>
 </form>
<?php } ?>

<form action="/profil" method="post">
  <?php echo $query_dsgvo_delete; ?>
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

  <input type="submit" name="SaveProfile" value="Änderungen Speichern">
</form>
</br>
<form action="/profil" method="post">

  <h3> Passwort Ändern </h3>

  <label for="passwd">Altes Passwort</label><br>
  <input type="password" id="passwd" name="passwd"  maxlength="50" required><br>
  <label for="passwd_new">Neues Passwort</label><br>
  <input type="password" id="passwd_new" name="passwd_new"  maxlength="50" required><br>
  <label for="passwd_new2">Passwort Wiederholen</label><br>
  <input type="password" id="passwd_new2" name="passwd_new2"  maxlength="50" required><br>

  <input type="submit" name="ChangePassword" value="Passwort Ändern">
</form>
<br/>
<form action="/profil" id="dsgvo_form_download" method="post">
  <h3>Daten Beantragen</h3>
  <p>Hier können sie alle ihre Personenbezogen Daten direkt beantragen.</p>
  <input type="submit" name="dsgvo_getdata" value="Download Dump">
</form>
<form action="/profil" id="dsgvo_form_delete" method="post">
  <input type="hidden" name="dsgvo_form_delete" value="1">
  <h3>Daten Löschen</h3>
  <p>Hier können sie ihr Konto und alle dazugehörigen Personenbezogenen Daten löschen.</p>
  <input type="button" onclick="dsgvo_delete_confirmation()" name="dsgvo_Delete" value="Konto löschen">
</form>

<script>
  function dsgvo_delete_confirmation() {
    var response = confirm("Möchten sie wirklich ihr Benutzerkonto löschen? Dieser Vorgang kann nicht rückgängig gemacht werden!");
    if (response == true) {
      document.getElementById('dsgvo_form_delete').submit();
    }
  }
</script>
