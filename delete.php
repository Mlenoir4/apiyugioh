<?php
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed", true, 405);
    exit;
}

$inputJSON = file_get_contents('php://input');
$data = json_decode($inputJSON, TRUE);
if(!isset($data["id"])){
    header($_SERVER["SERVER_PROTOCOL"] . " 400 miss ID in request", true, 400);
    exit;
}


$file_name = "data.json";
$Cards = [];
if (file_exists($file_name)) {
    $Cards = json_decode(file_get_contents($file_name), true);
}


foreach($Cards as $key=>$value){
    if($Cards[$key]["id"] == $data["id"]){
        array_splice($Cards, $key, 1);
        break;
    }
    if(($key +1) == sizeof($rlCars)){
        header($_SERVER["SERVER_PROTOCOL"] . " 402 This ID doesn't exist", true, 402);
    }
}
file_put_contents($file_name, json_encode($Cards));