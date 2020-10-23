<?php
/*
-classe che gestisce la connesione al DB
-qualsiasi richiesta viene fatta da questa classe
*/
include_once "suportClass.php";
class ConnectionDB{
	
	const HOST_DB = 'localhost';
	const USER = 'apegorar';
	const PASSWD = 'eihahk4eukeek2Ah';
	const DATABASE = 'apegorar';

	const SLIDE_DIR ='uploads/';

	const SLICEDIM=12;
	private $connection;
	
	
	/*metodo per gestire errori
	INPUT: int con codice errore
	OUTPUT: manda alla pagina per mostrare gli errori e termina processo */	
	private function throwError($code){
		$path = pathinfo($_SERVER['PHP_SELF']);
		header("Location: ".$path['dirname']."/errorPage.php?".$code);
		die();
	}
	
	/*esegue la query
	INPUT: query in froma di stringa
	OUTPUT: ritorna un mysqli_result object.*/	
	public function doQuery(&$query){
		if($this->connection){
			try{
				return $query->execute();
			}
			catch(PDOException $e){
				$e->getMessage();
			}
		}
		else
			$this->throwError(2);
			
		
	}
	
	/*crea connessione con il dba_close
	OUTPUT: in caso positivo=true	*/
	public function openConnection(){
		# gestione delle eccezioni in fase di connessione con PDO

		// collegamento al database
		$this->connection = 'mysql:host='.static::HOST_DB.';dbname='.static::DATABASE;

		// blocco try per il lancio dell'istruzione
		try {
			// connessione tramite creazione di un oggetto PDO
			$this->db = new PDO($this->connection , static::USER, static::PASSWD);
		}
		// blocco catch per la gestione delle eccezioni
		catch(PDOException $e) {
			// notifica in caso di errorre
			echo 'Attenzione: '.$e->getMessage();
			$this->throwError(1);
		}
		return true;
	}
	/*chiude la connesione al dba_exists
	OUTPUT: se la connesione esiste return TRUE se chiusura db avvenuto, FALSE altrimenti,
			se non esiste una connesione viene laciato un errore 	
	*/
	public function closeConnection(){
		if($this->connection){
			$this->connection=null;
			return true;
		}
		else
			$this->throwError(4);
	}
	
	/*inserisce un articolo
	INPUT: oggetto di tipo Articolo
	OUTPUT: true se operazione avvenuta con successo */
	public function insertArticolo($articolo){
		$query="insert into articoli (testo, titolo,descrizione,tipo,dataPubblicazione,dataScadenza,prezzo,immagine)values (:testo,:titolo,:descrizione,:tipo,:dataPubblicazione,:dataScadenza,:prezzo,:immagine)";
		$sql = $this->db->prepare($query);
		$sql->bindValue(":testo",$articolo->getTesto(),PDO::PARAM_STR);
		$sql->bindValue(":titolo",$articolo->getTitolo(),PDO::PARAM_STR);
		$sql->bindValue(":descrizione",$articolo->getDesc(),PDO::PARAM_STR);
		$sql->bindValue(":tipo",$articolo->getTipo(),PDO::PARAM_STR);
		$sql->bindValue(":dataPubblicazione",$articolo->getDataPub(),PDO::PARAM_STR);
        $sql->bindValue(":dataScadenza",$articolo->getDataScad(),PDO::PARAM_STR);
        $sql->bindValue(":prezzo",$articolo->getPrezzo(),PDO::PARAM_STR);
		$sql->bindValue(":immagine",static::SLIDE_DIR.$articolo->getImmaginePath(),PDO::PARAM_STR);
		$this->doQuery($sql);
		$this->createSitemap();
		return true;
	}
	
	/*inserisce un utente
	INPUT: oggetto di tipo Utente
	OUTPUT: true se operazione avvenuta con successo */
	public function insertUtente($utente){
		$query="insert into utenti (nome,cognome,telefono, `password`,email) VALUES ( :nome,:cognome,:telefono,:password,:email)";
		$sql = $this->db->prepare($query);
		$sql->bindValue(":nome",$utente->getNome(),PDO::PARAM_STR);
		$sql->bindValue(":cognome",$utente->getCognome(),PDO::PARAM_STR);
		$sql->bindValue(":telefono",$utente->getTelefono(),PDO::PARAM_STR);
		$sql->bindValue(":password",$utente->getPassword(),PDO::PARAM_STR);
		$sql->bindValue(":email",$utente->getEmail(),PDO::PARAM_STR);
		//$sql->debugDumpParams();
		$this->doQuery($sql);
		return true;
	}
	
