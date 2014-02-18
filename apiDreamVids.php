<?php
	define('DS', '/');
    require_once(__DIR__.DS.'simple_html_dom.php');
    $html = new simple_html_dom();
    class apiDreamVids{
        public function getVideoInformations($id_video){
            global $html;
            if(!preg_match('#^([a-zA-Z0-9]+)$#',$id_video)) { die("Error : Invalid Video ID (#0)");} // L'id ne correspond pas aux formats requis.
            $html->load_file("http://dreamvids.fr/&".$id_video);
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
        public function getVideos($search){
            global $html;
            $html->load_file("http://dreamvids.fr/$search");
            $results = new stdClass();
            $videos = $html->find('.col-md-2');
            $results = array();
            foreach($videos as $k => $v){
                $result = new stdClass();
                // Récupére le titre
                $result->title = $v->find('.thumbnail a img', 0)->title;
                // Récupére l'url
                $result->url = 'http://dreamvids.fr'.$v->find('.thumbnail a', 0)->href;
                // Récupére l'extrait
                $result->extrait = $v->find('.hotfeaturedtext p', 0)->plaintext;
                // Récupére la thumbnail
                $result->thumb = 'http://dreamvids.fr/'.$v->find('.thumbnail a img', 0)->src;
                // Récupére les vues
                $result->views = $v->find('.hotfeaturedbutton small', 0)->plaintext;
                // Récupére la date
                preg_match('#il y a ([a-zA-Z0-9]+) ([a-zA-Z0-9]+)#', $v->find('.hotfeaturedbutton', 0)->plaintext, $match);
                $result->date = 'Il y a '.$match[1].' '.$match[2];
                // Récupére l'auteur
                $result->author = $v->find('.hotfeaturedbutton a', 0)->plaintext;
                $result->author_url = 'http://dreamvids.fr'.$v->find('.hotfeaturedbutton a', 0)->href;
                // On compile l'objet $results et l'objet $result
                array_push($results, $result);
            }
            // On retourne l'objet $results
            return $results;
        }
		
		public function getVideosList(){
            return $this->getVideos('videoslist');
        }
		
		public function getVideosUser($user){
            if(!preg_match('#^([a-zA-Z0-9\-_]+)$#',$user)) { die("Error : Invalid Username (#0)");} // L'username ne correspond pas aux formats requis.
            return $this->getVideos("@$user");
        }
		
		public function getDiscover($user){
            return $this->getVideos("discover");
        }
    }
?>
