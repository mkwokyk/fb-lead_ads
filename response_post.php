<?php

// get the values from post body
$values = json_decode(file_get_contents('php://input'), true);

// all your values are in the values variable
print_r ($values);

// display the result
print "<ul>";
foreach ($values as $key => $value) {
  print ("<li>" . $key . ' : ' . $value . "</li>");
}
print "</ul>";

?>
