<?php
  $userid = $_SESSION['userid'];
  $result = sql_fetch("SELECT * FROM KUNDE WHERE KUNDENNR=$userid");

?>


<form action="/profile" method="post">
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
<form action="/profile" method="post">
  <input type="hidden" name="action" value="changepw">

  <h3> Passwort Ändern </h3>

  <label for="passwd">Ales Passwort</label><br>
  <input type="password" id="passwd" name="passwd"  maxlength="5" required><br>
  <label for="passwd">Neues Passwort</label><br>
  <input type="password" id="passwd" name="passwd"  maxlength="5" required><br>
  <label for="passwd">Passwort Wiederholen</label><br>
  <input type="password" id="passwd" name="passwd"  maxlength="5" required><br>
</form>