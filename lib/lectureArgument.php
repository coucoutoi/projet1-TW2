<!-- Alexandre HULSKEN - Zoe CANOEN -->
<?php
  $button = (!empty($_POST['button'])) ? $_POST['button'] : 'reset';
  $minP = (!empty($_POST['minP'])) ? intval($_POST['minP']) : 0;
  $maxP = (!empty($_POST['maxP'])) ? intval($_POST['maxP']) : 25;
  $minV = (!empty($_POST['minV'])) ? intval($_POST['minV']) : 0;
  $maxV = (!empty($_POST['maxV'])) ? intval($_POST['maxV']) : 25;
  $selectCommune = (!empty($_POST['selectCommune'])) ? $_POST['selectCommune'] : 'all';
  $CB = (!empty($_POST['CB'])) ? true : false;
  if ($button == 'reset' || $minP > $maxP || $minV > $maxV) {
    $errorMessage = "";
    if ($minP > $maxP) {
      $errorMessage .= '<p class="ErrorMessage">** Veuillez entrer une valeur minimum de places disponibles inferieure à la valeur maximum **</p>';
    }
    if ($minV > $maxV) {
      $errorMessage .= '<p class="ErrorMessage">** Veuillez entrer une valeur minimum de vélos disponibles inferieure à la valeur maximum **</p>';
    }
    $minP = 0;
    $maxP = 100;
    $minV = 0;
    $maxV = 100;
    $selectCommune = 'all';
    $CB = false;
  }
?>
