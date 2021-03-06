<?php
$file_name = "data.json";
$data = [
    ["name" => "Black Soldier", "level" => 10, "type" => "Trap", "id" => 1, "imgLink" => "https://www.cardmaker.net/cardmakers/yugioh/createcard.php?name=&cardtype=Trap&subtype=effect&attribute=Light&level=0&trapmagictype=None&rarity=Common&picture=&circulation=&set1=&set2=&type=&carddescription=&atk=&def=&creator=&year=&serial=","atk" => 1562, "def"=>158],
    ["name" => "Evil Twin", "level" => 52, "type" => "Spell", "id" => 2, "imgLink" => "https://www.cardmaker.net/cardmakers/yugioh/createcard.php?name=&cardtype=Spell&subtype=effect&attribute=Light&level=0&trapmagictype=None&rarity=Common&picture=&circulation=&set1=&set2=&type=&carddescription=&atk=&def=&creator=&year=&serial=","atk" => 452, "def"=>965],
    ["name" => "Pink Dragon", "level" => 65, "type" => "Monster", "id" => 3, "imgLink" => "https://www.cardmaker.net/cardmakers/yugioh/createcard.php?name=&cardtype=Monster&subtype=effect&attribute=Light&level=0&trapmagictype=None&rarity=Common&picture=&circulation=&set1=&set2=&type=&carddescription=&atk=&def=&creator=&year=&serial=","atk" => 6845, "def"=>4752],
    ["name" => "Pikmin", "level" => 15, "type" => "Other", "id" => 4, "imgLink" => "https://www.cardmaker.net/cardmakers/yugioh/createcard.php?name=&cardtype=Xyz&subtype=effect&attribute=Light&level=0&trapmagictype=None&rarity=Common&picture=&circulation=&set1=&set2=&type=&carddescription=&atk=&def=&creator=&year=&serial=","atk" => 426, "def"=>1452]
];
file_put_contents($file_name, json_encode($data));