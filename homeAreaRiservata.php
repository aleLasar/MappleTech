<?php

$pageTitle = "Home Area riservata";
$pageType = "reserved";
$pageDescription = "";
$pageKeywords = "";
include_once("header.php");
?>
<body>
	<div id="container">
				
		<?php include_once("menu.php"); ?>

		<div id="content">
		<div class="noWhitespace">
			<?php
			include_once("connectionDB.php");
			$connessione=new ConnectionDB();
			$connessione->openConnection();
				//print_r($_SESSION["user"]);
				$utente = $connessione->getUtente($_SESSION["user"]);
				echo "<h1>Benvenuto ".$utente->getNome()."</h1>";
				$connessione->closeConnection();
			?>
			<div id="breadcumbs">
				<p>Ti trovi in: Area Riservata > <span xml:lang="en" lang="en">Home</span></p>
			</div>
			<h2 class="centerAlign spaceTop">Home Area Riservata</h2>
				<div class="row centerAlign">
					<div class="row">
						<p>
							Questa &egrave; l&apos;area di amministrazione. In quest&apos;area si possono aggiungere nuovi utenti amministratori, nuovi articoli e nuove offerte.
						</p>
						<h3>Scegli l'azione da effettuare:</h3>
						<ul>
							<li><a href="../gestisci_articoli/nuovo/">Crea nuovo articolo</a></li>
							<li><a href="../gestisci_utenti/nuovo/">Crea nuovo utente</a></li>
						</ul>
					</div>
				</div>
		</div>

<?php include_once("footer.php"); ?>
