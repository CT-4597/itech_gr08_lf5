<?php

class ControllerHeaderUser {
    # Do you need to be loggin for this controller?
    private bool $logged_in = False;
    private string $logged_in_redirect = '/';
    # Do you need to be a admin?
    private bool $admin = False;
    private string $admin_redirect = '/';

    # The viewer name. without suffix.
    private string $viewer = 'header_user';
    # the container the viewer is rendered in.
    private string $container = 'HeaderUser';

    public function __construct(array &$arr, &$db) {
        array_push($arr, $this);
    }

    public function early() {

    }

    public function late() {

    }
}

new ControllerHeaderUser($controllers, $db);
?>
