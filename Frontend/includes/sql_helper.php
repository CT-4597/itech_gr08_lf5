<?php

  function sql_fetch($query) {

    # Log the query
    $query = log_sql($query);

    # use conn to get a result
    $result = $conn->query($query);

    # if there was a error, result is False
    if (!$result) {
      $message  = 'Invalid query: ' .  $result->error . "</br>";
      $message .= 'Whole query: ' . highlightKeywords($sql);
      debug_log($message);
      return False;
    }

    # Return the rows if we got at least one, otherwise return False
    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    } else {
      return False;
    }
  }


?>
