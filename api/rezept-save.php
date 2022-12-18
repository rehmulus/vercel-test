<?php
require_once './check-password.php';
check_userdata();

include_once './init-db.php';

$rezeptJSON = file_get_contents('php://input');
var_dump($rezeptJSON);
$rezept = json_decode($rezeptJSON, null, 512, JSON_OBJECT_AS_ARRAY);
var_dump($rezept);

var_dump($rezept);

require_once './validate-rezept.php';
if(!validate_rezept($rezept)) {
  http_response_code(400);
  die();
}
else {
  require_once './timestamp.php';
  set_timestamp($rezept);

  $rezepteStore = $rezepteStore->insert($rezept);
  echo json_encode($rezept, JSON_UNESCAPED_UNICODE);
}
?>