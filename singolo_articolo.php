<?php

/* HEADER CALL */
$pageTitle = "Articolo";
$pageType = "public";
$pageDescription = "";
$pageKeywords = "";
include_once("header.php");
include_once("connectionDB.php");
$connessione=new ConnectionDB();
$connessione->openConnection();
?>
<body>
	<div id="container">
	<div class="noWhitespaceDue">			
		<?php include_once("menu.php"); ?>

		<div id="content">
			<div id="breadcumbs">
				<p>Ti trovi in: <span xml:lang="en" lang="en">Home</span> > Servizi > <?php echo $pageTitle; ?></p>
			</div>
					<?php
					if(isset($_GET['id']) && !empty($_GET['id'])){
						$articolo = $connessione->getArticoloFromUrl($_GET['id']);
						if(gettype($articolo) == "object" && get_class($articolo) == "Articolo"){
										echo "
											<div class=\"row\">
											<div class=\"col s6 b3\">
												<h2>".$articolo->getTitolo()."</h2>
												<p>".$articolo->getTesto()."</p>
											</div>
											<div class=\"col s6 b1\">
                                                <img class=\"imgArticolo\" src=\"".$HOMEDIR."/".$articolo->getImmaginePath()."\" alt=\"".$articolo->getTitolo()."\" >
											</div>";
										if(!($articolo->getPrezzo()=="0")){
                                                echo "<div class=\"col s6 b4\"><p class=\"prezzo\">Prezzo: ";
                                                echo $articolo->getPrezzo();
                                                echo "</p></div>";	
                                        }							
									}
						else{
										echo "<div class=\"col s6 b4\">
												<div id=\"errorcode\">
												Articolo non trovato!
												</div>
											</div>";
									}
						$connessione->closeConnection();
						echo "<p class=\"showOnPrint clearLeft\"> </p><div class=\"col s6 b4 hidePrint\">
									<a href=\"".$HOMEDIR."/servizi/\" title=\"Torna indietro\"><em class=\"fas fa-arrow-left\"></em> Torna indietro</a>
							 </div>";	
					}
					?>
		</div>
		</div>
	<?php include_once("footer.php"); ?>