<?php
  class Logger {
    private static $log = array();

    public static function log($msg) {
      array_push(self::$log, $msg);
    }

    public static function getLog() {
      return self::$log;
    }

    public static function printLog() {
        foreach(self::$log as $line) {
            echo "$line <br>";
        }
    }
  }
?>
