<?php
include './check-password.php';
check_userdata();

include './init-db.php';

$rezeptJSON = file_get_contents('php://input');
$rezept = json_decode($rezeptJSON, null, 512, JSON_OBJECT_AS_ARRAY);

require_once './validate-rezept.php';
if(validate_rezept($rezept)) {
  
  require_once './timestamp.php';
  set_timestamp($rezept);

  if(isset($rezept["_id"])){
    $id = $rezept["_id"];
    unset($rezept["_id"]);
    $rezept = $rezepteStore->updateById($id, $rezept);
  }
  else {
    $rezept = $rezepteStore->insert($rezept);
  }
  echo json_encode($rezept, JSON_UNESCAPED_UNICODE);
}
else {
  if(isset($rezept["_id"])){
    $rezept = $rezepteStore->findById($rezept["_id"]);
    echo json_encode($rezept, JSON_UNESCAPED_UNICODE);
  }
  else{
    http_response_code(400);
  }
}
?>