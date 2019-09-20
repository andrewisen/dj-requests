<?php
function debugToConsole($data) {
    /**
    * Write debug to client's browser
    *
    * @see https://stackoverflow.com/a/20147885
    * @param string|array $data
    * @return string
    */
   
    $output = $data;
    if (is_array($output))
      $output = implode(',', $output);

    echo "<script>console.log('" . $output . "' );</script>";
	}
?>