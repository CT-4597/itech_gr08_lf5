<?php
  $log_arr = array();

  function debug_log($log_str) {
    global $log_arr;
    array_push($log_arr, str_replace("'", "\'", $log_str));
  }

  function log_print() {
    global $log_arr;
      foreach ($log_arr as $log_str){
        echo $log_str . '</br>';
      }
  }
 ?>
