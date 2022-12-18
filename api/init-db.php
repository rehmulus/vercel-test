<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once "../SleekDB/src/Store.php";
$databaseDirectory = "../database";
$configuration = [
  "timeout" => false,
];
$rezepteStore = new \SleekDB\Store("rezepte", $databaseDirectory, $configuration);
$einheitenStore = new \SleekDB\Store("einheiten", $databaseDirectory, $configuration);
$userdataStore = new \SleekDB\Store("userdata", $databaseDirectory, $configuration);
?>