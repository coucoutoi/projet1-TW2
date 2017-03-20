
<h1 style="text-align:center">PROJET 1 - Techologie du Web 2<br/>V'liVe</h1>

<table>
<tbody>
<tr><td style="border:none" rowspan="2"><img src="http://www.fil.univ-lille1.fr/portail/img/logo-FIL-transparent-site.png" width="300"/></td><th style="border:none">Enseignant responsable du module:<br/> Bruno Bogaert</th></tr>
<tr><th style="border:none">Enseignant de travaux dirigés:<br/> Léopold Weinberg</th></tr>
<tbody>
</table>

## Auteurs: Alexandre HULSKEN - Zoe CANOEN

#### L2S2 - Gr.2

> Ce projet portait sur la création d'une application web permettant aux usagers d'avoir des informations en temps réel des différentes stations V'Lille se trouvant se le territoire, avec la possibilité de faire quelques recherches pour affiner la sélection à travers un formulaire. On y trouve quatres grands axes, une table de l'ensemble des stations, une carte possédant des marqueurs pour chacune d'entre elles, une station sélectionnée premettant d'avoir l'ensemble de ses informations et pour finir un formulaire permmetant d'affiner sa recherche d'une station en fonction de certains critères préférenciels. Les différentes technologies requise ici ont été: `XHTML5`, `CSS3`, `JS3` et `PHP5`.

> Ce rapport technique permettra de vous expliquer la structure complète de ce projet ainsi que chacun des choix qui ont été fait tout au long de celui-ci. Il vous indequera aussi les manques et finira par vous expliquer son utilisation.

---

## Table des matières

