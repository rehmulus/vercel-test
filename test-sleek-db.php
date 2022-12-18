<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once "SleekDB/src/Store.php";
$databaseDirectory = __DIR__ . "/database";
$rezepteStore = new \SleekDB\Store("rezepte", $databaseDirectory);
$rezept = [
 "name" => "Ajvar Datteldip",
 "kategorien" => "Dip",
 "bild" => "dattel-dip.jpg"
];
$rezepteStore = $rezepteStore->insert($rezept);
?>
<h1>test</h1>