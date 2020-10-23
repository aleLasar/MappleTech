<?php

/* HEADER CALL */
$pageTitle = "Servizi";
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
		<div class="noWhitespace">
		<header>
			<div class="showOnPrint"><h1>Mapple Tech</h1></div>
			<div class="hidden"><a href="#content" target="_self">Vai direttamente al contenuto</a></div>
            <noscript>
            	<div class="noScript">
            		<img  class="imgArticolo" src="../logo/logoLungo.png" alt="Immagine Mapple Tech"/>      
            	</div>     
            </noscript>
            <?php include_once("slide_noLink.php"); ?>            
		</header>
		
		<?php include_once("menu.php"); ?>

		<div id="content">
			<div id="breadcumbs">
				<p>Ti trovi in: <span xml:lang="en" lang="en">Home</span> > <?php echo $pageTitle; ?></p>
			</div>
			
			<article id="home">					
  							<?php								
									$articoli=$connessione->getArticoliAttivi();
									$maxpag=connectionDB::getNumPages($articoli);
									$numpag;
									if(isset($_GET["pagina"]) && !empty($_GET["pagina"])){
									    $numpag=$_GET["pagina"];
									}									
									else $numpag=1;
									if($numpag>$maxpag){
									    echo "<div class=\"row\">";
									    echo "<div class=\"col s6 b2\">";
									    echo "<div class=\"serviceCard\">";
									    echo "<h2>";
									    echo "<p>Non sono presenti Articoli</p>";
									    echo "</h2></div></div></div>";
									}else{
									$articoli = connectionDB::slice($articoli,$numpag-1);
									$connessione->closeConnection();
									if(is_array($articoli) && gettype($articoli[0]) == "object" && get_class($articoli[0]) == "Articolo"){
										$colonne=1;
										foreach($articoli as $iteratoreArticolo){
											if($colonne == 1){
												echo "<div class=\"row\">";
											}
											echo "<div class=\"col s6 b2\">";
											echo "<div class=\"serviceCard\">";
											echo "<h2 class=\"centerAlign titoloArticolo\"><a href=\"../servizi/articolo/";
											echo $connessione->getURLFromTitolo($iteratoreArticolo)."\">";
											echo $iteratoreArticolo->getTitolo();
											echo "</a></h2><p class=\"textArticolo\">";
											echo substr($iteratoreArticolo->getTesto(),0,320)."...</p>";
											if($iteratoreArticolo->getTipo()==0){
												if(!($iteratoreArticolo->getPrezzo()=="0 &euro;") && !($iteratoreArticolo->getPrezzo()=="0 &euro;/mese")){
													echo "<p><span class=\"prezzo\"><span class=\"showOnPrint\">Prezzo: </span>";
                                                	echo $iteratoreArticolo->getPrezzo();
                                                	echo "</span><span class=\"tipoArticolo\"><span class=\"showOnPrint\">---Tipologia: </span>Offerta</span></p>";
                                            	}else{
                                                	echo "<p><span class=\"prezzo\"><span class=\"showOnPrint\">Prezzo: </span>GRATIS!</span><span class=\"tipoArticolo\"><span class=\"showOnPrint\">---Tipologia: </span>Offerta</span></p>";
                                            	}
											}else{
												if(!($iteratoreArticolo->getPrezzo()=="0")){
													echo "<p><span class=\"prezzo\"><span class=\"showOnPrint\">Prezzo: </span>";
                                                	echo $iteratoreArticolo->getPrezzo();
                                                	echo "</span><span class=\"tipoArticolo\"><span class=\"showOnPrint\">---Tipologia: </span>Servizio</span></p>";
												}else{
													echo "<p><span class=\"tipoArticolo\"><span class=\"showOnPrint\">Tipologia: </span>Notizia</span></p> ";
												}
											}
											echo "</div></div>";
											if($colonne == 3){
												echo "</div>";
												$colonne=1;
											}else{
												$colonne=$colonne+1;
											}  
										}
										if($colonne != 1){
											echo "</div>";
										}
									}else{
										echo "<div class=\"row\">";
										echo "<div class=\"col s6 b2\">";
										echo "<div class=\"serviceCard\">";
										echo "<h2>";
										echo "<p>Non sono presenti Articoli</p>";
										echo "</h2></div></div></div>";
									}			
  				echo "<div class=\"row\">";	
  				echo "<div id=\"pages\">";
				echo "<p>Pagina "; 
				echo $numpag." di ".$maxpag."</p>";
				if($numpag>1){
					 echo "<a href=\"../servizi/".($numpag-1)."\" alt=\"Pagina precedente\"><i class=\"fas fa-arrow-left\"></i>Indietro</a>";
				}
				if($numpag>1 && $numpag!=$maxpag){
					 echo " - ";
				}
				if($numpag!=$maxpag){
					 echo " <a href=\"../servizi/".($numpag+1)."\" alt=\"Pagina successiva\">Avanti<i class=\"fas fa-arrow-right\"></i></a>";
				}	
				echo "</div>	    
				      </div>";
				}
				?>      
			</article>
		</div>
		<?php include_once("footer.php"); ?>