</div>
</div>
<footer>
	<div class="row">
		<div class="col s6 b2">
			<h3>Dove siamo </h3>
			<p>Via Trieste, 63, 
			35121 Padova PD</p>
		</div>
		<div class="col s6 b2">
			<h3>Orario</h3>
			<p>Luned&iacute;: CHIUSO.<br> Dal Marted&iacute; al Venerd&iacute; dalle 9:00-17:00. <br>Sabato: 9:00-12:30.
		</div>
		<div class="col s6 b2">
			<h3>Team di lavoro</h3>
			<p>Sito web realizzato per il superamento della parte pratica del corso di Tecnologie web della laurea triennale in Informatica.</p>
			<p>Svilupatori:Alessio Lazzaron, Enrico Cancelli, Davide Dinato, Alessandro Pegoraro</p>
		</div>
	</div>
	
	<div class="menuFooter">
	<ul>
		<?php
		if($pageType == "public" || $pageType == "access"){
			if($pageTitle == "Home") echo "<li><a href=\"#\" class=\"active\">HOME</a></li>";
			else echo "<li><a href=\"".$HOMEDIR."/home/\" >Home</a></li>";

			if($pageTitle == "Dove Siamo") echo "<li><a href=\"#\" class=\"active\">DOVE SIAMO</a></li>";
			else echo "<li><a href=\"".$HOMEDIR."/dovesiamo/\" >Dove Siamo</a></li>";

			if($pageTitle == "Contattaci") echo "<li><a href=\"#\" class=\"active\">CONTATTACI</a></li>";
			else echo "<li><a href=\"".$HOMEDIR."/contattaci/\" >Contattaci</a></li>";

			if($pageTitle == "Servizi") echo "<li><a href=\"#\" class=\"active\">SERVIZI</a></li>";
			else echo "<li><a href=\"".$HOMEDIR."/servizi/\" >Servizi</a></li>";

			if($pageTitle == "Login Area Riservata") echo "<li><a href=\"#\" class=\"active\">AREA RISERVATA</a></li>";
			else echo "<li><a href=\"".$HOMEDIR."/areaRiservata/\" >Area Riservata</a></li>";
		}
		if($pageType =="reserved"){
			if($pageTitle == "Home Area riservata") echo "<li><a href=\"#\" class=\"active\">Home</a></li>";
			else echo "<li><a href=\"".$HOMEDIR."/amministrazione/home/\" >Home</a></li>";

			if($pageTitle == "Gestisci Articoli") echo "<li><a href=\"#\" class=\"active\">Gestisci articoli</a></li>";
			else echo "<li><a href=\"".$HOMEDIR."/amministrazione/gestisci_articoli/\" >Gestisci articoli</a></li>";

			if($pageTitle == "Gestisci Utenti") echo "<li><a href=\"#\" class=\"active\">Gestisci Utenti</a></li>";
			else echo "<li><a href=\"".$HOMEDIR."/amministrazione/gestisci_utenti/\" >Gestisci Utenti</a></li>";

			echo "<li><a href=\"".$HOMEDIR."/home/\" >Torna alla parte pubblica</a></li>";
		}
		?>
	</ul>
	<ul>
    <li>
    <a href="http://www.w3.org/html/logo/" title="Certificato HTML5 e CSS3">
		<img class="imgBanner" src="https://www.w3.org/html/logo/badge/html5-badge-h-css3-semantics.png" alt="HTML5 Powered with CSS3 / Styling, and Semantics" title="HTML5 Powered with CSS3 / Styling, and Semantics">
	</a>
    </li>		
	<li>
	<a href="http://jigsaw.w3.org/css-validator/check/referer" title="Certificato di CSS valido">
        <img class="imgBanner" src="http://jigsaw.w3.org/css-validator/images/vcss" alt="CSS Valido!" />
    </a>
    </li>
    <li>
    <a href="https://www.w3.org/WAI/WCAG2AAA-Conformance" title="Certificato WCAG 2.0 Tripla-A">
  		<img class="imgBanner" src="https://www.w3.org/WAI/wcag2AAA" alt="W3C WAI Web Content Accessibility Guidelines 2.0 Tripla A">
	</a>
    </li>
	</ul>
	</div>
</footer>

<script src="<?php echo $HOMEDIR; ?>/js/script.js"></script>
<script src="<?php echo $HOMEDIR; ?>/js/check.js"></script>
<script src="<?php echo $HOMEDIR; ?>/js/mapscript.js"></script>
</body>
</html>
