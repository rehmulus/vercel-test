<?php
include_once './init-db.php';

if(isset($_GET["timestamp"])) {
  $timestamp = $_GET["timestamp"];
  $einheiten = $einheitenStore
    ->createQueryBuilder()
    ->where( [ "timestamp", ">=", $timestamp ] )
    ->getQuery()
    ->fetch();
}
else{
  $einheiten = $einheitenStore->findAll();
}

require_once './timestamp.php';

$einheitenObject = [
  "timestamp" => get_current_time(),
  "einheiten" => $einheiten,
];

echo json_encode($einheitenObject, JSON_UNESCAPED_UNICODE);
?>