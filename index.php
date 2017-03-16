<!-- Alexandre HULSKEN - Zoe CANOEN -->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Projet TW2: V'Lille</title>
    <link href="style/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <script src="./scripts/script.js"></script>
    <script src="./scripts/CheckForm.js"></script>
</head>

<body>
    <header>
        <h1> V'liVe </h1>
        <img src="https://upload.wikimedia.org/wikipedia/fr/c/c5/Logo_Transpole2015MEL.png" alt="logo MEL" />
        <h3> projet de Technologie du Web 2017 </h3>
    </header>

    <div class="main-content">
        <div id="buttons">
            <div>
                <button type="button" name="myField">Ma station</button>
            </div>
            <div>
                <button type="button" name="myList">Toutes les stations</button>
            </div>
            <div>
                <button type="button" name="myForm">Recherche</button>
            </div>
        </div>
        <div class="Displayed">
            <div id="selectedFields" class="categorieSelected">
                <h3>LA CARTE V'LIVE</h3>
                <p>Cette carte V'liVe indique l'ensemble de toutes les stations V'Lille du territoire.</p>
                <p>Cliquez ci-dessus pour basculer entre la station que vous avez sélectionné, l'ensemble de toutes les stations et le formulaire de recherche.</p>
                <p><strong>Remarque:</strong> il s'agit ici d'une petite aide qui se trouve dans la section "Ma station" et disparaitra lors de votre première sélection de station</p>
            </div>
            <form id="myForm" action="index.php" method="post" onsubmit="return checkForm()">
                <?php
                    require_once("./lib/lectureArgument.php");
                    if (isset($errorMessage)) {
                        echo $errorMessage;
                    }
                ?>
                <div id="nbPlace">
                    Le nombre de places entre:<br/>
                    <input id="minP" type="number" name="minP" value="0" min="0" onblur="checkMaxChamp(this, document.getElementById('maxP'))">
                    et
                    <input id="maxP" type="number" name="maxP" value="25" min="0" onblur="checkMinChamp(document.getElementById('minP'), this)">
                </div>
                <hr/>
                <div id="nbVelo">
                    Le nombre de vélos entre:<br/>
                    <input id="minV" type="number" name="minV" value="0" min="0" onblur="checkMaxChamp(this, document.getElementById('maxV'))">
                    et
                    <input id="maxV" type="number" name="maxV" value="25" min="0" onblur="checkMinChamp(document.getElementById('minV'), this)">
                </div>
                <hr/>
                <label for="selectCommune">Sur quelle commune cherchez-vous?
                    <select name="selectCommune">
                        <option value="all" selected>--Commune--</option>
                        <?php
                            require_once("./lib/construct_html.php");
                            optionCommuneHTML();
                        ?>
                    </select>
                </label>
                <label for="CB"><input type="checkbox" name="CB" value="CB" id="CB"> terminal bancaire</label>
                <br>
                <button name="button" type="submit" value="reset" onclick="reset()">RESET</button>
                <button name="button" type="submit" value="filtre">FILTRER</button>
            </form>
            <div class="stations">
                <?php
                    require_once("./lib/construct_html.php");
                    echo tab_stations_html();
                ?>
            </div>
        </div>
    </div>

    <div id="carte">
        <pre>
            <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
            <script src="./scripts/VliveImage.js"></script>
        </pre>
    </div>

    <footer>
        <div id="annexes">
            <ul>
                <li><strong>ANNEXES</strong></li><br/>
                <li><a href="http://www.lillemetropole.fr/mel.html" target="_blank">la MEL</a></li>
                <li>Image par <a href="http://www.visualpharm.com/finance_icon_set/" target ="_blank">visualfarm</a> sous licence <a href="../images/licenses/credit_card.txt" target="_blank">Creative Commons (CC BY-NC-ND 3.0)</a>
            </ul>
        </div>
        <div id="contact">
            <ul>
                <li><strong>CONTACT</strong></li><br/>
                <li><a href="mailto:alexandre.hulsken@etudiant.univ-lille1.fr">Alexandre HULSKEN</a></li>
                <li><a href="mailto:zoe.canoen@etudiant.univ-lille1.fr">Zoe CANOEN</a></li>
            </ul>
        </div>
        <div id="lille1">
            <img src="./images/index.png" alt="Logo université Lille1">
        </div>
    </footer>
</body>
</html>