	/*ritorna tutte le offerte 
	INPUT: 1 offerte scadute, 0 offerte valide
	OUTPUT: array di oggetti Articoli 
	*/	
	public function getArticoliAttivi(){
		$query="select * from articoli order by id desc";
		$ris = $this->db->prepare($query);
		$this->doQuery($ris);
		if($ris->rowCount()<=0)
			return 0;
		else{
			$offArrayValide=array();
			while($row=$ris->fetch(PDO::FETCH_ASSOC)){
				$offerta=new Articolo($row["titolo"],$row["descrizione"],$row["testo"],$row["tipo"],$row["dataPubblicazione"], $row["dataScadenza"], $row["prezzo"], $row["immagine"],$row["id"]);					
				if(strtotime($row["dataScadenza"])>=strtotime(date("Y-m-d")))
					array_push($offArrayValide,$offerta);
			}
			return $offArrayValide;
		}		
	}
	
	/*aggiorna TUTTI i campi di un utente
	INOUT: oggetto di tipo utente con id
	OUTPUT: se query eseguita correttamente allora true	*/
	public function updateUtente($utente){
		$query="update utenti set nome=:nome, cognome=:cognome, telefono=:telefono, password=:password, email=:email where idUtente=".$utente->getId();
		//echo $query;
		$sql = $this->db->prepare($query);
		$sql->bindValue(":nome",$utente->getNome(),PDO::PARAM_STR);
		$sql->bindValue(":cognome",$utente->getCognome(),PDO::PARAM_STR);
		$sql->bindValue(":telefono",$utente->getTelefono(),PDO::PARAM_STR);
		$sql->bindValue(":password",$utente->getPassword(),PDO::PARAM_STR);
		$sql->bindValue(":email",$utente->getEmail(),PDO::PARAM_STR);
		$this->doQuery($sql);
		return true;
	}
	
	/*aggiorna TUTTI i campi di un articolo
	INOUT: oggetto di tipo articolo con id
	OUTPUT: se query eseguita correttamente allora true	*/
	public function updateArticolo($articolo){
		//inserire cancellazione
		if($articolo->getImmaginePath()==""){
			$query="update articoli set testo=:testo, titolo=:titolo, descrizione=:descrizione, tipo=:tipo, dataPubblicazione=:dataPubblicazione, dataScadenza=:dataScadenza, prezzo=:prezzo where id=".$articolo->getId();
			$sql = $this->db->prepare($query);
		}
		else{
			if(!unlink($this->getArticolo($articolo->getId())->getImmaginePath())) return false;
			$query="update articoli set testo=:testo, titolo=:titolo, descrizione=:descrizione, tipo=:tipo, dataPubblicazione=:dataPubblicazione, dataScadenza=:dataScadenza, prezzo=:prezzo, immagine=:immagine where id=".$articolo->getId();
			$sql = $this->db->prepare($query);
			$sql->bindValue(":immagine",static::SLIDE_DIR.$articolo->getImmaginePath(),PDO::PARAM_STR);
		}
		
		$sql->bindValue(":testo",$articolo->getTesto(),PDO::PARAM_STR);
		$sql->bindValue(":titolo",$articolo->getTitolo(),PDO::PARAM_STR);
		$sql->bindValue(":descrizione",$articolo->getDesc(),PDO::PARAM_STR);
		$sql->bindValue(":tipo",$articolo->getTipo(),PDO::PARAM_STR);
		$sql->bindValue(":dataPubblicazione",$articolo->getDataPub(),PDO::PARAM_STR);
        $sql->bindValue(":dataScadenza",$articolo->getDataScad(),PDO::PARAM_STR);
        $sql->bindValue(":prezzo",$articolo->getPrezzo(),PDO::PARAM_STR);
		$this->doQuery($sql);
		$this->createSitemap();
		return true;
	}
	
	/*ritorna la lista degli utenti nel db
	OUTPUT: array di oggetti Utente
	*/	
	public function getUtenti(){
		$query="select * from utenti";
		$ris = $this->db->prepare($query);
		$this->doQuery($ris);
		if($ris->rowCount() <= 0){
			return 0;
		}
		$arrayUtenti=array();
		while($row=$ris->fetch(PDO::FETCH_ASSOC)){
			$utente=new Utente($row["nome"], $row["cognome"], $row["email"],$row["password"], $row["telefono"],$row["idUtente"]);
			array_push($arrayUtenti,$utente);
		}
		return $arrayUtenti;
	}
	
