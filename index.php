<?php
print_r($_POST);
$response = array('hi' => 'world');
$encoded = json_encode($response);
header('Content-type: application/json');
exit($encoded);
?>