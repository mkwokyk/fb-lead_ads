<?php

function parse_signed_request($signed_request) {
  list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

  $secret = "<APP_SECRET>"; // Use your app secret here

  // decode the data
  $sig = base64_url_decode($encoded_sig);
  $data = json_decode(base64_url_decode($payload), true);

  // confirm the signature
  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
  if ($sig !== $expected_sig) {
    error_log('Bad Signed JSON signature!');
    return null;
  }

  return $data;
}

function base64_url_decode($input) {
  return base64_decode(strtr($input, '-_', '+/'));
}

// get the values from post body
$values = json_decode(file_get_contents('php://input'), true);

// decode and verify the data with the APP SECRET
$data = parse_signed_request($values["signedrequest"]);

// all your values are in the data variable if no error
print_r ($data);

// display the result
print "<ul>";
foreach ($data as $key => $value) {
  print ("<li>" . $key . ' : ' . $value . "</li>");
}
print "</ul>";

?>
