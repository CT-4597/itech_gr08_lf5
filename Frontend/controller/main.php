<?php

class ControllerMain {
    # Do you need to be loggin for this controller?
    private bool $logged_in = False;
    private string $logged_in_redirect = '/';
    # Do you need to be a admin?
    private bool $admin = False;
    private string $admin_redirect = '/';

    # The viewer name. without suffix.
    private string $viewer = 'main';
    # the container the viewer is rendered in.
    private string $container = 'Content';

    public function __construct(array &$arr, &$db) {
        array_push($arr, $this);
    }

    public function early() {
        Logger::log("{$this->viewer} early.");
    }

    public function late() {
        Logger::log("{$this->viewer} late.");
    }
}

new ControllerMain($controllers, $db);
?>
