<?php
echo "<div class=\"slideshow-container\">"; 
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
                    echo "<div class=\"mySlides fade\"><div class=\"numbertext\">";
                        echo $iteratoreID; $iteratoreID=$iteratoreID+1;
                    echo " / ";
                        echo $numA; 
                    echo "</div><img src=\"../";
                            echo $iteratoreArticolo->getImmaginePath();
                    echo "\" alt=\"";
                            echo $iteratoreArticolo->getTitolo();
                    echo "\"/><div class=\"text\">";
							echo $iteratoreArticolo->getDesc();
                    echo "</div></div>";
		}		
    }
	echo "<a class=\"prev\" onclick=\"plusSlides(-1)\">&#10094;</a>";
    echo "<a class=\"next\" onclick=\"plusSlides(1)\">&#10095;</a>";
    echo "</div>";
?>