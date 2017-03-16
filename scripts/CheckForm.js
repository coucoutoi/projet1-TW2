/* Alexandre HULSKEN - Zoe CANOEN */
function cmpErr(champMin, champMax) {
  /* this function return true if the value of champMin is highter than its of champMax and false if not
  param champMin a DOM input object
  param champMax a DOM input object
  returnType boolean
  */
  return parseInt(champMin.value) > parseInt(champMax.value);
}

function checkMaxChamp(champMin, champMax) {
  /* This function update value of champMax so that the values of champMin isn't highter than its of champMax
  param champMin a DOM input object
  param champMax a DOM input object
  returnType void
  */
  var value = champMin.value;
  if (cmpErr(champMin, champMax)) {
    champMax.value = value;
  }
  champMin.value = value; // pour enlever les 0 supplémentaires (exemple pour transformer 03 ou 3,0 en 3 dans le champ où la saisie a été effecté)
}

function checkMinChamp(champMin, champMax) {
  /* This function update value of champMin so that the values of champMin isn't highter than its of champMax
  param champMin a DOM input object
  param champMax a DOM input object
  returnType void
  */
  var value = champMax.value;
  if (cmpErr(champMin, champMax)) {
    champMin.value = value;
  }
  champMax.value = value; // pour enlever les 0 supplémentaires (exemple pour transformer 03 ou 3,0 en 3 dans le champ où la saisie a été effecté)
}

function reset() {
  /* This function update all values of input number to their beginning values
  param void
  returnType void
  */
  document.getElementById('minV').value = 0;
  document.getElementById('maxV').value = 25;
  document.getElementById('minP').value = 0;
  document.getElementById('maxP').value = 25;
}

function checkForm() {
  /* This function check values of the form Dom object and return true if values are correct and false if not with an alert
  param void
  returnType void
  */
  if (!document.getElementById('minP').value || !document.getElementById('maxP').value || !document.getElementById('minV').value || !document.getElementById('maxV').value) {
    alert('Vous avez laissé un champ vide !');
    return false;
  } else if (cmpErr(document.getElementById('minP'), document.getElementById('maxP'))) {
    alert('Veuillez entrer une valeur minimum de places disponibles inférieure au nombre maximum voulu');
    return false;
  } else if (cmpErr(document.getElementById('minV'), document.getElementById('maxV'))) {
    alert('Veuillez entrer une valeur minimum de vélos disponibles inférieure au nombre maximum voulu');
    return false;
  } else {
    return true;
  }
}
