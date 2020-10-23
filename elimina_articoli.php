<?php
	include_once("connectionDB.php");
	$connessione=new ConnectionDB();
	$connessione->openConnection();
	$code;
	if(isset($_GET["id"]) && !empty($_GET["id"])){
		$articolo=$connessione->getArticolo($_GET["id"]);
		if($connessione->deleteArticolo($articolo)){
			$code="success";
		}
		else $code="error";
	}
	else{
		$code="failure";
	}
	$connessione->closeConnection();
	header("location: ../".$code);
?>