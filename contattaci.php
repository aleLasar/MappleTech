<?php

/* HEADER CALL */
$pageTitle = "Contattaci";
$pageType = "public";
$pageDescription = "";
$pageKeywords = "";
include_once("header.php");

$error=array();
if(isset($_POST["submit"])){
	if(isset($_POST["nome"]) && !preg_match("/^[a-zA-Z]+$/",$_POST["nome"])){
		array_push($error,"<span class=\"bold\">Nome</span> non valido (no numeri o caratteri speciali consentiti)");
	}
	if(isset($_POST["cognome"]) && !preg_match("/^[a-zA-Z]+$/",$_POST["cognome"])){
		array_push($error,"<span class=\"bold\">Cognome</span> non valido (no numeri o caratteri speciali consentiti)");
	}
	if(isset($_POST["email"]) && trim($_POST["email"])=="" && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
		array_push($error,"<span class=\"bold\">Email</span> non valida");
	}
	if(isset($_POST["richiesta"]) && !preg_match("/^[a-zA-Z]+$/",$_POST["richiesta"])){
		array_push($error,"<span class=\"bold\">Richiesta</span> non valida (no numeri o caratteri speciali consentiti)");
	}
	$queryexecuted=false;
	if(count($error)==0){
	    $message="Salve ".$_POST["nome"]." ".$_POST["cognome"]."\nRiceve questa email in merito alla sua richiesta:\n\"".$_POST["richiesta"]."\"\n\nStiamo lavorando per migliorare la sua esperienza sul sito, se desidera ricevere altre informazioni non esiti a scriverci a questo indirizzo mail.\nDistinsi Saluti\nIl team Maplle s.r.l.";
	    $message=wordwrap($message,70);
	    error_reporting(E_ALL ^ E_WARNING);//Dato che non è possibile inviare mail dal server universitario un warning sara sempre presente, quindi per evitare problemi di sicurezza
	    if(mail($_POST["email"],"Richiesta informazioni Mapple s.r.l.",$msg)){
	       $queryexecuted=true;
	    }
	}
}

?>
<body>
	<div id="container">
	<div class="noWhitespace">
		<header>
			<div class="showOnPrint"><h1>Mapple Tech</h1></div>
			<div class="hidden"><a href="#content" target="_self">Vai direttamente al contenuto</a></div>
			<noscript>
            <div class="noScript">
            	<img  class="imgArticolo" src="../logo/logoLungo.png" alt="Immagine Mapple Tech"/>       
            </div>     
            </noscript>
            <?php include_once("slide_Link.php"); ?> 
		</header>
		
		<?php include_once("menu.php"); ?>

		<div id="content">
			<div id="breadcumbs">
				<p>Ti trovi in: <span xml:lang="en" lang="en">Home</span> > Contattaci</p>
			</div>
			
			<article id="home">
				<h2 class="centerAlign spaceTop">Contattaci</h2>
				<div class="row">
					<form id="formContatti" method="post" onsubmit="return checkContatti()">
						<fieldset>
							<legend>Richiedi informazioni</legend>
							<?php 
								
								for($i=0;$i<count($error);$i++){
									echo "<div class=\"errorcode\"><p>";
									echo $error[$i];
									echo "</p></div>";
								}
							
							if(isset($queryexecuted) && $queryexecuted==true){
								echo "<div id=\"successcode\">Richiesta inviata!</div>";
							}
							?>
							<div class="col s6 b3 centerAlign">
								
								<div class="form-group">
									<label for="nome">Nome</label>
									<input type="text" id="nome" name="nome" placeholder="nome .." <?php
									if(isset($_POST["nome"]) && !empty($_POST["nome"]) && $queryexecuted==false){
										echo "value=\"".$_POST["nome"]."\"";
									}
									?>/>
									
								</div>
								<div class="form-group">
									<label for="cognome">Cognome</label>
									<input type="text" id="cognome" name="cognome" placeholder="cognome .." <?php
									if(isset($_POST["cognome"]) && !empty($_POST["cognome"]) && $queryexecuted==false){
										echo "value=\"".$_POST["cognome"]."\"";
									}
									?>/>
									
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" id="email" name="email" placeholder="email@email.esempio" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" <?php
									if(isset($_POST["email"]) && !empty($_POST["email"]) && $queryexecuted==false){
										echo "value=\"".$_POST["email"]."\"";
									}
									?>/>
									
								</div>
								
									
							</div>
							<div class="col s6 b3 centerAlign">
								<div class="form-group">
									<label for="richiesta">Richiesta</label> 
									<textarea name="richiesta" id="richiesta" placeholder="richiesta .."><?php
									if(isset($_POST["richiesta"]) && !empty($_POST["richiesta"]) && $queryexecuted==false){
										echo $_POST["richiesta"];
									}
									?></textarea>
									
								</div>
								<div class="form-group">
									<input type="submit" name="submit" value="Invia richiesta!" />
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</article>
		</div>
		<?php include_once("footer.php"); ?>