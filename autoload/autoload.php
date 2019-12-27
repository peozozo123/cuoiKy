<?php
session_start();
require_once __DIR__ . "/../lib/database.php";
require_once __DIR__ . "/../lib/funtion.php";
$db = new Database;

define("ROOT", $_SERVER['DOCUMENT_ROOT'] . "/cuoiky/public/uploads/");

$category = $db->fetchAll("category");
$product = $db->fetchAll("product");
$sql1 = "Select * from product where 1 order by id desc limit 15";
$productNew = $db->fetchsql($sql1);
