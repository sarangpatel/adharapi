<?php
include_once('token.php');
extract($_POST);

//$aadhaar_num = $aadhaar_num;
$curl = curl_init();
$authorization = "Authorization: Bearer ".$token; // Prepare the authorisation token
$ch = curl_init('https://sandbox.aadhaarkyc.io/api/v1/pan/pan'); // Initialise cURL
$post = json_encode(array('id_number' => $pan_num)); // Encode the data array into a JSON string
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Set the posted fields
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
$result = curl_exec($ch); // Execute the cURL statement
curl_close($ch); // Close the cURL connection
echo json_encode($result);
exit;
//$result = json_decode($result, true);
//echo '<PRE>';
//print_r($result);
//echo '</PRE>'
?>