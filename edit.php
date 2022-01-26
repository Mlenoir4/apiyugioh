<?php
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
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

if(isset($data["type"])){
    if($data["type"] == "Monster")
        $data["imgLink"] = "https:\/\/www.cardmaker.net\/cardmakers\/yugioh\/createcard.php?name=&cardtype=Monster&subtype=effect&attribute=Light&level=0&trapmagictype=None&rarity=Common&picture=&circulation=&set1=&set2=&type=&carddescription=&atk=&def=&creator=&year=&serial=";
    if($data["type"] == "Trap")
        $data["imgLink"] = "https:\/\/www.cardmaker.net\/cardmakers\/yugioh\/createcard.php?name=&cardtype=Trap&subtype=effect&attribute=Light&level=0&trapmagictype=None&rarity=Common&picture=&circulation=&set1=&set2=&type=&carddescription=&atk=&def=&creator=&year=&serial=";
    if($data["type"] == "Spell")
        $data["imgLink"] = "https:\/\/www.cardmaker.net\/cardmakers\/yugioh\/createcard.php?name=&cardtype=Spell&subtype=effect&attribute=Light&level=0&trapmagictype=None&rarity=Common&picture=&circulation=&set1=&set2=&type=&carddescription=&atk=&def=&creator=&year=&serial=";
    else
        $data["imgLink"] = "https:\/\/www.cardmaker.net\/cardmakers\/yugioh\/createcard.php?name=&cardtype=Monster&subtype=effect&attribute=Light&level=0&trapmagictype=None&rarity=Common&picture=&circulation=&set1=&set2=&type=&carddescription=&atk=&def=&creator=&year=&serial=";
}

foreach($Cards as $key => $value){
    if($data["id"] == $value["id"]){
        foreach ($data as $key2 => $value2){
            if($value !== $value["id"]){
                $Cards[$key][$key2] = $data[$key2];
            }
        }
    }
}
file_put_contents($file_name, json_encode($Cards));