	/*ritorna i dati di un utente dal db
	INPUT: email
	OUTPUT: array di oggetti Utente
	*/	
	public function getUtente($email){
		$query="select * from utenti where email=:email";
		$sql = $this->db->prepare($query);
		$sql->bindValue(":email",$email,PDO::PARAM_STR);
		
		$this->doQuery($sql);
		
		if($sql->rowCount() <= 0){
			return 0;
		}
		
		$row = $sql->fetch(PDO::FETCH_ASSOC);
		$utente=new Utente($row["nome"], $row["cognome"], $row["email"],$row["password"], $row["telefono"],$row["idUtente"]);
		
		return $utente;
	}
	
	/*ritorna i dati di un articolo dal db
	INPUT: id
	OUTPUT: array di oggetti Articolo
	*/	
	public function getArticolo($id){
		$query="select * from articoli where id=:id";
		$sql = $this->db->prepare($query);
		$sql->bindValue(":id",$id,PDO::PARAM_INT);
		
		$this->doQuery($sql);
		
		if($sql->rowCount() <= 0){
			return 0;
		}
		
		$row = $sql->fetch(PDO::FETCH_ASSOC);
		$articolo=new Articolo($row["titolo"], $row["descrizione"], $row["testo"], $row["tipo"], $row["dataPubblicazione"], $row["dataScadenza"], $row["prezzo"], $row["immagine"], $row["id"]);
		return $articolo;
	}
	
	/*ritorna la lista degli oggetti articolo da database*/
	public function getArticoli(){
		$out=array();
		$query = "select * from articoli";
		$mydb = $this->db->prepare($query);
		$this->doQuery($mydb);
		if($mydb->rowCount()<=0){
			return 0;
		}
		while($row=$mydb->fetch(PDO::FETCH_ASSOC)){
			array_push($out,new Articolo($row["titolo"], $row["descrizione"], $row["testo"], $row["tipo"], $row["dataPubblicazione"], $row["dataScadenza"], $row["prezzo"], $row["immagine"], $row["id"]));
		}
		return $out;
	}

	public static function slice($array,$page){
		if(!is_array($array)) return 0;
		return array_slice($array,$page*static::SLICEDIM,static::SLICEDIM);
	}

	public static function getNumPages($array){
		if(!is_array($array)) return 1;
		return ceil(count($array)/static::SLICEDIM);
	}

	/*elimina un articolo/servizio
	INPUT: oggetto di tipo articolo con id
	OUTPUT: se query eseguita correttamente allora true	*/
	public function deleteArticolo($articolo){
		if(!unlink($articolo->getImmaginePath())){
			return false;
		}
		$query="delete from articoli where id=".$articolo->getId();
		$ris = $this->db->prepare($query);
		$this->doQuery($ris);
		$this->createSitemap();
		return true;
	}
	
	/*elimina un utente
	INPUT: oggetto di tipo utente con id
	OUTPUT: se query eseguita correttamente allora true	*/
	public function deleteUtente($utente){
		$query="delete from utenti where idUtente=".$utente->getId();
		$ris = $this->db->prepare($query);
		$this->doQuery($ris);
		return true;
	}
	
	/*crea un url univoco in base all'articolo
	INPUT: oggetto di tipo articolo
	OUTPUT: stringa in UTF-8
	*/
	public function getURLFromTitolo($articolo){
		
		//controllo se è stato passato un articolo
		if(empty($articolo->getTitolo()))
			return 0;
		
		// replace non letter or digits by -
		$str = preg_replace('~[^"\\pL\d]+~u', ' -', $articolo->getTitolo());
		// trim
		$str = trim($str, '-');
		// transliterate
		if (function_exists('iconv')) {
			$str = iconv('utf-8', 'ASCII//TRANSLIT', $str);
		}
		// remove unwanted characters
		$str = preg_replace('~[^-\w]+~', '', $str);
		if (empty($str)) {
			return 0;
		}
		
		return $articolo->getId()."-".$str."-".$articolo->getDataPub();
		
	}
	
