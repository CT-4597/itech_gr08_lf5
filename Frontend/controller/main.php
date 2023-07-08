<?php

class ControllerMain {
    # Do you need to be loggin for this controller?
    public bool $logged_in = False;
    public string $logged_in_redirect = '/';
    # Do you need to be a admin?
    public bool $admin = False;
    public string $admin_redirect = '/';

    # The viewer name. without suffix.
    public string $viewer = 'main';
    # the container the viewer is rendered in.
    public string $container = 'Content';

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
