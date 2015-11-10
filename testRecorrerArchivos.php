<?php
	require_once 'libreria/RecorrerArchivos.php';
	
	$archivos = RecorrerArchivos("c:/wamp");
	foreach ($archivos as $archivo)
		echo $archivo."<br />";
?>