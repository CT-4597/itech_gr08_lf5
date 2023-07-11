<?php if($auth->LoggedIn()) { ?>
    Hallo <?php echo $vars['user_header']['VORNAME']; ?> <?php echo $vars['user_header']['NACHNAME']; ?> <br>
     <br>
    <a href="/profil">Profile</a> &nbsp;
    <a href="/bestellungen">Bestellungen</a> &nbsp;
    <?php if($auth->Admin()) { ?>
        <a href="/admin/">Administration</a>  &nbsp;
    <?php } ?>
    <a href="/logout">Logout</a>  &nbsp;
<?php } else { ?>
    <a href="/login">Login</a>  &nbsp;
    <a href="/registrieren">Register</a>
<?php } ?>
