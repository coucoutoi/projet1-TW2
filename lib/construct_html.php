<!-- Alexandre HULSKEN - Zoe CANOEN -->
<?php
function read_bdd() {
  /* This fonction read the API and config the proxy
  param void
  returnType a JSon object
  */
  $configContext = array(
          'http' => array(
                  'proxy' => 'tcp://cache.univ-lille1.fr:3128',
                  'request_fulluri' => true
          )
  );
  stream_context_set_default($configContext);

  $fp=fopen("https://opendata.lillemetropole.fr/api/records/1.0/search/?dataset=vlille-realtime&rows=250&timezone=Europe/Paris","r");
  return json_decode(fgets($fp), true);
}

function list_station() {
  /* This fonction return the records of the MEL's API
  param void
  returnType a JSon object
  */
  $bdd =read_bdd();
  return $bdd["records"];
}

function tab_stations_html() {
  /* This fonction return the string of a table DOM object of all fields of the MEL's api
  param void
  returnType String
  */
  require './lib/lectureArgument.php';

  $stations=list_station();
  $res="<table id='list_station'>\n\t<thead><tr><th>Nom</th><th>Commune</th><th>Places disponibles</th><th>Places Vélos</th></tr></thead>\n\t<tbody>";
  foreach ($stations as $station) {
    $constructTime = explode(':', $station["record_timestamp"]);
    $constructTime[2] = substr($constructTime[0], 0, 2);
    $time = substr($constructTime[0], -2);
    for ($i=1; $i < 3; $i++) {
      $time .= ':'.$constructTime[$i];
    }
    $time .= " le ";
    $constructTime[0] = explode('-', $constructTime[0]);
    $time .= substr($constructTime[0][2], 0, 2).'/'.$constructTime[0][1].'/'.$constructTime[0][0];

    $fields = $station["fields"];
    $libelle = $fields["libelle"];
    $lat = $fields["geo"][0];
    $long = $fields["geo"][1];
    $type = $fields["type"];
    $etat = $fields["etat"];
    $etatConnexion = $fields["etatConnexion"];
    $commune = $fields['commune'];
    $adresse = $fields['adresse'].', '.$commune;
    $nbVelosDispo = $fields['nbVelosDispo'];
    $nbPlacesDispo = $fields['nbPlacesDispo'];
    $nom = explode(" ", $fields["nom"], 2)[1]; // on enlève le numéro devant le nom de la station
    $nom = trim(explode("(CB)", $nom)[0]); // on enlève la chaine "(CB)" si elle est définie et tout espace invisible en début et fin de chaine

    if ($nbVelosDispo == 0) {
      $veloClass = "empty";
    } elseif ($nbVelosDispo > 2) {
      $veloClass = "dispo";
    } else {
      $veloClass = "warning";
    }
    if ($nbPlacesDispo == 0) {
      $dispoClass = "empty";
    } elseif ($nbPlacesDispo > 2) {
      $dispoClass = "dispo";
    } else {
      $dispoClass = "warning";
    }

    if (($minV <= $nbVelosDispo && $maxV >= $nbVelosDispo) && ($minP <= $nbPlacesDispo && $maxP >= $nbPlacesDispo) && ($selectCommune == 'all' || $selectCommune == $commune) && (!$CB || $type == 'AVEC TPE')) {
      $res .= "\t<tr data-time='$time' data-libelle='$libelle' data-lat='$lat' data-long='$long' data-type='$type' data-etat='$etat' data-connected='$etatConnexion' data-adresse=\"$adresse\"><td><strong'> $nom </strong></td><td>$commune</td><td class='$veloClass'>$nbVelosDispo</td><td class='$dispoClass'>".$fields["nbPlacesDispo"]."</td></tr>\n";
    }
  }
  if ($res == "<table id='list_station'>\n\t<thead><tr><th>Nom</th><th>Commune</th><th>Places disponibles</th><th>Places Vélos</th></tr></thead>\n\t<tbody>") {
    return "<p id='list_station' class='ErrorMessage'>** AUCUNE STATION NE CORRESPOND A LA RECHERCHE QUE VOUS VENEZ D'EFFECTUER **<p>";
  } else {
    return $res."\t</tbody>\n</table>";
  }
}

function list_Commune() {
  /* This function build an array of all towns in the MEL's API as keys and the boolean true as values
  param void
  returnType Array of String keys and Boolean values
  */
  $stations = list_station();
  $res = array();
  foreach ($stations as $stationKey => $stationValue) {
    $commune = $stationValue["fields"]["commune"];
    if (!isset($res[$commune])) {
      $res[$commune] = true;
    }
  }
  return $res;
}

function optionCommuneHTML() {
  /* This function prints all options DOM objects for all towns in the MEL's API
  param void
  returnType void
  */
  $communeList = list_Commune();
  foreach ($communeList as $commune => $value) {
    printf('<option value = "'.$commune.'">'.$commune.'</option>');
  }
}
?>
