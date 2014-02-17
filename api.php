<?php
if(!preg_match('#^([a-zA-Z0-9]+)$#',$_GET["v"])) { die("Error : Invalid Video ID (#0)");} // L'id ne correspond pas aux formats requis.
$videoID = $_GET["v"];

$url = "http://dreamvids.fr/index.php?page=watch&vid=".$videoID;

/* On récupère la page de la vidéo */
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'API for DreamVids');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$headers = array ('Accept-Language:fr-FR,fr;q=0.8,en-US;q=0.6,en;q=0.4');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);;
$video = curl_exec($ch);
curl_close($ch);

if(utf8_decode($video) == "Une erreur est survenue lors du chargement de la vidéo") { die("Error : Invalid Video ID (#1)");} // DreamVids a répondu un message d'erreur

/* On parse */
// On enlève les retours à la ligne
$video = str_replace("\n", "", $video);
$video = str_replace("\r", "", $video);

// On récupère le titre et l'auteur de la vidéo
preg_match('#<h1>(.+)<small> par <a href="/@(.+)">.+</a></small></h1>#',$video, $match);
$resultat["title"] = $match[1];
$resultat["author"] = $match[2];

// On récupère la description de la vidéo
preg_match('#<div class="panel-body">(.+)</div>	</div>#',$video, $match);
$resultat["description"] = str_replace("\t\t\t", "", $match[1]);
$resultat["description"] = htmlspecialchars($resultat["description"]);

// On récupère le nombre de vues
preg_match('#<b style="margin-left:50px">([0-9]+) vues</b>#',$video, $match);
$resultat["vues"] = $match[1];

/* On encode et on affiche */
$json = json_encode($resultat);
print_r($json);
?>
