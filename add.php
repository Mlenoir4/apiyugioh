<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed", true, 405);
    exit;
}

$inputJSON = file_get_contents('php://input');
$card = json_decode($inputJSON, TRUE);

if(!isset($card["name"]) or !isset($card["level"]) or !isset($card["type"]) or !isset($card["imgLink"]) or !isset($card["atk"]) or !isset($card["def"])){
    header($_SERVER["SERVER_PROTOCOL"] . " 400 miss some(s) value(s) in request", true, 400);
    exit;
}

$file_name = "data.json";
$cards = [];
if (file_exists($file_name)) {
    $cards = json_decode(file_get_contents($file_name), true);
}

foreach($rlCars as $rlCarr){
    if($rlCarr["name"] == $rlCar["name"]){
        header($_SERVER["SERVER_PROTOCOL"] . " 401 Car already exist", true, 401);
        exit;
    }
}

$card["id"] = $cards[sizeof($cards)-1]["id"] + 1;

array_push($cards, $card);
file_put_contents($file_name, json_encode($cards));