<?php
  $err_register = False;

  # if email is set, register
  if(isset($_POST['email'])) {

    # Test if e-mail is already registered
    $email = $_POST['email'];
    $sql = log_sql("SELECT count(*) FROM KUNDE WHERE EMAIL='$email'");

    $result = $conn->query($sql);

    # If True: Already registered
    if ($result->num_rows > 0) {
    	$err_register = True;
    } else {
      # Create account
    }
  }
 ?>


<?php
 # If we do have the post data, we werent redirected = Failed Login
  if(isset($_POST['email']) && $err_register) {
    echo "E-Mail Addresse ist bereits registriert.";
  }
 ?>

<form action="/registrieren" method="post">
  <label for="email">email:</label><br>
  <input type="text" id="email" name="email"><br>
  <label for="passwd">Passwort:</label><br>
  <input type="password" id="passwd" name="passwd"><br>
-----------------
  <label for="vorname">Vorname:</label><br>
  <input type="text" id="vorname" name="vorname"><br>
  <label for="nachname">Nachname:</label><br>
  <input type="text" id="nachname" name="nachname"><br>
  <label for="geburtsdatum">Geburtsdatum:</label><br>
  <input type="text" id="geburtsdatum" name="geburtsdatum"><br>
  <label for="strasse">Straße:</label><br>
  <input type="text" id="strasse" name="strasse"><br>
  <label for="hausnummer">Hausnummer:</label><br>
  <input type="text" id="hausnummer" name="hausnummer"><br>
  <label for="plz">PLZ:</label><br>
  <input type="text" id="plz" name="plz"><br>
  <label for="ort">Ort:</label><br>
  <input type="text" id="ort" name="ort"><br>
  <label for="telefon">Telefon:</label><br>
  <input type="text" id="telefon" name="telefon"><br>

  <input type="submit" value="Registrieren">
</form>
