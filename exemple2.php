<meta charset="utf-8">
<h1>Mes vidéos</h1><br />
<?php
    require_once('apiDreamVids.php');
    $apiDreamVids = new apiDreamVids();
    $videosUser = $apiDreamVids->getVideosUser('JamesHemery'); // USERNAME
    foreach($videosUser as $k => $v):
        ?>
        <div style="width:300px; float:left; margin:15px; padding: 10px; border: 1px solid #000;">
            <h3><a href="<?= $v->url; ?>"><?= $v->title; ?></a></h3>
            <img src="<?= $v->thumb; ?>" style="width:100%;height:auto;" alt="">
            <p><?= $v->extrait; ?></p>
            <span>Par <a href="<?= $v->author_url; ?>"><?= $v->author; ?></a>, <?= $v->date; ?>, <?= $v->views; ?>.</span>
        </div>
        <?php
    endforeach;
?>