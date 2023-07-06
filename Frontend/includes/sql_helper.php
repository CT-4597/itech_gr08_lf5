<?php

  function sql_fetch($query) {
      $query = log_sql($query);

      $result = $conn->query($query);

      if (!$result) {
        $message  = 'Invalid query: ' .  $result->error . "</br>";
        $message .= 'Whole query: ' . highlightKeywords($sql);
        debug_log($message);
      }
      if ($result->num_rows > 0) {
        return $result->fetch_assoc();
      } else {
        return False;
      }
    }
  }


?>
