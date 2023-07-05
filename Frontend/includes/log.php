<?php
  $log = array();

  function log($log_str) {
    global $log;
    array_push($log, $log_str);
  }

  function log_print() {
    global $log;
      foreach ($log as $log_str){
        echo $log . '</br>';
      }
  }
 ?>
