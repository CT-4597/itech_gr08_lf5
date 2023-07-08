<?php

class ControllerMain {
    # Do you need to be loggin for this controller?
    private bool $logged_in = False;
    private string $logged_in_redirect = '/';
    # Do you need to be a admin?
    private bool $admin = False;
    private string $logged_in_redirect = '/';

    # The viewer name. without suffix.
    private string $viewer = 'main';
    # the container the viewer is rendered in.
    private string $container = 'content';

    public function __construct(array &$arr, &$db) {
        array_push($arr, $this);
    }

    public function early() {

    }

    public function late() {

    }
}

new ControllerMain($controllers, $db);
?>
