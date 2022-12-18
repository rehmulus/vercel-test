<?php
include_once './init-db.php';

if(isset($_GET["timestamp"])) {
  $timestamp = $_GET["timestamp"];
  $rezepte = $rezepteStore
    ->createQueryBuilder()
    ->where( [ "timestamp", ">=", $timestamp ] )
    ->getQuery()
    ->fetch();
}
else{
  $rezepte = $rezepteStore->findAll();
}

require_once './timestamp.php';

$rezepteObject = [
  "timestamp" => get_current_time(),
  "rezepte" => $rezepte,
];

echo json_encode($rezepteObject, JSON_UNESCAPED_UNICODE);
?>