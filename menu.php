<?php

echo "<nav class=\"topnav Firstresponsive\" id=\"firstNavbar\">";
echo "<span><img src=\"".$HOMEDIR."/logo/logoLungo.png\" alt=\"Logo Mapple Tech\" id=\"LogoOnMenu\"/></span>";
if($pageType == "public" || $pageType == "access"){
	if($pageTitle == "Home") echo "<a href=\"#\" class=\"active\">Home</a>";
	else echo "<a href=\"".$HOMEDIR."/home/\" >Home</a>";

	if($pageTitle == "Dove Siamo") echo "<a href=\"#\" class=\"active\">Dove Siamo</a>";
	else echo "<a href=\"".$HOMEDIR."/dovesiamo/\" >Dove Siamo</a>";

	if($pageTitle == "Contattaci") echo "<a href=\"#\" class=\"active\">Contattaci</a>";
	else echo "<a href=\"".$HOMEDIR."/contattaci/\" >Contattaci</a>";

	if($pageTitle == "Servizi") echo "<a href=\"#\" class=\"active\">Servizi</a>";
	else echo "<a href=\"".$HOMEDIR."/servizi/\" >Servizi</a>";

	if($pageTitle == "Login Area Riservata") echo "<a href=\"#\" class=\"active\">Area Riservata</a>";
	else echo "<a href=\"".$HOMEDIR."/areaRiservata/\" >Area Riservata</a>";
}
if($pageType =="reserved"){
	if($pageTitle == "Home Area riservata") echo "<a href=\"#\" class=\"active\">Home</a>";
	else echo "<a href=\"".$HOMEDIR."/amministrazione/home/\" >Home</a>";

	if($pageTitle == "Gestisci Articoli") echo "<a href=\"#\" class=\"active\">Gestisci articoli</a>";
	else echo "<a href=\"".$HOMEDIR."/amministrazione/gestisci_articoli/\" >Gestisci articoli</a>";

	if($pageTitle == "Gestisci Utenti") echo "<a href=\"#\" class=\"active\">Gestisci Utenti</a>";
	else echo "<a href=\"".$HOMEDIR."/amministrazione/gestisci_utenti/\" >Gestisci Utenti</a>";
}
echo "
	<a href=\"javascript:void(0);\" class=\"icon\" onclick=\"navbarActionOpenClose()\">
		<em class=\"fa fa-bars\"></em>
	</a>
";
echo "</nav>";
if(isset($_SESSION) && !empty($_SESSION["user"])){
	echo "<div id=\"userbox\"><p>Loggato come: ".$_SESSION["user"]."</p>";
	echo "<a href=\"".$HOMEDIR."/logout/\">Logout</a></div>";
}
?>