> I. [L'Arborescence du projet](#arborescence)

> II. [L'Explication de nos fichiers](#fichiers)
>>  1. [Le fichier `index.php`](#index)
>>  2. [Le dossier *lib*](#lib)
>>  3. [Le dossier *scripts*](#scripts)
>>  4. [Le dossier *style*](#style)

> III. [Les fonctionnalitées et les manques](#plusEtMoins)
>>  1. [Les manques de notre projet](#moins)
>>  2. [Nos différentes fonctionnalités](#plus)

> IV. [Quelques tests pouvant être effectués](#test)

---

### <a name="arborescence">I - L'Arborescence du projet</a>

Lors de ce projet nous avons décidé de garder une arborescence assez structuré, c'est pour cela que nous avons décidé de placer chacun de nos fichiers dans des dossiers prévus à cet effet.
Dans le dossier racines de ce projet, vous trouverez donc un ensemble de dossiers avec le fichier principal, `index.php` qui est la page d'accueil de notre application web (ce nom à été choisi pour des raisons d'ergonomies, le fait d'avoir ce nom de fichier permet à l'utilisateur cherchant à ce connecter de ne pas indiquer son nom dans l'URL, mais nous expliciterons ce point dans la partie d'utilisation):

```
$ ls
images   lib   scripts   style   index.php
```

Ensuite, chacun de ces sous dossiers possèdes le nom le plus explicite possible pour indiquer son contenu.

Si vous vous déplacez dans cette arborescence, vous pourrez observer ceci:

```
$ ls
images   lib   scripts   style   index.php
$ cd ./style; ls
style.css
$ cd ../lib; ls
construct_html.php   lectureArgument.php
$ cd ../srcipts; ls
CheckForm.js   script.js   VliveImage.js
$ cd ../images; ls
licenses   credit_card.png   index.png
```

Comme vous pouvez le voir ci-dessus, le dossier *./style* comprend le fichier de style, le dossier *./lib* lui, l'ensemble de nos fichiers `PHP` qui contiennent nos fonctions utiles, le dossier *./scripts* contient nos fichiers `JavaScript`, et notre dossier *./images*, nos images ainsi qu'un dossier *./licenses* contenant leur licenses.

**Note :** Les codes donnés ici sont considérés comme étant dans le serveur webtp. Si vous les effectez par vous même, vous trouverez des fichiers supplémentaires sans lien direct avec notre application, tel que ce rapport.

---

### <a name="fichiers">II - L'Explication de nos fichiers</a>

#### <a name="index">II- 1. Le fichier `index.php`</a>

Ce fichier est la page principale de notre projet, il est essentiellement construit avec du `XHTML` et contient quelque balises `PHP` permettant la gestion des fonctions et scripts php définies dans le dossier *./lib*.

#### <a name="lib">II- 2. Le dossier *./lib*</a>

Ce dossier contient deux fichiers contenant l'ensemble des fonctions et scripts php qui ont été utils lors de la réalisation de ce projet.

- ##### Le fichier `lectureArgument.php`

Ce fichier est le fichier permettant de récupérer les valeurs envoyées par l'intermédiaire du formulaire se trouvant dans le fichier `index.php`.
Il attribut chacune de ces valeurs et s'adapte si besoin (il peut par exemple donner des valeurs par défaut si elles sont erronées ou non fournies et construit un message d'erreur adéquat sous forme d'une chaîne de caractères).

- ##### Le fichier `construct_html.php`

Ce fichier est un fichier permettant de "construire" le code html util au fichier `index.php`. Il sert notamment à récupérer les données en ligne par l'intermédiaire de l'API de la MEL et à écrire la table des stations sous forme d'une chaîne de caractères selon les valeurs renvoyées par la lecture d'argument vu précédemment.
Il permet aussi la construction de l'ensemble des balises `<option>` de notre fichier principal avec l'ensemble de toutes les communes disposants d'une station V'Lille.

#### <a name="scripts">II- 3. Le dossier *./scripts*</a>

- ##### Le fichier `CheckForm.js`

Ce fichier correspond à une vérification des valeurs entrées dans le formulaire, mais du côté client cette fois-ci.
Il corrige notamment les valeurs entrées par l'utilisateur dans les champs d'entrées de nombres pour avoir des valeurs cohérentes et empêche l'envoie de ces données si certains champs sont vides ou que l'utilisateur ai réussi à entrer des valeurs incohérentes dans le formulaire. Il remet aussi les valeurs par défaut du formulaire si le client souhaite annuler la recherche qu'il a déjà effectué.

- ##### Le fichier `VliveImage.js`

Il s'agit ici d'un fichier de scripts de dessin pour les icônes de la carte *Leaflet* qui nous a été fourni par le corps enseignant.

- ##### Le fichier `script.js`

Ce fichier est notre fichier de script principal, il permet la création de la carte *leaflet*, la création des différents icônes de la carte et la gestion entière des évènements que l'on puisse trouver.
On y trouve notamment la gestion des boutons de navigation, les évènements de sélection, et les évènements d'affichage.

#### <a name="style">II- 4. Le dossier *./style*</a>

Ce dossier ne contient qu'un fichier, `style.css`, qui est le fichier contenant l'ensemble des règles de styles de notre fichier.

---

### <a name="plusEtMoins">III - Les fonctionnalitées et les manques</a>

#### <a name="moins">III- 1. Les manques de notre projet</a>

Notre projet comporte certains manques, parmis ceux-ci, nous y  trouverons notamment:
- L'absence d'un filtre de recherche pour retrouver une station en particulier
- Le fait de ne pas avoir de recherche de stations aux alentours d'un point géographique (grace à une adresse donnée par l'utilisateur)
- Les informations supplémentaires grâce à un survole sur un marqueur de la carte
- L'adaptation du style sur le redimentionnement
- L'utilisation du logo de la MEL sans avoir eu la licence (nous leur avions envoyé une demande de logo dont nous n'avons eu aucune réponse)

Mais pour quelques uns de ces point nous avons fait des choix. Pour les infromations supplémentaires grâce au survole, nous avons implémenter la même fonctionnalité mais sur un clique, et pour le filtre nous avons fait le choix de ne pas l'implémenter de la manière dont nous avions pensé, car avec notre méthode cela pouvait gêner l'ergonomie pour un utilisateur lambda puisqu'il devait connaitre le nom exacte de la station qu'il souhaitait et ne pas faire de fautes de frappes ou d'orthographe en entrant rigoureusement son nom puisque sinon après l'envoie du formulaire elle n'allait pas apparaitre. Finalement pour le point de recherche par point géographique, nous avons choisi de ne pas l'implémenter puisque nous voulions laisser l'utilisateur entrer une adresse et une distance par rapport à celle-ci pour obtenir les stations dans ces environs, mais nous n'avons pas réussit à récupérer les coordonnées géographique de cette adresse. Du coup nous aurions pu faire la même fonctionnalité mais avec une entrée de coordonnées par l'utilisateur mais notre choix c'est porté sur le fait de ne pas l'implémenter par simple soucis d'ergonomie d'utilisation puisqu'une personne lambda ne connait pas forcement les coordonnées géographique de la position qu'elle souhaite mais plutôt l'adresse de cet endroit.

#### <a name="plus">III- 2. Nos différentes fonctionnalités</a>

Notre projet possède différentes fonctionnalités différentes dont nous avons parlé très rapidement en présentant chacun de nos différents fichiers. Celles dont nous voulons particulierement mettre l'accent sont:
- La gestion de changement de catégorie dans la "bulle de contenue" entre autre, il s'agit de la partie de la page se trouvant au dessus de la carte et qui contient la petite aide de fonctionnement au départ, la table de l'ensemble des stations, le formulaire et la station sélectionnée
- Les popup pour chacun des marqueurs de la carte sur un clique
- La gestion de la sélection d'une station (que ce soit par un clique sur la table ou sur le bouton de sélection dans une popup de la carte)
- La verification des valeurs entrées par l'utilisateur et le comportement qui doit être adaptédu coté client comme du côté serveur (la correction ou le blocage de l'envoie du côté client et la construction de messages d'erreurs avec la réattribution des valeurs par défaut du côté serveur)
- La création d'un message d'erreur remplaçant la table si celle-ci doit être vide
- La partie de contact qui permet d'envoyer un mail à notre adresse étudiante
- Le fait que toute l'application se porte sur une seule page et n'utilise aucune autre page web, entre autre, l'utilisateur restera toujours sur une même page ou sera redirigé sur cette même page mais avec des valeurs internes différentes
- La carte est recentré sur le marqueur de la station sélectionnée dans la table de l'ensemble des stations

---

### <a name="test">IV - Quelques tests pouvant être effectués</a>

Pour tester l'ensemble de nos fonctionnalitées, cela risque d'être difficile puisqu'il faudrait en enlevé certaines dans certains moments puisque pour quelques unes, elle sont cachées par d'autre (par exemple la vérification des valeurs du formulaire, elle est faite du coté serveur comme du coté client du coup celle du côté serveur reste caché à première vu mais sert de sécurité).
Pour votre test de bêta-testeur, nous allons supposer que vous utiliser votre navigateur favorie (tel que firefox) dans la taille que vous souhaitez (tel que le pleine écran) sans désactiver aucune fonctionnalité (tel que désactiver l'execution des scripts `JavaScript`).
Vous pouvez donc suivre la suite d'action que je vais vous donner ci-dessous ou alors y aller en simple aventurier et partir à l'aventure sans aucune aide, mais cela reste à vos risques et périls...
Comme il a été précisé en début de cette fiche, la page principale `index.php` n'apparait pas dans cet URL. Cela se fait que par défaut le navigateur va chercher à lancer un fichier index qui sera la page d'accueil du site hôte demandé dans le sous-dossier demandé.
Voici donc le test que je vous conseillerais de faire sur cette application:

> -> Appuyez sur le bouton nommé *Recherche* puis *Ma station*, vous verrez que l'aide donnée ce trouve toujours dans cette section
> -> Appuyez sur le bouton nommé *Toutes les stations* et baladez vous dans cette table
> -> Une fois finie de vous amusez, appuyez sur l'une des lignes, vous observerez que vous êtes redirigez dans une nouvelle section contenant toutes les informations utiles de la station et que la carte a été centré sur le marqueur de cette station, nous dirons donc que vous avez sélectionnez cette station (vous pouvez vous rendre compte que l'aide donnée au départ à disparue et a été remplacé par cette fiche détaillée dans la section *Ma station* et que cette station en question a été mise en valeur dans la table)
> -> Baladez vous ensuite sur la carte en cliquant sur quelques marqueurs, puis appuyer sur le bouton *Sélectionner* de l'un d'entre eux
> -> Vous verrez que la station en question a été sélectionné et est affiché dans la catégorie *Ma station*
>**Note :** si vous étiez dans une autre catégorie que cette-dernière lors de la sélection, vous y êtes redirigé
> -> Attaquons-nous au formulaire maintenant, partez donc dans la catégorie *Recherche*
> -> Cherchez toutes les stations dans la communes de *LOMME*, vous verrez donc que la carte à été recentré, si vous dézommez tous les autres marqueurs auront disparu et c'est pareil pour la table.
> -> Maintenant laissez le champ du nombre de vélos voulus minimum vide et essayez de lancer le filtre
> -> Si Vous n'avez rien désactivé, une fenêtre de dialogue souvrira pour vous dire que vous avez oublié un champ et bloquera l'envoie des données, et si maintenant vous appuyez sur le bouton *RESET*, vous retomberez sur la page tel que vous l'aviez eu au tout début du test
> -> Continuons sur le formulaire, entrez maintenant le nombre `0205,0` dans les deux champs de minimum, vous verrez qu'ils ont été remplacé par `205` ainsi que les champs de maximum puisque leur valeur de `25` était inférieur
> -> Si vous lancez le filtre avec ces valeurs vous observerez que la carte est centré sur la ville de Lille et qu'aucun marqueur n'est présent sur la carte, si vous vous déplacez maintenant dans la section *Toutes les stations* vous pourrez voir l'apparition d'un message d'erreur qui a pu remplacer la table
> -> Vous pouvez continuez à utilisez le formulaire si vous le souhaitez mais l'ensemble des fonctionnalitées à été vu avec ces test
> -> Pour finir vous pouvez tester les liens se trouvant dans la partie *ANNEXES* du pied de page qui envoie sur des sites externes dans un nouvel onglet, puis utilisez les liens de la partie *CONTACT* et envoyez nous des mails pour nous dire à quel point nous sommes géniaux

<br/>
<p style="text-align:center; font-size:120%"><strong>Merci beaucoup à vous pour votre patience</strong></p>
