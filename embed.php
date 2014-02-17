<link rel="stylesheet" type="text/css" href="dreamplayer/css/player.css">
<link rel="stylesheet" type="text/css" href="style.css">
<div id="player">
	<video x-webkit-airplay="allow" autobuffer preload="auto" <?php if($autoplay) { ?> autoplay <?php } ?>></video>
	
	<div id="annotationsElement"></div>
	<span id="repeat">
		<span class="icon"></span>
	</span>
	<span id="qualitySelection" class="show"></span>
	<span id="bigPlay"></span>
	<span id="bigPause"></span>
	<div id="controls">
		<span id="progress">
			<span id="buffered"></span>
			<span id="viewed"></span>
			<span id="current"></span>
		</span>
		<span id="play-pause" class="play"></span>
		<span id="time"></span>
		<a title="Voir sur DreamVids" target="_parent" href="http://dreamvids.fr/&<?= $vid ?>"><div id="WatchOnDreamVids"></div></a>
		<span id="separation2"></span>
		<span id="annotationsButton" style="display: none"></span>
		<span id="qualityButton">SD</span>
		<span id="volume">
			<span id="barre"></span>
			<span id="icon"></span>
		</span>
		<span id="separation"></span>
		<span id="fullscreen" class="fullscreen"></span>
	</div>
</div>
<script src="dreamplayer/js/ajax.js"></script>
<script src="dreamplayer/js/player.js"></script>
<script>
setAnnotations([]);
setStartVolume(<?= $vol ?>);
</script>
<script src="http://dreamvids.fr/utils/videoinfo.php?vid=<?= $vid ?>"></script>
<script src="/google-analytics.js"></script>