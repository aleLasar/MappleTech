<?php
/* in caso di errori vengono mostrati qui 
ERROR CODE (prelevati dall'url)
- 1: connessione al db non riuscita
- 2: esecuzione query senza connessione
- 3: query non corretta
- 4: chiusura della connesione al db fallita
*/

$error=explode("?", $_SERVER["REQUEST_URI"]);
if(count($error)){
	$textError="";
	switch ($error[1]){
		case "1" : $textError="Connessione al db non riuscita"; break;
		case "2" : $textError="Esecuzione query senza connessione"; break;
		case "3" : $textError="Query non corretta"; break;
		case "4" : $textError="Chiusura della connesione al db fallita"; break;
	}
	echo "<h1 align='center'>".$textError."</h1>";	
}
else
	header("location:index.php");


?>