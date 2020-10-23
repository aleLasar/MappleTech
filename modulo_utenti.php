<?php

if(isset($_GET["modifica"]) && !empty($_GET["modifica"]))
	$pageTitle = "Modifica Utente";
else if(isset($_GET["nuovo"]))
	$pageTitle = "Aggiungi nuovo Utente";
else{
	header("location: ../?queryexecuted=false&motivo=links");
}

$pageType = "reserved";
$pageDescription = "";
$pageKeywords = "";
include_once("header.php");

$error=array();
if(isset($_POST["submit"])){
	include_once("connectionDB.php");
	$connessione=new ConnectionDB();
	$connessione->openConnection();

	if(isset($_POST["Nome"]) && !preg_match("/^[a-zA-Z]+$/",$_POST["Nome"]) ){ 
		array_push($error,"Nome non valido");
	}
	if(isset($_POST["Cognome"]) && !preg_match("/^[a-zA-Z]+$/",$_POST["Cognome"]) ){
		array_push($error,"Cognome non valido");
	}
	if(isset($_POST["Email"]) && !preg_match("/^([a-zA-Z0-9]+\.*[a-zA-Z0-9]+)+@[a-zA-Z0-9]{1,64}\.[a-zA-Z]+$/",$_POST["Email"])){
		array_push($error,"Email non valida");
	}
	if(isset($_POST["Telefono"]) && !preg_match("/^[0-9]{9,10}$/",$_POST["Telefono"]) ){
		array_push($error,"Inserisci un numero di Telefono lungo 9 o 10 cifre");
	}
	$password="";
	if(isset($_POST["oldPassword"]) && !is_null($_POST["oldPassword"])){
		$password = $_POST["oldPassword"];
	}
	$newPassword="";
	if(isset($_POST["Password"]) && !empty($_POST["Password"]) && preg_match("/^[a-zA-Z0-9]{5,32}$/",$_POST["Password"])){
		$newPassword = sha1($_POST["Password"]);
		if($password != $newPassword && !is_null($password))
			$password = $newPassword;
	}
	else array_push($error,"Inserisci una Password da 5 a 32 caratteri con solo cifre e lettere");
	
	if($_POST["submit"]=="Modifica Utente" && isset($_POST["Id"]) && trim($_POST["Id"])==""){
		array_push($error,"Non &egrave; possibile modificare l&apos;ID!");
	}


	$queryexecuted=false;
	$userToModify=new Utente($_POST["Nome"], $_POST["Cognome"], $_POST["Email"], $password, $_POST["Telefono"]);
	if($_POST["submit"]=="Modifica Utente"){
		$userToModify->setId($_POST["Id"]);
	}
	if(count($error)==0){
		if($_POST["submit"]=="Modifica Utente"){
			$collision=$connessione->getUtente($_POST["Email"]);
			if((gettype($collision)=="integer" && $collision==0) || $collision->getId()==$userToModify->getId()){
				if($connessione->updateUtente($userToModify)){
				if($userToModify->getId() == $_SESSION['id']){
					$_SESSION['user'] = $userToModify->getEmail();
				}
				header("location: ../modifica/".$_POST["Email"]."&queryexecuted=true");
				$queryexecuted=true;
				}
			}
			else array_push($error,"Mail gi&agrave; usata");
		}
		else {
			$collision=$connessione->getUtente($_POST["Email"]);
			if(gettype($collision)=="integer" && $collision==0){
				if($connessione->insertUtente($userToModify)){
				//header("location: ../modifica/".$_POST["Email"]."&queryexecuted=true");
				header("location: ../?queryexecuted=true");
				}
			}
			else array_push($error,"Mail gi&agrave; usata");
		}
	}
	$connessione->closeConnection();
}
else if(isset($_GET["modifica"]) && !empty($_GET["modifica"])){
	include_once("connectionDB.php");
	$connessione=new ConnectionDB();
	$connessione->openConnection();
	$userToModify = $connessione->getUtente($_GET["modifica"]);
	$queryexecuted=false;
	if(isset($_GET['queryexecuted']) && !empty($_GET['queryexecuted'])){
		$queryexecuted=$_GET['queryexecuted'];
	}
	
	$connessione->closeConnection();
	if(gettype($userToModify) != "object" || get_class($userToModify)!="Utente"){
		header("location: ../?queryexecuted=false&motivo=user_not_exist");
	}
	else if($_SESSION["id"]!=1 && $_SESSION["id"]!=$userToModify->getId()){
		header("location: ../?queryexecuted=false&motivo=hacker");
	}
}
else{
	include_once("connectionDB.php");
	$connessione=new ConnectionDB();
	$connessione->openConnection();
	$userToModify = new Utente(null,null,null,null,null);
}


