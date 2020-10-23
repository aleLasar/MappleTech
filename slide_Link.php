<?php
echo "<div class=\"slideshow-container\">";
include_once("connectionDB.php");
$connessione=new ConnectionDB();
$connessione->openConnection();
    $articolo=$connessione->getArticoliAttivi();
    $numA=0;
    if(is_array($articolo) && gettype($articolo[0]) == "object" && get_class($articolo[0]) == "Articolo"){
        $numA=count($articolo);
    }    
    if($numA>9){
    	$numA=9;
    }
    $iteratoreID=1;
    if(!($numA==0)){
		foreach($articolo as $iteratoreArticolo) if($iteratoreID>$numA){
			break;
		}
		else{
			echo "<div class=\"mySlides fade\">
					<div class=\"numbertext\">".$iteratoreID." / ".$numA."</div>
					<img src=\"../".$iteratoreArticolo->getImmaginePath()."\" alt=\"".$iteratoreArticolo->getTitolo()."\"/>
					<div class=\"text\">
                        <a href=\"../servizi/articolo/".$connessione->getURLFromTitolo($iteratoreArticolo)."\">".$iteratoreArticolo->getDesc()."</a>
					</div>
				</div>";
			$iteratoreID=$iteratoreID+1;
		}		
    }
 $connessione->closeConnection();  
	echo "<a class=\"prev\" onclick=\"plusSlides(-1)\">&#10094;</a>";
    echo "<a class=\"next\" onclick=\"plusSlides(1)\">&#10095;</a>";
    echo "</div>";
?>