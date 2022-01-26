document.addEventListener("DOMContentLoaded", async () => {
    await load_data();
});
async function load_data() {
    const contentElement = document.getElementById("content");
    const request = await fetch("/list.php");
    const cars = await request.json();
    contentElement.innerHTML = "";
    for (const card of cars) {
        contentElement.innerHTML += `
        <div class="item" id="${card.id}">
            <img src="${card.imgLink}"><br>
            Name: ${card.name}<br>
            Level: ${card.level}<br>
            Type: ${card.type}<br>
            Atk: ${card.atk}<br>
            Def: ${card.def}<br>
            <button onclick="edit_card('${card.id}')">Edit</button>
            <button onclick="delete_card('${card.id}')">Delete</button>
        </div>
        `;
    }
}

function set_img(setIt){
    if (setIt.value == "Monster"){
        return ("https://www.cardmaker.net/cardmakers/yugioh/createcard.php?name=&cardtype=Monster&subtype=effect&attribute=Light&level=0&trapmagictype=None&rarity=Common&picture=&circulation=&set1=&set2=&type=&carddescription=&atk=&def=&creator=&year=&serial=");
    }
    if (setIt.value == "Spell"){
        return ("https://www.cardmaker.net/cardmakers/yugioh/createcard.php?name=&cardtype=Spell&subtype=effect&attribute=Light&level=0&trapmagictype=None&rarity=Common&picture=&circulation=&set1=&set2=&type=&carddescription=&atk=&def=&creator=&year=&serial=");
    }
    if (setIt.value == "Trap"){
        return ("https://www.cardmaker.net/cardmakers/yugioh/createcard.php?name=&cardtype=Trap&subtype=effect&attribute=Light&level=0&trapmagictype=None&rarity=Common&picture=&circulation=&set1=&set2=&type=&carddescription=&atk=&def=&creator=&year=&serial=");
    }
    else {
        return("https://www.cardmaker.net/cardmakers/yugioh/createcard.php?name=&cardtype=Xyz&subtype=effect&attribute=Light&level=0&trapmagictype=None&rarity=Common&picture=&circulation=&set1=&set2=&type=&carddescription=&atk=&def=&creator=&year=&serial=");
    }
}
async function send_card() {
    const card = {
        "name": document.getElementById("name_input").value,
        "level" : parseInt(document.getElementById("level_input").value),
        "type" : document.getElementById("type_input").value,
        "atk" : document.getElementById("atk_input").value,
        "def" : document.getElementById("def_input").value,
        "imgLink": set_img(document.getElementById("type_input"))
    };
    await fetch("/add.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(card)
    });
    await load_data();
}

async function edit_card(card_id){
    const cardElement = document.getElementById(`${card_id}`);
    const card = {
        "id": card_id,
        "name": cardElement.name,
        "level" : cardElement.level,
        "atk": cardElement.atk,
        "def": cardElement.def,
        "imgLink": cardElement.imgLink,
    };
    const request = await fetch("/list.php");
    const cars = await request.json();
    let temp_card;
    for (const card of cars) {
        if (card.id == card_id){
            temp_card = card;
        };
    }
    document.getElementById(`${card.id}`).innerHTML = `
        <img src="${temp_card.imgLink}"><br>
        Name: <input id="edit_name_input" value="${temp_card.name}"></input><br>
        Level: <input id="edit_level_input" value="${temp_card.level}"></input><br>
        Type: <input id="edit_type_input" value="${temp_card.type}"></input><br>
        Atk: <input id="edit_atk_input" value="${temp_card.atk}"></input><br>
        Def: <input id="edit_def_input" value="${temp_card.def}"></input><br>
        <button onclick="valide_edit_card(${temp_card.id})">Valider</button>
    `;
}

async function valide_edit_card(card_id){
    const card = {
        "id": card_id,
        "name": document.getElementById("edit_name_input").value,
        "level" : parseInt(document.getElementById("edit_level_input").value),
        "type" : document.getElementById("edit_type_input").value,
        "atk" : document.getElementById("edit_atk_input").value,
        "def" : document.getElementById("edit_def_input").value
    };
    await fetch("/edit.php", {
        method: "PUT",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(card)
    });
    await load_data();
}

async function delete_card(card_id){
    const card = {
        "id": card_id,
    };
    await fetch("/delete.php", {
        method: "DELETE",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(card)
    });
    await load_data();
}
