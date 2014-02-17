<?php
    require_once('simple_html_dom.php');
    $html = new simple_html_dom();
    class apiDreamVids{
        public function getVideoInformations($id_video){
            global $html;
            if(!preg_match('#^([a-zA-Z0-9]+)$#',$id_video)) { die("Error : Invalid Video ID (#0)");} // L'id ne correspond pas aux formats requis.
            $html->load_file("http://dreamvids.fr/index.php?page=watch&vid=".$id_video);
            $results = new stdClass();
            // On récupère le titre
            $results->title = $html->find('h1', 0)->plaintext;
            // On récupère l'auteur
            $author = $html->find('h1>small a', 0);
            $results->author = $author->plaintext;
            $results->author_url = 'http://dreamvids.fr'.$author->href;
            // On récupère la description
            $results->description = $html->find('div.panel-body', 0)->plaintext;
            // $results->description = str_replace("\n", '', $results->description);
            // $results->description = str_replace("\r", '', $results->description);
            $results->description = str_replace("\t\t\t", "", $results->description);
            $results->description = htmlspecialchars($results->description);
            // On récupère les vues
            $results->views = $html->find('b[style]', 0)->plaintext;
            // On récupère la date
            $date = preg_match('#le ([0-9\/]+) à ([0-9\:]+)#',  $html->find('div.panel-heading', 0)->plaintext, $match);
            $results->date = $match[1];
            $results->hour = $match[2];
            // On récupère l'image à la une
            $results->thumb = 'http://dreamvids.fr/'.$html->find('video', 0)->poster;
            // On retourne le tableau
            return $results;
        }
    }
?>
