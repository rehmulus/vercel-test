<?php
include_once './init-db.php';

if(!isset($_GET["id"])){
  http_response_code(400);
  die();
}

$id = $_GET["id"];

if($id){
  $rezept = $rezepteStore->findById($id);
  echo json_encode($rezept, JSON_UNESCAPED_UNICODE);
}
?>