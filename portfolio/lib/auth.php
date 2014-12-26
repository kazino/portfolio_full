<?php
session_start();
// si cet variable n'est pas définie c'est que nous ne voulons pas gerer l'authentification
if(!isset($auth)){
	if(!isset($_SESSION['Auth']['id'])){
		//redirection vers login.php si la personne n'est pas connecter
		header('Location:' . WEBROOT . 'login.php');
		die();
	}	
}


if(!isset($_SESSION['csrf'])){
	$_SESSION['csrf'] = md5(time() + rand());
}

function csrf(){
	return 'csrf=' . $_SESSION['csrf']; 
}

function csrfInput(){
	return '<input type="hidden" value="' . $_SESSION['csrf'] . '" name="csrf">';
}

function checkCsrf(){
	if(
		(isset($_POST['csrf']) && $_POST['csrf'] == $_SESSION['csrf']) ||
		(isset($_GET['csrf']) && $_GET['csrf'] == $_SESSION['csrf'])
		){
		return true;
	}
	header('Location:' . WEBROOT . 'csrf.php');
	die();
}

?>