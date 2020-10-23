<?php
include_once("connectionDB.php");
$pageType = "reserved";
$pageDescription = "";
$pageKeywords = "";
if((isset($_POST["submit"]) && $_POST["submit"]=="Modifica articolo") || (isset($_GET["id"]) && !empty($_GET["id"]))){
	$pageTitle = "Modifica articoli";
}
else{
	$pageTitle = "Creazione articoli";
}
include_once("header.php");
if(isset($_GET["id"]) && !empty($_GET["id"])){
	$getarticolo=new ConnectionDB();
	$getarticolo->openConnection();
	$oldarticolo=$getarticolo->getArticolo($_GET["id"]);
	$getarticolo->closeConnection();
	$_SESSION["idart"]=$oldarticolo->getId();
}

$error=array();
if(isset($_POST["submit"])){
	$connessione=new ConnectionDB();
	$connessione->openConnection();
	//da inserire controllo in javascript
	//se javascript attivo, saltare controllo lato server
	if(isset($_POST["titolo"]) && trim($_POST["titolo"])==""){
		$error[count($error)]="Titolo non valido";
	}
	if(isset($_POST["des"]) && trim($_POST["des"])==""){
		$error[count($error)]="Descrizione non valida";
	}
	if(isset($_POST["tipo"]) && $_POST["tipo"]!="servizio" && $_POST["tipo"]!="offerta" && $_POST["tipo"]!="notizia"){
		$error[count($error)]="Tipo non valido";
	}
	if(isset($_POST["iday"]) && isset($_POST["fday"])){
		$cstamp=strtotime(date("Y-m-d"));
		$istamp=strtotime($_POST["iday"]);
		$fstamp=strtotime($_POST["fday"]);
		if(empty($_POST["iday"])){
			$error[count($error)]="Data di inizio mancante";
		}
		elseif($istamp<$cstamp && $_POST["submit"]=="Aggiungi articolo"){
			$error[count($error)]="Data di inizio gi&agrave; passata";
		}
		if(empty($_POST["fday"])){
			$error[count($error)]="Data di fine mancante";
		}
		elseif($fstamp<$cstamp){
			$error[count($error)]="Data di fine gi&agrave; passata";
		}
		if(!empty($_POST["iday"]) && !empty($_POST["fday"])){
			if($istamp>=$cstamp && $fstamp>=$cstamp && $istamp>$fstamp){
				$error[count($error)]="Date incompatibili";
			}
		}
	}
	if(isset($_POST["testo"]) && trim($_POST["testo"])==""){
		$error[count($error)]="Testo non valido";
	}
	if(isset($_POST["prezzo"]) && ($_POST["prezzo"]<0 || $_POST["prezzo"]>9999)){
		array_push($error,"Valore prezzo non valido");
	}
	if(isset($_POST["tipoprezzo"]) && $_POST["tipoprezzo"]!="fisso" && $_POST["tipoprezzo"]!="mese"){
		array_push($error,"Tipo di tariffa non valido");
	}
	//upload file
	if(isset($_FILES["immagine"]) && !empty($_FILES["immagine"]["name"])){
		//caricamento img
		if(empty($error)){
			$uploaderr=$connessione->uploadImage();
			$error=array_merge($error,$uploaderr);
			$image=$_FILES["immagine"]["name"];
		}
	}
	else if(isset($_FILES["immagine"]) && $pageTitle=="Modifica articoli"){
		$image="";
	}
	else array_push($error,"Immagine mancante");

	$queryexecuted=false;
	if(count($error)==0){
		$prezzostamp;
		$type;		
		$_POST["titolo"]=strip_tags($_POST["titolo"]);
		$_POST["titolo"]=htmlentities($_POST["titolo"]);
		$_POST["des"]=strip_tags($_POST["des"]);
		$_POST["des"]=htmlentities($_POST["des"]);
		$_POST["testo"]=strip_tags($_POST["testo"]);
		$_POST["testo"]=htmlentities($_POST["testo"]);
		if($_POST["tipoprezzo"]=="fisso"){
		    if(empty($_POST["prezzo"])){
		        $prezzostamp="0 &euro;";
		    }else{
		        $prezzostamp=$_POST["prezzo"]." &euro;";
		    }
		}
		else{
		    if(empty($_POST["prezzo"])){
		        $prezzostamp="0 &euro;/mese";
		    }else{
		        $prezzostamp=$_POST["prezzo"]." &euro;/mese";
		    }
        }
        if($_POST["tipo"]=="notizia"){
            $prezzostamp="0";
        }
		if($_POST["tipo"]=="offerta"){
			$type=0;
		}
		else{
			$type=1;
		}
		include_once("suportClass.php");
		if(isset($_SESSION["idart"])){
			$articolo=new Articolo($_POST["titolo"],$_POST["des"],$_POST["testo"],$type,$_POST["iday"],$_POST["fday"],$prezzostamp,$image,$_SESSION["idart"]);
			if(!$queryexecuted=$connessione->updateArticolo($articolo)){
				array_push($error,"Aggiornamento fallito");
			}
			else{
				unset($_SESSION["idart"]);
				header("Location: ../");
			}
		}
		else{
			$articolo=new Articolo($_POST["titolo"],$_POST["des"],$_POST["testo"],$type,$_POST["iday"],$_POST["fday"],$prezzostamp,$image);
			$queryexecuted=$connessione->insertArticolo($articolo);
		}
	}
	$connessione->closeConnection();
}

