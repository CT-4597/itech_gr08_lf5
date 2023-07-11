<form action="/profil" method="post">
  <h3> Profil </h3>
  <label for="email">E-Mail</label><br>
  <input type="text" id="email" name="email" value="<?php echo $vars['user_profile']['EMAIL']; ?>" maxlength="50" required><br>
  <label for="vorname">Vorname</label><br>
  <input type="text" id="vorname" name="vorname" value="<?php echo $vars['user_profile']['VORNAME']; ?>" maxlength="50" required><br>
  <label for="nachname">Nachname</label><br>
  <input type="text" id="nachname" name="nachname" value="<?php echo $vars['user_profile']['NACHNAME']; ?>" maxlength="50" required><br>
  <label for="geburtsdatum">Geburtsdatum</label><br>
  <input type="date" id="geburtsdatum" name="geburtsdatum" value="<?php echo $vars['user_profile']['GEBURTSDATUM']; ?>" min="1900-01-02" required><br>
  <label for="strasse">Straße</label><br>
  <input type="text" id="strasse" name="strasse" value="<?php echo $vars['user_profile']['STRASSE']; ?>" maxlength="50" required><br>
  <label for="hausnummer">Hausnummer</label><br>
  <input type="text" id="hausnummer" name="hausnummer" value="<?php echo $vars['user_profile']['HAUSNR']; ?>" required><br>
  <label for="plz">PLZ</label><br>
  <input type="text" id="plz" name="plz" value="<?php echo $vars['user_profile']['PLZ']; ?>" maxlength="5" required><br>
  <label for="ort">Ort</label><br>
  <input type="text" id="ort" name="ort" value="<?php echo $vars['user_profile']['ORT']; ?>" maxlength="50" required><br>
  <label for="telefon">Telefon</label><br>
  <input type="text" id="telefon" name="telefon" value="<?php echo $vars['user_profile']['TELEFON']; ?>" maxlength="25" ><br>

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
<form action="/dsgvodump" id="dsgvo_form_download" method="post">
  <h3>Daten Beantragen</h3>
  <p>Hier können sie alle ihre Personenbezogen Daten direkt beantragen.</p>
  <input type="button" onclick="window.open('/dsgvodump', '_blank');" name="dsgvo_form_download" value="Download Dump">
</form>
<form action="/profil" id="dsgvo_form_delete" method="post">
  <input type="hidden" name="dsgvo_form_delete" value="1">
  <h3>Daten Löschen</h3>
  <p>Hier können sie ihr Konto und alle dazugehörigen Personenbezogenen Daten löschen.</p>
  <input type="button" onclick="dsgvo_delete_confirmation()" name="dsgvo_Delete" value="Konto löschen">
</form>
