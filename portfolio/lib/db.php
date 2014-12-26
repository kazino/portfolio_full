<?php
try{
	$db = new PDO('mysql:host=localhost;dbname=tuto', 'root','');
	// récupere les information sous forme d'un tableau associatif
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	// affiche les erreurs plus précisement
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}catch(Exception $e){
	echo 'Impossible de se connecter à la base de donnée';
	echo $e->getMessage();
	die();
}
