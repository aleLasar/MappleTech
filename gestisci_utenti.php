<?php

$pageTitle = "Gestisci Utenti";
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
					<p><a href="../gestisci_utenti/nuovo/" title="aggiungi nuovo utente"><em class="fas fa-user-plus"></em> Aggiungi Utente</a></p>
					<?php
					if(isset($_GET['queryexecuted']) && !empty($_GET['queryexecuted'])){
						if($_GET['queryexecuted']=='true'){
							echo "<div id=\"successcode\"><p>Aggiornato correttamente!</p></div>";
						}
						else{
							switch($_GET['motivo']){
								case "user_not_exist" : $motivo = "Utente non presente nel DB"; break;
								case "links" : $motivo = "Impossibile accedere! Link non valido"; break; 
								case "user_query" : $motivo = "Utente non eliminato! Errore nell'esecuzione della query"; break;
								case "hacker" : $motivo = "Accesso negato o parametri non presenti, non fare il furbo!"; break;
								default : $motivo = "errore generico";
							}
							
							echo "<div id=\"errorcode\"><p>Errore: $motivo</p></div>";
						}
					}
					
					
					include_once("connectionDB.php");
					$connessione=new ConnectionDB();
					$connessione->openConnection();
					//recupero gli utenti
					$utenti = $connessione->getUtenti();
					$connessione->closeConnection();
					if(is_array($utenti) && gettype($utenti[0]) == "object" && get_class($utenti[0]) == "Utente"){
						//serve per capire se è un oggetto utente o ha restituito 0 (errore)
					?>
						<table class="tableForList">
							<thead>
								<tr>
									<th id="Modifica">Modifica</th>
									<th id="Nome" class="hideSmall">Nome</th>
									<th id="Cognome" class="hideSmall">Cognome</th>
									<th id="Telefono" class="hideSmall">Telefono</th>
									<th id="Email">Email</th>
									<th id="Cancella">Cancella</th>
								</tr>
							</thead>
							<tbody>
									<?php
									//stampo gli utenti
									foreach ($utenti as $valore) {
										echo "<tr><td header=\"Modifica\">";
										if($_SESSION["id"]==1 || $_SESSION["id"]==$valore->getId()){
											echo "<a href=\"../gestisci_utenti/modifica/".$valore->getEmail()."\"><em class=\"fas fa-user-edit\"></em></a>";
										}else{
										    echo "<span class=\"hidden\">Funzione disabilitata</span>";
										}
										echo "</td>";
										echo "<td header=\"Nome\" class=\"hideSmall\">".$valore->getNome()."</td>";
										echo "<td header=\"Cognome\" class=\"hideSmall\">".$valore->getCognome()."</td>";
										echo "<td header=\"Telefono\" class=\"hideSmall\">".$valore->getTelefono()."</td>";
										echo "<td header=\"Email\">".$valore->getEmail()."</td>";
										echo "<td header=\"Cancella\">";
										if($valore->getId()!=1 && ($_SESSION["id"]==1 || $_SESSION["id"]==$valore->getId())){
											echo "<a href=\"../gestisci_utenti/elimina/".$valore->getEmail()."\"><em class=\"fas fa-user-times\"></em></a>";
										}else{
										    echo "<span class=\"hidden\">Funzione disabilitata</span>";
										}
										echo "</td></tr>";
									}
									?>
								
							</tbody>
						</table>
					<?php
					}
					else{
						echo "<p>Nessun utente!</p>";
					}
					?>
				</div>
		</div>

<?php include_once("footer.php"); ?>
