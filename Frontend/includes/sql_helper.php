<?php

  function sql_fetch($query, $single_row = True) {
    global $conn;


    $result = sql_query($conn, $query);
    # Return the rows if we got at least one, otherwise return False
    if ($result->num_rows > 0) {
      if($single_row) {
        return $result->fetch_assoc();
      } else {
        return $result;
      }
    } else {
      return False;
    }
  }

  function sql_execute($query) {
    global $conn;

    if(sql_query($conn, $query))
      return $conn->insert_id;

    return False;
  }

  function sql_query($conn, $query) {
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

    return $result;
  }

?>
