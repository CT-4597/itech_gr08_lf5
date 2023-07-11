<form action="/registrieren" method="post" class="loginform">
  <h1>Registrierung</h1>
  <label for="email">E-Mail:</label><br>
  <input type="email" id="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" maxlength="50" required><br>
  <?php if(isset($errors['email'])) echo $errors['email'] . "<br>"; ?>
  <label for="passwd">Passwort:</label><br>
  <input type="password" id="passwd" name="passwd" value="<?php if(isset($_POST['passwd'])) echo $_POST['passwd']; ?>" maxlength="50" required onkeyup="checkPasswordMatch()"><br>
  <?php if(isset($errors['passwd'])) echo implode('<br>', $errors['passwd']) . "<br>"; ?>
  <label for="passwd2">Passwort wiederholen:</label><br>
  <input type="password" id="passwd2" name="passwd2" value="<?php if(isset($_POST['passwd2'])) echo $_POST['passwd2']; ?>" maxlength="50" required onkeyup="checkPasswordMatch()"><br>
  <p id="passwordMatch"></p>
  <hr>
  <label for="vorname">Vorname:</label><br>
  <input type="text" id="vorname" name="vorname" value="<?php if(isset($_POST['vorname'])) echo $_POST['vorname']; ?>" maxlength="50" required><br>
  <?php if(isset($errors['vorname'])) echo $errors['vorname'] . "<br>"; ?>
  <label for="nachname">Nachname:</label><br>
  <input type="text" id="nachname" name="nachname" value="<?php if(isset($_POST['nachname'])) echo $_POST['nachname']; ?>" maxlength="50" required><br>
  <?php if(isset($errors['nachname'])) echo $errors['nachname'] . "<br>"; ?>
  <label for="geburtsdatum">Geburtsdatum:</label><br>
  <input type="date" id="geburtsdatum" name="geburtsdatum" value="<?php if(isset($_POST['geburtsdatum'])) echo $_POST['geburtsdatum']; ?>" min="1900-01-02" required><br>
  <?php if(isset($errors['geburtsdatum'])) echo $errors['geburtsdatum'] . "<br>"; ?>
  <label for="strasse">Straße:</label><br>
  <input type="text" id="strasse" name="strasse" value="<?php if(isset($_POST['strasse'])) echo $_POST['strasse']; ?>" required><br>
  <?php if(isset($errors['strasse'])) echo $errors['strasse'] . "<br>"; ?>
  <label for="hausnummer">Hausnummer:</label><br>
  <input type="text" id="hausnummer" name="hausnummer" value="<?php if(isset($_POST['hausnummer'])) echo $_POST['hausnummer']; ?>" required><br>
  <?php if(isset($errors['hausnummer'])) echo $errors['hausnummer'] . "<br>"; ?>
  <label for="plz">PLZ:</label><br>
  <input type="text" id="plz" name="plz" maxlength="5" value="<?php if(isset($_POST['plz'])) echo $_POST['plz']; ?>" required><br>
  <?php if(isset($errors['plz'])) echo $errors['plz'] . "<br>"; ?>
  <label for="ort">Ort:</label><br>
  <input type="text" id="ort" name="ort" value="<?php if(isset($_POST['ort'])) echo $_POST['ort']; ?>" maxlength="50" required><br>
  <?php if(isset($errors['ort'])) echo $errors['ort'] . "<br>"; ?>
  <label for="telefon">Telefon (optional):</label><br>
  <input type="tel" id="telefon" name="telefon" value="<?php if(isset($_POST['telefon'])) echo $_POST['telefon']; ?>"><br>
  <?php if(isset($errors['telefon'])) echo $errors['telefon'] . "<br>"; ?>

  <input type="submit" id="btnRegister" name="RegisterUser" value="Registrieren">
</form>

<script>
function checkPasswordMatch() {
    if (document.getElementById("passwd").value === document.getElementById("passwd2").value) {
        document.getElementById("btnRegister").disabled = false;
        document.getElementById("passwordMatch").innerHTML = "";
    } else {
        document.getElementById("btnRegister").disabled = true;
        document.getElementById("passwordMatch").innerHTML = "Die Passwörter stimmen nicht überein.";
    }
}
</script>
