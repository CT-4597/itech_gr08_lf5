<?php
  $sql_log = array();
  include('includes/sql_highlights.php');

  function log_sql($sql_str) {
    global $sql_log;
    # array_push($sql_log, str_replace("'", "\'", $sql_str));
    array_push($sql_log, $sql_str);
    return $sql_str;
  }

  function sql_print() {
    global $sql_log;
      foreach ($sql_log as $sql_str){
        echo highlightKeywords($sql_str) . '</br>';
      }
  }
 ?>
