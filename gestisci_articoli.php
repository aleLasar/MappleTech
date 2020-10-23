<?php

$pageTitle = "Gestisci Articoli";
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
				<p>Ti trovi in: Area Riservata > <?php echo $pageTitle; ?></p>
			</div>
			<h2 class="centerAlign spaceTop"><?php echo $pageTitle; ?></h2>

				<div class="row centerAlign scroll">
					<p><a href="../gestisci_articoli/nuovo/" title="aggiungi nuovo articolo"><em class="fas fa-plus"></em> Aggiungi Articolo</a></p>
					<?php
					include_once("connectionDB.php");
					$connessione=new ConnectionDB();
					$connessione->openConnection();
					//info relative a pagine e numero articoli
					if(isset($_GET["code"]) && !empty($_GET["code"])){
						if($_GET["code"]=="success"){
							echo "<div id=\"successcode\"><p>Articolo rimosso";
						}
						if($_GET["code"]=="error"){
							echo "<div id=\"errorcode\"><p>Impossibile rimuovere l'articolo";
						}
						if($_GET["code"]=="failure"){
							echo "<div id=\"errorcode\"><p>L'Articolo non esiste";

						}
						echo "</p></div>";
					}
					$articoli=$connessione->getArticoli();
					$maxpag=connectionDB::getNumPages($articoli);
					$numpag;
					if(isset($_GET["pagina"]) && !empty($_GET["pagina"])){
						$numpag=$_GET["pagina"];
					}
					else $numpag=1;
					if($numpag>$maxpag){
						header("location: ../gestisci_articoli/");
					}
					$articoli = connectionDB::slice($articoli,$numpag-1);
					$connessione->closeConnection();
					if(is_array($articoli) && gettype($articoli[0]) == "object" && get_class($articoli[0]) == "Articolo"){
					?>
						<table class="tableForList">
							<thead>
								<tr>
									<th id="Modifica">Modifica</th>
									<th id="Titolo">Titolo</th>
									<th id="Tipo" class="hideSmall">Tipo</th>
									<th id="DataInizio" class="hideSmall">Data pubblicazione</th>
									<th id="DataFine" class="hideSmall">Data scadenza</th>
									<th id="Prezzo" class="hideSmall">Prezzo</th>
									<th id="Cancella">Cancella</th>
								</tr>
							</thead>
							<tbody>								
									<?php
									foreach ($articoli as $valore) {
                                        if($valore->getTipo()=="0"){
                                            echo "<tr><td header=\"Modifica\"><a href=\"../gestisci_articoli/modifica/".$valore->getId()."\"><em class=\"fas fa-edit\"></em></a></td>";//aggiungere modifica
										    echo "<td header=\"Titolo\"><a href='../gestisci_articoli/visualizza/".$valore->getId()."'>".$valore->getTitolo()."</a></td>";//aggiungere visualizza
                                            echo "<td header=\"Tipo\" class=\"hideSmall\">Offerta</td>";
                                            echo "<td header=\"DataInizio\" class=\"hideSmall\">".$valore->getDataPub()."</td>";
										    echo "<td header=\"DataFine\" class=\"hideSmall\">".$valore->getDataScad()."</td>";
                                            echo "<td header=\"Prezzo\" class=\"hideSmall\">";
                                            if(($valore->getPrezzo()=="0 &euro;")||($valore->getPrezzo()=="0 &euro;/mese")){
                                                echo "GRATIS!";
                                            }else{
                                                echo $valore->getPrezzo();
                                            }
                                            echo "</td>";
										    echo "<td header=\"Cancella\"><a href=\"../gestisci_articoli/elimina/".$valore->getId()."\"><em class=\"fas fa-trash\"></em></a></td></tr>";//aggiungi elimina
                                        }elseif(($valore->getTipo()=="1")&&(!($valore->getPrezzo()=="0"))){
                                            echo "<tr><td header=\"Modifica\"><a href=\"../gestisci_articoli/modifica/".$valore->getId()."\"><em class=\"fas fa-edit\"></em></a></td>";//aggiungere modifica
										    echo "<td header=\"Titolo\"><a href='../gestisci_articoli/visualizza/".$valore->getId()."'>".$valore->getTitolo()."</a></td>";//aggiungere visualizza
                                            echo "<td header=\"Tipo\" class=\"hideSmall\">Servizio</td>";
                                            echo "<td header=\"DataInizio\" class=\"hideSmall\">".$valore->getDataPub()."</td>";
										    echo "<td header=\"DataFine\" class=\"hideSmall\">".$valore->getDataScad()."</td>";
                                            echo "<td header=\"Prezzo\" class=\"hideSmall\">";
                                            if(($valore->getPrezzo()=="0 &euro;")||($valore->getPrezzo()=="0 &euro;/mese")){
                                                echo "GRATIS!";
                                            }else{
                                                echo $valore->getPrezzo();
                                            }
                                            echo "</td>";
										    echo "<td header=\"Cancella\"><a href=\"../gestisci_articoli/elimina/".$valore->getId()."\"><em class=\"fas fa-trash\"></em></a></td></tr>";//aggiungi elimina
                                        }
                                    }
                                    foreach ($articoli as $valore) {
                                        if(($valore->getTipo()=="1")&&($valore->getPrezzo()=="0")){
                                            echo "<tr><td header=\"Modifica\"><a href=\"../gestisci_articoli/modifica/".$valore->getId()."\"><em class=\"fas fa-edit\"></em></a></td>";//aggiungere modifica
										    echo "<td header=\"Titolo\"><a href='../gestisci_articoli/visualizza/".$valore->getId()."'>".$valore->getTitolo()."</a></td>";//aggiungere visualizza
                                            echo "<td header=\"Tipo\" class=\"hideSmall\">Notizia</td>";
                                            echo "<td header=\"DataInizio\" class=\"hideSmall\">".$valore->getDataPub()."</td>";
										    echo "<td header=\"DataFine\" class=\"hideSmall\">".$valore->getDataScad()."</td><td header=\"Prezzo\" class=\"hideSmall\"><span class=\"hidden\">Assente</span></td><td header=\"Cancella\"><a href=\"../gestisci_articoli/elimina/".$valore->getId()."\"><em class=\"fas fa-trash\"></em></a></td></tr>";//aggiungi elimina
                                        }
                                    }
									?>								
							</tbody>						
						</table>
					<?php
					}
					else{
						echo "<p>Nessun Articolo!</p>";
					}
					?>
				</div>
				<div id="pages">
					<p>Pagina <?php
					echo $numpag." di ".$maxpag;
					?></p>
					<?php
					if($numpag>1){
					    echo "<a href=\"../gestisci_articoli/".($numpag-1)."\" alt=\"Pagina precedente\"><em class=\"fas fa-arrow-left\"></em>Indietro</a>";
					}
					if($numpag>1 && $numpag!=$maxpag){
					    echo " - ";
					}
					if($numpag!=$maxpag){
					    echo " <a href=\"../gestisci_articoli/".($numpag+1)."\" alt=\"Pagina successiva\">Avanti<em class=\"fas fa-arrow-right\"></em></a>";
					}
					?>
				</div>
		</div>

<?php include_once("footer.php"); ?>