?>
<body>
	<div id="container">
	<div class="noWhitespace">			
		<?php include_once("menu.php"); ?>

		<div id="content">
			<div id="breadcumbs">
				<p>Ti trovi in: Area Riservata > <?php echo $pageTitle; ?></p>
			</div>
			<h2 class="centerAlign spaceTop"><?php echo $pageTitle; ?></h2>
				<div class="row">
					<form id="formUtente" method="post" action=<?php echo ($pageTitle == "Modifica Utente") ? "../modifica/".$_GET["modifica"] : "../nuovo/"; ?> onsubmit="return checkUtente()">
						<fieldset>
							<legend><?php echo ($pageTitle == "Modifica Utente") ? "Modifica" : "Inserisci"; ?> i dati</legend>
							<?php
								for($i=0;$i<count($error);$i++){
									echo "<div class=\"errorcode\"><p>";
									echo $error[$i];
									echo "</p></div>";
								}
							if(isset($queryexecuted) && $queryexecuted==true){
								echo "<div id=\"successcode\"><p>Utente ".(($pageTitle == "Modifica Utente") ? "Modificato" : "Inserito")."</p></div>";
								$queryexecuted=false;
							}
							?>
							<div class="col s6 b3 centerAlign">
								<?php if($pageTitle == "Modifica Utente" && $queryexecuted==false) 
									echo "<div class=\"form-group\">
										<label for=\"Id\">Id</label>
										<input type=\"text\" id=\"Id\" name=\"Id\" value=".$userToModify->getId()." readonly/>
										
										</div>";
								?>
								<div class="form-group">
									<label for="Nome">Nome</label>
									<input type="text" id="Nome" name="Nome" placeholder="Nome..." <?php
									if(!is_null($userToModify->getNome()) && $queryexecuted==false){
										echo "value=\"".$userToModify->getNome()."\"";
									}
									?> required/>
									
								</div>
								<div class="form-group">
									<label for="Cognome">Cognome</label>
									<input type="text" id="Cognome" name="Cognome" placeholder="Cognome..." <?php
									if(!is_null($userToModify->getCognome()) && $queryexecuted==false){
										echo "value=\"".$userToModify->getCognome()."\"";
									}
									?>/>
									
								</div>
															

								
							</div>
							<div class="col s6 b3 centerAlign">
								<div class="form-group">
									<label for="Email">Email</label>
									<input type="email" id="Email" name="Email" placeholder="Email..." pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" <?php
									if(!is_null($userToModify->getEmail()) && $queryexecuted==false){
										echo "value=\"".$userToModify->getEmail()."\"";
									}
									?> required/>
									
								</div>
								<div class="form-group">
									<label for="Telefono">Telefono</label>
									<p class="inputRule">Numero di Telefono lungo 9 o 10 cifre</p>
									<input type="tel" id="Telefono" name="Telefono" placeholder="Telefono..." pattern="[0-9]{9,10}" <?php
									if(!is_null($userToModify->getTelefono()) && $queryexecuted==false){
										echo "value=\"".$userToModify->getTelefono()."\"";
									}
									?>/>
									
								</div>
								<div class="form-group">
									<label for="Password">Nuova Password</label>
									<p class="inputRule">Password da 5 a 32 caratteri</p>
									<p class="inputRule">Sono accettate solo cifre e lettere</p>
									<input type="password" id="Password" name="Password" placeholder="Nuova Password..." pattern="[a-zA-Z0-9]{5,32}"/>
									<?php
									if(!is_null($userToModify->getPassword()) && $queryexecuted==false){
										echo "<input type=\"hidden\" name=\"oldPassword\" value=\"".$userToModify->getPassword()."\"/>";
									}
									?>
								</div>
								<div class="form-group">
									<input type="submit" name="submit" value="<?php echo (($pageTitle == "Modifica Utente") ? "Modifica Utente" : "Inserisci Utente"); ?>" />
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			
		</div>
<?php include_once("footer.php"); ?>

