<?php
    class authentification {
        protected $db;
        protected bool $logged_in;
        protected bool $is_admin;
        protected int $userid;

        public function __construct(&$db) {
            $this->db = $db;
            session_id();
            $this->logged_in = False;
            $this->is_admin = False;

            Logger::log("Session ID: " . session_id());
            $this->logged_in = $this->checkLogin();
            $this->is_admin = $this->checkAdmin();
            Logger::log("User ID: " . $this->UserID());
            # test if session id is in KUNDEN
        }

        private function checkLogin() {
            $query = "SELECT KUNDENNR FROM KUNDE WHERE SESSIONID=:sessionid";
            $params = array(':sessionid' => session_id());
            $row = $this->db->executeSingleRowQuery($query, $params);
            if($row !== False) {
                $this->userid = $row['KUNDENNR'];
                return True;
            } else {
                return False;
            }
        }

        private function checkAdmin() {
            $query = "SELECT * FROM KUNDE WHERE ADMIN=True AND SESSIONID=:sessionid";
            $params = array(':sessionid' => session_id());
            if($this->db->executeExists($query, $params))
                return True;
            else
                return False;
        }

        public function LoggedIn() {
            return $this->logged_in;
        }

        public function Admin() {
            return $this->is_admin;
        }

        public function UserID() {
            return $this->userid;
        }
    }
    # initialize vars
    # security by default
    if(!isset($AUTH))
        $AUTH = array();

    $AUTH['controller'] = True;         # Does the controller require you to be logged in
    $AUTH['admin'] = True;              # Does the controller require you to be a admin
    $AUTH['redirect'] = '/';            # The Page you get redirected to if you aren't logged in and/or admin

    $AUTH['logged_in'] = False
?>
