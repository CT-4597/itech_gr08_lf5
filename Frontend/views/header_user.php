<?php if($auth->logged_in()) { ?>
    Hallo <?php echo $vars['user_header']['VORNAME']; ?> <?php echo $vars['user_header']['NACHNAME']; ?> <br>
    <a href="/profil">Profile</a> &nbsp;
    <a href="/bestellungen">Bestellungen</a> &nbsp;
    <a href="/logout">Logout</a>
<?php } else { ?>
    <a href="/login">Login</a>
    <a href="/registrieren">Register</a>
<?php } ?>
