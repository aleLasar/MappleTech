<?php 

/* HEADER CALL */
$pageTitle = "Dove Siamo";
$pageType = "public";
$pageDescription = "";
$pageKeywords = "";
include_once("header.php");

?>
<body onload="showMap()">
	<div id="container">
	<div class="noWhitespace">
		<header>
			<div class="showOnPrint"><h1>Mapple Tech</h1></div>		
			<div class="hidden"><a href="#content" target="_self">Vai direttamente al contenuto</a></div>
			<noscript>
            <div class="noScript">
            	<img class="imgArticolo" src="../logo/logoLungo.png" alt="Immagine Mapple Tech"/>  
            </div>     
            </noscript>
            <?php include_once("slide_Link.php"); ?> 
		</header>
		
		<?php include_once("menu.php"); ?>

		<div id="content">
			<div id="breadcumbs">
				<p>Ti trovi in: <span xml:lang="en" lang="en">Home</span> > <?php echo $pageTitle; ?></p>
			</div>

			<h2 class="centerAlign spaceTop">Indirizzo</h2>
			<div class="row ">
				<div class="col s6 b2 middleAlign centerAlign">
				<h3>Mapple s.r.l</h3>
					<p>Ci puoi trovare in Via Trieste, 63, 35121 Padova PD </p>
				</div>
				<div  id="mappa" class="col s6 b4">
					<p class='hidePrint'>Mappa:</p>
					<noscript>
					<div class="noScript">
            			<img class="imgArticolo" src="../logo/mappa-azienda.jpg" alt="Mappa statica di via Trieste 63, Padova"/>  
            		</div>  
            		</noscript>
					<iframe id="maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2800.904294564186!2d11.886228053069564!3d45.41126946836576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x477eda58b44676df%3A0xfacae5884fca17f5!2sTorre+Archimede%2C+Via+Trieste%2C+63%2C+35121+Padova+PD!5e0!3m2!1sit!2sit!4v1546527499537" allowfullscreen></iframe>
				</div>
			</div>
			<h2 class="centerAlign ">Orari</h2>
			<div class="row ">		
					<div class="col s6 b3 centerAlign">
						<div id="imgOrariDoveSiamo" class="middleAlign centerAlign imgParallax"></div>
					</div>			
				<div class="col s6 b3">
					<p>
						Orari di apertura:
					</p>
					<ul class="orarioApertura ">
						<li>Lunedì CHIUSO</li>
						<li>Martedì 9:00 - 17:00</li>
						<li>Mercoledì 9:00 - 17:00</li>
						<li>Giovedì 9:00	 - 17:00</li>
						<li>Venerdì 9:00 - 17:00</li>
						<li>Sabato 9:00 - 12:00</li>
					</ul>
				</div>

			</div>
		</div>
		
		<?php include_once("footer.php"); ?>