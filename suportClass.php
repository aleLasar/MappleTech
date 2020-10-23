<?php

/*			
classe che descrive gli articoli
CAMPI (non ovvi):
-$dataP=data di pubblicazione dell'articolo 
-$dataS=data di scadenza dell'articolo
-$tipo= identifica il tipo di articolo (0=offerta, 1=servizio)
-$immagine= descrive il path dove andatre a prendere l'immagine
*/ 
class Articolo{
	private $id;
	private $titolo;
	private $descrizione;
	private $testo;
	private $tipo;
	private $dataP;
    private $dataS;
    private $prezzo;
	private $immagine;
	
	public function __construct($tit, $desc,$testo,$tipo, $dataPubb, $dataScad, $price, $img="", $id=""){
		$this->id=$id;
		$this->titolo=$tit;
		$this->descrizione=$desc;
		$this->testo=$testo;
		$this->tipo=$tipo;
		$this->dataP=$dataPubb;
        $this->dataS=$dataScad;
        $this->prezzo=$price;
		$this->immagine=$img;
	}
	
	public function getId(){
		if($this->id)
			return $this->id;
		else
			return null;
	}
	
	public function getTitolo(){
		return $this->titolo;
	}
	
	public function getDesc(){
		return $this->descrizione;
	}
	
	public function getTesto(){
		return $this->testo;
	}
	
	public function getTipo(){
		return $this->tipo;
	}
	
	public function getTipoString(){
		if($this->tipo==0){
			return "offerta";
		}
		elseif ($this->prezzo==0) {
			return "notizia";
		}
		else return "servizio";
	}
	
	public function getDataPub(){
		return $this->dataP;
	}
	
	public function getDataScad(){
		return $this->dataS;
    }
    
    public function getPrezzo(){
        return $this->prezzo;
    }

    public function getPrezzoVal(){
    	$array=explode(" ",$this->prezzo);
    	if(is_array($array) && gettype($array[0]) == "object"){
    	    return $array[0];
    	}else{
    	    return 0;
    	}
    }

    public function getPrezzoTipo(){
    	$array=explode(" ",$this->prezzo);
    	if(is_array($array)){
    	    if(isset($array[1])){
    	        if($array[1]=="&euro;"){
    	            return "fisso";
    	        }
    	        return "mese";
    	    }
    	}else{
    	    return 0;
    	}
    	
    }
	
	public function getImmaginePath(){
		return $this->immagine;
	}
}



/*
classe che descrive l'utente
*/
class Utente{
	private $id;
	private $nome;
	private $cognome;
	private $telefono;
	private $email;
	private $password;

	
	public function __construct($n, $c,$email,$pass,$tel="",$id=""){
		$this->id=$id;
		$this->nome=$n;
		$this->cognome=$c;
		$this->telefono=$tel;
		$this->email=$email;
		$this->password=$pass;
	}
	
	/*prende un password in chiaro e la rende inleggibile
	INPUT: string con password in chiaro 
	*/
	public function setPassword($psw){
		$this->password=sha1($password);
	}
	
	/*
	INPUT: oggetto di tipo Utente
	OUTPUT: true se la password ? la stessa, false altrimenti
	*/
	public function passCorrect($password){
		return $this->password==$password;	
	}
	
	public function getPassword(){
		return $this->password;
	}
	
	public function getNome(){
		return $this->nome;
	}
	
	public function getCognome(){
		return $this->cognome;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function getTelefono(){
		return $this->telefono;
	}

	public function setId($newID){
		$this->id = $newID;
	}
	
	public function getId(){
		if($this->id)
			return $this->id;
		else
			return null;
	}
}

?>