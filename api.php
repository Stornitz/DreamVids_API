<meta charset="utf-8">
<?php
    require_once('simple_html_dom.php');
    if(!preg_match('#^([a-zA-Z0-9]+)$#',$_GET["v"])) { die("Error : Invalid Video ID (#0)");} // L'id ne correspond pas aux formats requis.
    $videoID = $_GET["v"];

    $url = "http://dreamvids.fr/index.php?page=watch&vid=".$videoID;

    $html = new simple_html_dom();
    $html->load_file($url);
    $results = array();

    // On récupère le titre
    $results['title'] = $html->find('h1', 0)->plaintext;

    // On récupère l'auteur
    $author = $html->find('h1>small a', 0);
    $results['author'] = $author->plaintext;
    $results['author_link'] = 'http://dreamvids.fr'.$author->href;

    // On récupère la description
    $results['description'] = $html->find('div.panel-body', 0)->plaintext;
    // $results['description'] = str_replace("\n", '', $results['description']);
    // $results['description'] = str_replace("\r", '', $results['description']);
    $results["description"] = str_replace("\t\t\t", "", $results['description']);
    $results["description"] = htmlspecialchars($results['description']);

    // On récupère les vues
    $results['views'] = $html->find('b[style]', 0)->plaintext;

    // On récupère la date
    $date = preg_match('#le ([0-9\/]+) à ([0-9\:]+)#',  $html->find('div.panel-heading', 0)->plaintext, $match);
    $results['date'] = $match[1];
    $results['hour'] = $match[2];

    // On récupère l'image à la une
    $results['thumb'] = 'http://dreamvids.fr/'.$html->find('video', 0)->poster;

    $json = json_encode($results);
    var_dump($json);
?>
