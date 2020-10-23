<?php 

/* HEADER CALL */
$pageTitle = "Home";
$pageType = "public";
$pageDescription = "";
$pageKeywords = "";
include_once("header.php");

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
				<p>Ti trovi in: <span xml:lang="en" lang="en"><?php echo $pageTitle; ?></span></p>
			</div>
			
			<div class="row">				
				<div class="col s6 b3">
					  <h2>La nostra storia</h2>
					  <p>Mapple <abbr title="Societ&agrave; a Responsabilit&agrave; Limitata">s.r.l</abbr> nasce nel 2009 come azienda di rivendita di prodotti informatici, dopo qualche anno l&apos;azienda riscuote molto successo per le sue offerte competitive che riuscivano a distinguersi da tutti gli altri <span xml:lang="en" lang="en">competitor</span>, cos&igrave; nel 2015 l&apos;intero <span xml:lang="en" lang="en">team</span> si trasferisce nella nuova sede pi&ugrave; grande offrendo anche servizi di consulenza e creando servizi personalizzati per i clienti in ambito di sviluppo <span xml:lang="en" lang="en">software</span> sia nel lato <span xml:lang="en" lang="en">back-end</span> che <span xml:lang="en" lang="en">front-end</span>. Dal 2018 abbiamo iniziato anche a seguire il settore delle reti offrendo creazioni di reti domestiche e da ufficio di piccola e media dimensione dando anche assistenza in caso di guasto.</p>
				</div>
				<div class="col s6 b3">
					<img  class="imgArticolo" src="../logo/Maxx_Browning_3.png" alt="Immagine Mapple Tech"/>
				</div>
			</div>
		</div>
		
		<?php include_once("footer.php"); ?>
