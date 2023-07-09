<?php if($auth->LoggedIn()) { ?>
    Hallo <?php echo $vars['user_header']['VORNAME']; ?> <?php echo $vars['user_header']['NACHNAME']; ?> <br>
     <br>
    <a href="/profil">Profile</a> <br>
    <a href="/bestellungen">Bestellungen</a> <br>;
    <?php if($auth->Admin()) { ?>
        <a href="/admin/">Administration</a>  <br>
    <?php } ?>
    <a href="/logout">Logout</a>
<?php } else { ?>
    <a href="/login">Login</a> <br>
    <a href="/registrieren">Register</a>
<?php } ?>
