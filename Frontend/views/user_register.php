<form action="/registrieren" method="post" class="loginform">
  <h1>Registrierung</h1>
  <label for="email">E-Mail:</label><br>
  <input type="email" id="email" name="email"  maxlength="50" required><br>
  <label for="passwd">Passwort:</label><br>
  <input type="password" id="passwd" name="passwd"  maxlength="50" required><br>
  <label for="passwd2">Passwort wiederholen:</label><br>
  <input type="password" id="passwd2" name="passwd2"  maxlength="50" required onkeyup="checkPasswordMatch()"><br>
  <p id="passwordMatch"></p>
  <hr>
  <label for="vorname">Vorname:</label><br>
  <input type="text" id="vorname" name="vorname"  maxlength="50" required><br>
  <label for="nachname">Nachname:</label><br>
  <input type="text" id="nachname" name="nachname"  maxlength="50" required><br>
  <label for="geburtsdatum">Geburtsdatum:</label><br>
  <input type="date" id="geburtsdatum" name="geburtsdatum" min="1900-01-02" required><br>
  <label for="strasse">Straße:</label><br>
  <input type="text" id="strasse" name="strasse" required><br>
  <label for="hausnummer">Hausnummer:</label><br>
  <input type="text" id="hausnummer" name="hausnummer" required><br>
  <label for="plz">PLZ:</label><br>
  <input type="text" id="plz" name="plz" maxlength="5" required><br>
  <label for="ort">Ort:</label><br>
  <input type="text" id="ort" name="ort"  maxlength="50" required><br>
  <label for="telefon">Telefon (optional):</label><br>
  <input type="tel" id="telefon" name="telefon"><br>

  <input type="submit" id="btnRegister" value="Registrieren" disabled>
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
