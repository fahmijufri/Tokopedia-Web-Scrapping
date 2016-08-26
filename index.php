<?php 

require('lib/tokopedia.php');

$tokopedia = new Tokopedia();


$result = $tokopedia->showProduct('VaporTA');
$r = json_decode($result, TRUE);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
echo json_encode($r, JSON_PRETTY_PRINT);

 ?>