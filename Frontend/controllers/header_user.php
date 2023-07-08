<?php

class ControllerHeaderUser {
    # Do you need to be loggin for this controller?
    public bool $logged_in = False;
    public string $logged_in_redirect = '/';
    # Do you need to be a admin?
    public bool $admin = False;
    public string $admin_redirect = '/';

    # The viewer name. without suffix.
    public string $view = 'header_user';
    # the container the viewer is rendered in.
    public string $container = 'HeaderUser';

    public function __construct(array &$arr, &$db) {
        array_push($arr, $this);
    }

    public function RunEarly() {

    }

    public function RunDefault() {

    }

    public function RunLate() {

    }
}

new ControllerHeaderUser($controllers, $db);
?>
