/* Alexandre HULSKEN - Zoe CANOEN */
var map; // the map of the project

function bubbleColor(Color) {
  /* This function return the String of a div object, this object is a bubble with the Color Color
  param Color a String
  returnType String
  */
  return '<div style="display:inline-block; width:10px; height:10px; border-radius:50%; margin: 3px; background-color:'+Color+'; border:solid; border-style:groove; border-width:2px"></div>';
}

function unselectFields() {
  /* This function remove the class name 'selected' at the DOM element of 'table#list_station tr.selected' query selector
  param void
  returnType void
  */
  var oldSelect = document.querySelector("table#list_station tr.selected");
  if (oldSelect)
      oldSelect.classList.remove("selected");
}

function dessinerCarte() {
  /* Tis functino draw the map at the element with the id 'carte'
  param void
  returnType void
  */
  map = L.map('carte');
  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '©️ <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);
}

function CreateIcons() {
  /* This function creates all fields' icons of the table in the map, add events for all of its and center the map in all of their
  param void
  returnType void
  */
  var stylesheetIcon = "display:inline-block; margin:0; width:45%; text-align:center; border:solid 1px; border-collapse:collapse; ";
  var markerList = [];
  var LatLongList = [];

  var arrayLines = document.getElementById('list_station').getElementsByTagName('tr');
  for (var i = 1; i < arrayLines.length; i++) {
    var tr = arrayLines[i];
    var td = tr.getElementsByTagName('td');
    var iconDraw = new VliveImage(parseInt(td[2].innerHTML),parseInt(td[3].innerHTML));
    LatLongList[i] = L.latLng(parseFloat(tr.dataset.lat), parseFloat(tr.dataset.long));
    markerList[i] = L.marker([parseFloat(tr.dataset.lat), parseFloat(tr.dataset.long)], {icon:iconDraw.getLeafletIcon()}).addTo(map)
       .bindPopup('<h3 style="margin:0">' +td[0].innerHTML+' </h3><i style="font-size:80%">'+tr.dataset.adresse+'</i><hr/><div style="width:100%; padding:0; text-align:center; font-size: 10px; font-weight: bold"><p class="'+td[3].className+'" style="'+stylesheetIcon+'border-radius:10px 0px 0px 10px">'+td[3].innerHTML+' vélos</p><p class="'+td[2].className+'" style="'+stylesheetIcon+'border-radius:0px 10px 10px 0px">'+td[2].innerHTML+' places</p></div><div style="width:100%; text-align: center"><button value="'+tr.dataset.libelle+'" style="margin-top:5px; border-radius:5px">Sélectionner</button></div>');
  }
  if (LatLongList.length != 0) {
    var bounds = new L.LatLngBounds(LatLongList);
    map.fitBounds(bounds);
  } else {
    map.setView([50.633333, 3.066667], 14);
  }
  map.on("popupopen",activeButton);
}

function clickCategorie() {
  /* This function remove the class name 'categorieSelected' of the DOM element with '.categorieSelected' query selector and add this class name to the object of who cause this event
  param void
  returnType void
  */
  var oldSelect = document.querySelector(".categorieSelected");
  oldSelect.classList.remove("categorieSelected");

  if (this.name == 'myForm') {
    document.getElementsByTagName('form')[0].classList.add("categorieSelected");
  } else if (this.name == 'myList') {
    (document.getElementsByClassName('stations')[0]).classList.add("categorieSelected");
  } else {
    document.getElementById('selectedFields').classList.add("categorieSelected");
  }
}

function choosenSelectedFields() {
  /* This function call the 'unselectFields' function, add the class name 'selected' to the element who cause this event and call the function 'displaySelectedFields'
  param void
  returnType void
  */
  unselectFields();
  this.classList.add("selected");
  map.setView([parseFloat(this.dataset.lat), parseFloat(this.dataset.long)], 20);
  displaySelectedFields();
}

function activeButton(ev) {
  /* This function activ the button of the popup who cause this event
  param ev the the event
  returnType void
  */
  var noeudPopup = ev.popup._contentNode;
  var button = noeudPopup.querySelector("button");
  button.addEventListener('click', clickSelectCarte)
}

function clickSelectCarte() {
  /* This function display the field selected by the user in a click in the map
  param void
  returnType void
  */
  unselectFields();

  var stationsList = document.getElementById('list_station').getElementsByTagName('tr');
  for (var i = 0; i < stationsList.length; i++) {
    var tr = stationsList[i];
    if (tr.dataset.libelle == this.value) {
      tr.classList.add("selected");
    }
  }
  displaySelectedFields();
}

function displaySelectedFields() {
  /* This function display the field who had the class name 'selected' in the DOM element with the id selectedFields
  param void
  returnType void
  */
  var bubble = document.getElementById("selectedFields");
  var selectedFields = document.getElementsByClassName('selected')[0];
  var td = selectedFields.getElementsByTagName('td');

  if (selectedFields.dataset.type == "AVEC TPE") {
    var cb = "<img src = './images/credit_card.png' alt = 'logo credit card' style='height:15px'/>";
  } else {
    var cb = "";
  }

  if (selectedFields.dataset.connected == "CONNECTEE") {
    var GreenColor = "lightgreen";
    var RedColor = "rgb(115, 8, 0)";
    var txt = "";
  } else {
    var GreenColor = "rgb(9, 82, 40)";
    var RedColor = "rgb(255, 33, 26)";
    var txt = "NON ";
  }

  bubble.innerHTML = '<h3>'+td[0].innerHTML+'<em>N°'+selectedFields.dataset.libelle+'</em></h3><hr/><i>'+selectedFields.dataset.adresse+'</i><div><h5>'+selectedFields.dataset.etat+' '+cb+'</h5><h5>STATION '+txt+'CONNECTEE '+bubbleColor(GreenColor)+bubbleColor(RedColor)+'</h5></div><br/><div><p>Sur cette station vous pourrez trouver <em class="'+td[3].className+'" style="font-style: normal;">'+td[3].innerHTML+'</em> vélos disponibles ainsi que <em class="'+td[2].className+'" style="font-style: normal;">'+td[2].innerHTML+'</em> places disponibles.</p><br/><br/><i>Dernière synchronisation faite à '+selectedFields.dataset.time+'</i></div>';

  document.getElementsByTagName('form')[0].classList.remove("categorieSelected");
  document.getElementsByClassName('stations')[0].classList.remove("categorieSelected");
  document.getElementById('selectedFields').classList.add("categorieSelected");
}

function setupListener() {
  /* This funtion is the setup listener for all events in this website
  param void
  returnType void
  */
  dessinerCarte();
  CreateIcons();
  var stationsList = document.getElementById('list_station').getElementsByTagName("tr");
  var buttons = document.getElementById('buttons').getElementsByTagName('button');

  for (var i = 1; i < stationsList.length; i++) {
    stationsList[i].addEventListener("click", choosenSelectedFields);
  }

  for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click', clickCategorie);
  }
}

window.addEventListener('load', setupListener);
