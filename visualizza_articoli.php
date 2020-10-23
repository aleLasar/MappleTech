<?php

$pageTitle = "Visualizza";
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
			<div id="breadcumbs">
				<p>Ti trovi in: Area Riservata > Gestisci Articoli > <?php echo $pageTitle; ?></p>
			</div>
			<h2 class="centerAlign spaceTop"><?php echo $pageTitle; ?></h2>
					<?php
					if(isset($_GET["id"]) && !empty($_GET["id"])){
						include_once("connectionDB.php");
						$connessione=new ConnectionDB();
						$connessione->openConnection();
						$articolo = $connessione->getArticolo($_GET['id']);
						if(gettype($articolo) == "object" && get_class($articolo) == "Articolo"){
						    $tipo="Offerta";
						    if($articolo->getTipo()!=0){
						        if($articolo->getPrezzo()=="0"){
						            $tipo="Notizia";
						        }else{
						            $tipo="Servizio";
						        }
						    }
							echo "
								<div class=\"row\">
								<div class=\"col s6 b3\">
									<h1>".$articolo->getTitolo()."</h1>
									<p>".$articolo->getTesto()."</p>
								</div>
								<div class=\"col s6 b3\">
                                    <h1>Tipo: ".$tipo."</h1>
									<img class=\"imgArticolo\" src=\"".$HOMEDIR."/".$articolo->getImmaginePath()."\" alt=\"".$articolo->getTitolo()."\" >
								</div></div>";
							if(!($articolo->getPrezzo()=="0")){
                                echo "<div class=\"row\"><div class=\"col s6 b2\"><p class=\"prezzo\">";
                                echo $articolo->getPrezzo();
                                echo "<p></div>";
                                echo "<div class=\"col s6 b2\"><p>";
                                echo "Data Pubblicazione ".$articolo->getDataPub();
                                echo "<p></div>";
                                echo "<div class=\"col s6 b2\"><p>";
                                echo "Data Scadenza ".$articolo->getDataScad();
                                echo "<p></div>";
                                echo "</div>";	
                            }
                            echo "<div class=\"row\"><div class=\"col s6 b6\">
								<a href=\"../\" title=\"Torna indietro\"><i class=\"fas fa-arrow-left\"></i> Torna indietro</a>
							  </div></div>";										
						}
						else{
							echo "<div class=\"col s6 b4\">
									<div id=\"errorcode\">
										Articolo non trovato!
									</div>
								</div>";
						}
						$connessione->closeConnection();
					}
					else{
						echo "Come mai sei qui?";
					}			
					?>
		</div>
	<?php include_once("footer.php"); ?>