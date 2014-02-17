<meta charset="utf-8">
<?php
    require_once('apiDreamVids.php');
    $apiDreamVids = new apiDreamVids();
    $videoInformations = $apiDreamVids->getVideoInformations('gDM3qj'); // ID DE LA VIDEO
?>
<h3><?= $videoInformations->title; ?></h3>
<b>Par <a href="<?= $videoInformations->author_url; ?>"><?= $videoInformations->author; ?></a>, le <?= $videoInformations->date; ?> à <?= $videoInformations->hour; ?>, <?= $videoInformations->views; ?></b><br />
<img height="auto" width="400px" src="<?= $videoInformations->thumb; ?>" alt="">
<p><?= nl2br($videoInformations->description); ?></p>