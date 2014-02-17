<?php
if(!isset($_GET["v"]) || empty($_GET["v"])){
?>
	<title>DreamVids Intégrateur</title>
	
	<label for="vid">ID de la vidéo : </label><input id="vid" type="text" value="YL7Psl"/></br>
	AutoPlay : <label for="autoplay_y">Oui</label><input id="autoplay_y" type="radio" name="autoplay"><label for="autoplay_y">Non</label><input id="autoplay_n" type="radio" name="autoplay" checked></br>
	
	<p> Code à utiliser sur votre page web : <br/>
	<textarea id="code" cols="50" rows="5" readonly></textarea>
	
	<!-- Pub :p -->
	<a style="color:grey; text-decoration:none;" href="http://dreamvids.fr/@Stornitz"><img src="/img/logo.png" style="height:100px;"><span style="position: relative;left: -70px;">Stornitz</span></a>
	</p>
	
	<p>Exemple : <br/>
	<div id="test"></div></p>
	
	<script>
	var vid = document.getElementById('vid');
	vid.addEventListener("keyup", update);

	var ap_y = document.getElementById('autoplay_y');
	var ap_n = document.getElementById('autoplay_n');
	ap_y.addEventListener("change", update);
	ap_n.addEventListener("change", update);


	var code = document.getElementById('code');
	var test = document.getElementById('test');

	test.innerHTML = '<iframe width="640px" height="360px" frameborder="0" src="http://stornitz.fr/DreamVids/' + vid.value + '-0" allowfullscreen></iframe>';
	code.innerHTML = test.innerHTML;

	function update()
	{
		var ap = "";
		if(ap_n.checked){ ap = "-0"; }
		code.innerHTML = test.innerHTML = '<iframe width="640px" height="360px" frameborder="0" src="http://stornitz.fr/DreamVids/'+ vid.value + ap + '" allowfullscreen></iframe>';
	}
	</script>
	<script src="/google-analytics.js"></script>
<?php
}
else
{
	$vid = $_GET["v"];

	// Par défaut
	$autoplay = true;
	$vol = 1;

	// Si autoplay est désactivé
	if(isset($_GET["ap"]) && $_GET["ap"] == 0){$autoplay = false;}
	// Si le cookie du volume existe
	if(isset($_COOKIE["vol"]) && $_COOKIE["vol"] <= 1 && $_COOKIE["vol"] >= 0){$vol = $_COOKIE["vol"];}

	// On inclus le player
	include("embed.php");
}
?>