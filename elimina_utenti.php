<?php

$pageTitle = "Elimina Utenti";
$pageType = "reserved";
$pageDescription = "";
$pageKeywords = "";
include_once("header.php");

if(isset($_GET["email"])){
	include_once("connectionDB.php");
	$connessione=new ConnectionDB();
	$connessione->openConnection();
	$utente = $connessione->getUtente($_GET["email"]);
	if(gettype($utente) == "object" && get_class($utente)=="Utente"){
		if($utente->getId()!=1 && ($_SESSION["id"]==1 || $_SESSION["id"]==$utente->getId())){
			if($connessione->deleteUtente($utente)){
				if($_SESSION["id"]==$utente->getId()){
					session_destroy();
				}
				header("location: ../?queryexecuted=true");
			}
			else
				header("location: ../?queryexecuted=false&motivo=user_query");
		}
		else
			header("location: ../?queryexecuted=false&motivo=hacker");
	}
	else
		header("location: ../?queryexecuted=false&motivo=user_not_exist");
}
else
	header("location: ../?queryexecuted=false&motivo=hacker");


?>
<body>
	<div id="container">
				
		<?php include_once("menu.php"); ?>

		<div id="content">
			<div id="breadcumbs">
				<p>Ti trovi in: Area Riservata > Elimina Utente</p>
			</div>
			<h2 class="centerAlign spaceTop">Elimina Utente</h2>
				<div class="row centerAlign">
					<?php
					
					echo $textToWrite;

					?>
					
				</div>
		</div>
		<?php include_once("footer.php"); ?>