?>
<body>
	<div id="container">
				
		<?php include_once("menu.php"); ?>

		<div id="content">
		<div class="noWhitespace">
			<div id="breadcumbs">
				<p>Ti trovi in: Area Riservata > <?php echo $pageTitle;?></p>
			</div>
			<h2 class="centerAlign spaceTop"><?php echo $pageTitle;?></h2>
				<div class="row">
					<form id="formArticolo" method="post" <?php
					if($pageTitle=="Modifica articoli"){
						echo "action=\"../modifica/\"";
					}
					else{
						echo "action=\"../nuovo/\"";
					}
					?> enctype="multipart/form-data" onsubmit="return checkArticoli()">
						<fieldset>
							<legend>Inserisci i dati</legend>
							<?php 
								for($i=0;$i<count($error);$i++){
									echo "<div class=\"errorcode\"><p>";
									echo $error[$i];
									echo "</p></div>";
								}
							if(isset($queryexecuted) && $queryexecuted==true){
								echo "<div id=\"successcode\"><p>Articolo Inserito</p></div>";
							}
							?>
							<div class="col s6 b3 centerAlign">
								
								<div class="form-group">
									<label for="titolo">Titolo</label>
									<input type="text" maxlength="50" id="titolo" name="titolo" placeholder="Titolo..." <?php
									if(isset($oldarticolo)){
										echo "value=\"".$oldarticolo->getTitolo()."\"";
									}
									if(isset($_POST["titolo"]) && !empty($_POST["titolo"]) && $queryexecuted==false){
										echo "value=\"".$_POST["titolo"]."\"";
									}
									?>/>
									
								</div>
								<div class="form-group">
									<label for="des">Descrizione</label>
									<textarea name="des" rows="2" cols="40" maxlength="80" id="des" placeholder="Descrizione..." ><?php
									if(isset($oldarticolo)){
										echo $oldarticolo->getDesc();
									}
									if(isset($_POST["des"]) && !empty($_POST["des"]) && $queryexecuted==false){
										echo $_POST["des"];
									}
									?></textarea>
									
								</div>
								<div class="form-group">
									<label for="tipo">Tipo</label><br/>
									<select name="tipo" id="tipo">
										<?php
										$ref;
										if(isset($oldarticolo)){
											$ref=$oldarticolo->getTipoString();
										}
										if(isset($_POST["tipo"]) && !empty($_POST["tipo"]) && $queryexecuted==false){
											$ref=$_POST["tipo"];
										}
										if(empty($ref)){
											echo "<option value=\"servizio\">Servizio</option>
											<option value=\"offerta\">Offerta</option>
                                        	<option value=\"notizia\">Notizia</option>";
										}
										else{
											echo str_replace($ref."\"",$ref."\" selected=\"selected\"","<option value=\"servizio\">Servizio</option>
											<option value=\"offerta\">Offerta</option>
                                        	<option value=\"notizia\">Notizia</option>");
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="iday">Data di Inizio</label>
									<input type="date" name="iday" id="iday" <?php
									if(isset($oldarticolo)){
										echo "value=\"".$oldarticolo->getDataPub()."\"";
									}
									if(isset($_POST["iday"]) && !empty($_POST["iday"]) && $queryexecuted==false){
										echo "value=\"".$_POST["iday"]."\"";
									}
									?>/>
								</div>
								<div class="form-group">
									<label for="fday">Data di Fine</label>
									<input type="date" name="fday" id="fday" <?php
									if(isset($oldarticolo)){
										echo "value=\"".$oldarticolo->getDataScad()."\"";
									}
									if(isset($_POST["fday"]) && !empty($_POST["fday"]) && $queryexecuted==false){
										echo "value=\"".$_POST["fday"]."\"";
									}
									?>/>
								</div>	
							</div>
							<div class="col s6 b3 centerAlign">
								<div class="form-group">
									<label for="testo">Testo</label> 
									<textarea name="testo" id="testo" placeholder="Testo..."><?php
									if(isset($oldarticolo)){
										echo $oldarticolo->getTesto();
									}
									if(isset($_POST["testo"]) && !empty($_POST["testo"]) && $queryexecuted==false){
										echo $_POST["testo"];
									}
									?></textarea>
								</div>
								<div class="form-group">
									<label for="prezzo">Prezzo in &euro;</label>
									<p class="inputRule">Prezzo max: 9999 &euro;</p>
                                    <p class="inputRule">Se vuoi inserire una Notizia lascia il prezzo a 0</p>
									<input type="number" id="prezzo" name="prezzo" min="0" max="9999"
									<?php
									if(isset($oldarticolo)){
										echo " value=\"".$oldarticolo->getPrezzoVal()."\"";
									}else{
									if(isset($_POST["prezzo"]) && !empty($_POST["prezzo"]) && $queryexecuted==false){
										echo " value=\"".$_POST["prezzo"]."\"";
									}
									if(!isset($_POST["submit"]) && !isset($_PRE["id"])){
										echo " value=\"0\"";
									} 
									}
									?>
									/>
								</div>
								<div class="form-group">
									<label for="tipoprezzo">Tipo di tariffa</label>
									<select name="tipoprezzo" id="tipoprezzo">
										<?php
										$refp;
										if(isset($oldarticolo)){
											$refp=$oldarticolo->getPrezzoTipo();
										}
										if(isset($_POST["tipoprezzo"]) && !empty($_POST["tipoprezzo"]) && $queryexecuted==false){
											$refp=$_POST["tipoprezzo"];
										}
										if(empty($refp)){
											echo "<option value=\"fisso\">Fisso</option>
											<option value=\"mese\">Al Mese</option>";
										}
										else{
											echo str_replace($refp."\"",$refp."\" selected=\"selected\"","<option value=\"fisso\">Fisso</option>
											<option value=\"mese\">Al Mese</option>");
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="immagine">Immagine</label>
									<p class="inputRule">File supportati: jpeg, png</p>
									<p>Dimensioni massime: 5Mb</p>
									<input type="file" id="immagine" name="immagine" accept="image/png, image/jpeg, image/gif, image/jpg"/>
								</div>
								<div class="form-group">
									<input type="submit" name="submit" <?php
									if($pageTitle=="Modifica articoli"){
										echo "value=\"Modifica articolo\"";
									}
									else echo "value=\"Aggiungi articolo\"";
									 ?>
									 />
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			
		</div>
		
		<?php include_once("footer.php"); ?>
