<?php 

/* HEADER CALL */
$pageTitle = "Login Area Riservata";
$pageType = "access";
$pageDescription = "";
$pageKeywords = "";
include_once("header.php");


$erroreLogin = "";
if(isset($_POST["submit"])){
	include_once("connectionDB.php");
	$connessione=new ConnectionDB();
	$connessione->openConnection();


	if(isset($_POST["email"]) && preg_match("/^([a-zA-Z0-9]+\.*[a-zA-Z0-9]+)+@[a-zA-Z0-9]{1,64}\.[a-zA-Z]+$/",$_POST["email"]))
		$email = $_POST["email"];
	else
		$erroreLogin = "Email non valida";

	if(isset($_POST["password"]) && preg_match("/^[a-zA-Z0-9]{5,32}$/",$_POST["password"]))
		$password = sha1($_POST["password"]);
	else
		$erroreLogin = "Password non valida";

	if($erroreLogin==""){
		$utente = $connessione->getUtente($email);
		if(gettype($utente)=="object"){
			if($utente->passCorrect($password)){
				$connessione->closeConnection();
				session_start();
				$_SESSION["user"] = $utente->getEmail();
				$_SESSION["id"] = $utente->getId();
				header("Location: ../amministrazione/home/");
			}
			else{
				$erroreLogin = "Password errata";
			}
			
		}
		else{
			$erroreLogin = "Utente inesistente";
		}
	}

}



?>
<body>
	<div id="container">
	<div class="noWhitespaceDue">			
		<?php include_once("menu.php"); ?>
		<div class="showOnPrint"><h1>Mapple Tech</h1></div>

		<div id="content">
			<div id="breadcumbs">
				<p>Ti trovi in: <span xml:lang="en" lang="en">Home</span> > Login</p>
			</div>
			
			<h2 class="centerAlign">Login Area Riservata</h2>
				<div id="formRow" class="row centerAlign">
					
					<form id="formLogin" autocomplete="off" method="post" action="../areaRiservata/" onsubmit="return checkLogin()">
						<fieldset>
							<legend>Autenticazione</legend>
							<?php if(isset($erroreLogin) && !empty($erroreLogin)) 
									echo "<div id=\"errorcode\"><p>".$erroreLogin."</p></div>"; 
							?>
							<div class="form-group">
								<label for="email">Email</label>
								<div class="formInput">
									<input type="email" id="email" name="email" placeholder="email@dominio.tld" autocomplete="off"/>
								</div>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<div class="formInput">
									<input type="password" id="password" name="password" placeholder="password" autocomplete="new-password"/>
								</div>
							</div>
							<div class="form-group">
								<input type="submit" name="submit" value="Accedi" />
							</div>
						</fieldset>
					</form>
					
				</div>
			
		</div>
		
		<?php include_once("footer.php"); ?>
