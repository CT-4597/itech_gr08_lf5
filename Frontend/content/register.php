<?php
  $err_register = False;

  # if email is set, register
  if(isset($_POST['email'])) {

    # Test if e-mail is already registered
    $email = $_POST['email'];
    $sql = log_sql("SELECT KUNDENNR FROM KUNDE WHERE EMAIL='$email'");

    $result = $conn->query($sql);

    if (!$result) {
      $message  = 'Invalid query: ' .  $result->error . "\n";
      $message .= 'Whole query: ' . $sql;
      die($message);
    }

    # If True: Already registered
    if ($result->num_rows > 0) {
    	$err_register = True;
    } else {
      # Create account
        $EMAIL = $_POST['email'];
        $PASSWORT = $_POST['passwd'];
        $VORNAME = $_POST['vorname'];
        $NACHNAME = $_POST['nachname'];
        $GEBURTSDATUM = $_POST['geburtsdatum'];
        $STRASSE = $_POST['strasse'];
        $HAUSNR = $_POST['hausnummer'];
        $PLZ = $_POST['plz'];
        $ORT = $_POST['ort'];
        $TELEFON = $_POST['telefon'];
        $sql = log_sql("INSERT INTO KUNDE (EMAIL, PASSWORT, VORNAME, NACHNAME, GEBURTSDATUM, STRASSE, HAUSNR, PLZ, ORT, TELEFON) VALUES ('$EMAIL', '$PASSWORT', '$VORNAME', '$NACHNAME', STR_TO_DATE('$GEBURTSDATUM', '%Y-%m-%d'), '$STRASSE', '$HAUSNR', '$PLZ', '$ORT', '$TELEFON')");
        $result = $conn->query($sql);
        if (!$result) {
          $message  = 'Invalid query: ' .  $result->error . "\n";
          $message .= 'Whole query: ' . $sql;
          die($message);
        } else {
          # Erfolgreich. Weiter zur login seite
          header("Location: /login");
          exit();
        }
    }
  }
 ?>


<?php
 # If we do have the post data, we werent redirected = Failed Login
  if(isset($_POST['email']) && $err_register) {
    echo "E-Mail Addresse ist bereits registriert.";
  }
 ?>

<form action="/registrieren" method="post" class="loginform">
  <h1>Registrierung</h1>
  <label for="email">email:</label><br>
  <input type="text" id="email" name="email"  maxlength="50" required><br>
  <label for="passwd">Passwort:</label><br>
  <input type="password" id="passwd" name="passwd"  maxlength="50" required><br>
-----------------
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
  <label for="telefon">Telefon:</label><br>
  <input type="text" id="telefon" name="telefon"><br>

  <input type="submit" value="Registrieren">
</form>