	/*trova un articolo in base alla stringa (in formato per URL) passata
	INPUT: stringa in UTF-8
	OUTPUT: oggetto di tipo articolo
	*/
	public function getArticoloFromUrl($url){
		
		//controllo se è stato passato un url
		if(empty($url))
			return 0;
		//prendo il campo id in posizione 0 e data in posizione 2
			if(preg_match_all('/(\d+)-([a-zA-Z0-9-]+)(\d{4}-\d+-\d+)/', $url, $matches, PREG_SET_ORDER, 0)){
			    $articolo = $this->getArticolo($matches[0][1]);
			    if(gettype($articolo) == "object" && get_class($articolo) == "Articolo"){
			        //controllo che corrisponda anche la data
			        if($articolo->getDataPub()==$matches[0][3])
			            return $articolo;
			            else
			                return 0;
			    }
			}
		//trovo l'articolo in base all'id
		
		//controllo se l'ha trovato
		return 0;
				
	}
	
	/*carica l'immagine sul server
	OUTPUT:Array di errori se update fallisce, array vuoto se ha successo
	*/
	public function uploadImage(){
		$out=array();
		$image=$_FILES["immagine"]["name"];
		$tmp_path=$_FILES["immagine"]["tmp_name"];
		$finalpath = static::SLIDE_DIR.basename($image);
		$filetype = strtolower(pathinfo($image,PATHINFO_EXTENSION));
		if(!in_array($filetype,array("jpeg","jpg","gif","png")) || !in_array(getimagesize($tmp_path)[2],array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG))){
			array_push($out,"Estensione del file non valida");
		}
		if (file_exists($finalpath)) {
    		array_push($out,"Nome file gi&agrave; utilizzato");
		}
		if ($_FILES["immagine"]["size"] > 5000000) {
    		array_push($out,"Limite dimensioni file superata");
		}
		if (!empty($out) || !move_uploaded_file($tmp_path,$finalpath)) {
        	array_push($out,"Upload fallito");
    	}
		return $out;
	}
	
	
	public function create_page_sitemap($path){
		
		$xmlsitemap = '<?xml version="1.0" encoding="UTF-8"?>
		<?xml-stylesheet type="text/xsl" href="'.$path.'/main-sitemap.xsl"?>
		<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
			<url>
				<loc>'.$path.'/home/</loc>
			</url>
			<url>
				<loc>'.$path.'/dovesiamo/</loc>
			</url>
			<url>
				<loc>'.$path.'/contattaci/</loc>
			</url>
			<url>
				<loc>'.$path.'/servizi/</loc>
			</url>
			<url>
				<loc>'.$path.'/areaRiservata/</loc>
			</url>
		</urlset>
		';
		
		if(file_put_contents('./page-sitemap.xml', $xmlsitemap)) return true;
		
		return false;
	}

	public function create_post_sitemap($path){
		
		$xmlsitemap = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="'.$path.'/main-sitemap.xsl"?>
		<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		$offerte=$this->getArticoliAttivi();
		if(is_array($offerte) && gettype($offerte[0]) == "object" && get_class($offerte[0]) == "Articolo"){
			foreach($offerte as $iteratoreArticolo){
				$xmlsitemap .= '<url>
					<loc>'.$path.'/servizi/'.$this->getURLFromTitolo($iteratoreArticolo) .'</loc>
					<lastmod>'.date("c").'</lastmod>
					<image:image>
						<image:loc>'.$iteratoreArticolo->getImmaginePath().'</image:loc>
						<image:title><![CDATA['.$iteratoreArticolo->getTitolo().']]></image:title>
						<image:caption><![CDATA['.$iteratoreArticolo->getTitolo().']]></image:caption>
					</image:image>
				</url>';
			}	
		}
		
		$xmlsitemap .= '</urlset>';
		
		if(file_put_contents('./post-sitemap.xml', $xmlsitemap)) return true;
		
		return false;
	}
	
	public function createSitemap(){
		$path = pathinfo($_SERVER['PHP_SELF']);
		$path = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$path['dirname'];
		if(!$this->create_page_sitemap($path)) return false; //creo sitemap statica pagine
		if(!$this->create_post_sitemap($path)) return false; //creo sitemap dinamica articoli
				
		$xmlsitemap = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="'.$path.'/main-sitemap.xsl"?>
		<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
			<sitemap>
				<loc>'.$path.'/post-sitemap.xml</loc>
				<lastmod>'.date("c").'</lastmod>
			</sitemap>
			<sitemap>
				<loc>'.$path.'/page-sitemap.xml</loc>
				<lastmod>'.date("c").'</lastmod>
			</sitemap>
			
		</sitemapindex>
		';
		
		if(file_put_contents('./sitemap_index.xml', $xmlsitemap)) return true;
		
		return false;
		
	}
	
	
}







?>
