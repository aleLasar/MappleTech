function createError(text,mode){
	var out=document.createElement("div");
	var t=document.createElement("p");
	t.innerHTML=text;
	out.setAttribute(mode,"errorcode");
	out.appendChild(t);
	return out;
}

function checkLogin(){
	var toremove=document.getElementById("errorcode");
	if(toremove!=null){
		document.forms["formLogin"][0].removeChild(toremove);
	}
	var mail=document.forms["formLogin"][1].value;
	var psw=document.forms["formLogin"][2].value;
	var errmail=createError("Email non valida","id");
	var errpsw=createError("Password non valida","id");
	var out;
	if(psw.search(/^[a-zA-Z0-9]{5,32}$/)!=0){
		out=errpsw;
	}
	if(mail.search(/^([a-zA-Z0-9]+\.*[a-zA-Z0-9]+)+@[a-zA-Z0-9]{1,64}\.[a-zA-Z]+$/)!=0){//pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
		out=errmail;
	}
	if(out==null){
		return true;
	}
	else{
		document.forms["formLogin"][0].insertBefore(out,document.forms["formLogin"][0].childNodes[3]);
		return false;
	}
}

function checkContatti(){
	var toremove=document.getElementsByClassName("errorcode");
	while(toremove.length){
		document.forms["formContatti"][0].removeChild(toremove[0]);
	}
	if(document.getElementById("successcode")!=null){
		document.forms["formContatti"][0].removeChild(document.getElementById("successcode"));
	}
	var name=document.forms["formContatti"][1].value;
	var desc=document.forms["formContatti"][2].value;
	var mail=document.forms["formContatti"][3].value;
	var ric=document.forms["formContatti"][4].value;
	var out=[];
	if(ric.search(/^[a-zA-Z]+$/)!=0){
		out.push(createError("<span class=\"bold\">Richiesta</span> non valida (no numeri o caratteri speciali consentiti)","class"));
	}
	if(mail.search(/^([a-zA-Z0-9]+\.*[a-zA-Z0-9]+)+@[a-zA-Z0-9]{1,64}\.[a-zA-Z]+$/)!=0){
		out.push(createError("<span class=\"bold\">Email</span> non valida","class"));
	}
	if(desc.search(/^[a-zA-Z]+$/)!=0){
		out.push(createError("<span class=\"bold\">Cognome</span> non valido (no numeri o caratteri speciali consentiti)","class"));
	}
	if(name.search(/^[a-zA-Z]+$/)!=0){
		out.push(createError("<span class=\"bold\">Nome</span> non valido (no numeri o caratteri speciali consentiti)","class"));
	}
	if(out.length!=0){
		for(var i=0;i<out.length;i++){
		document.forms["formContatti"][0].insertBefore(out[i],document.forms["formContatti"][0].childNodes[3]);	
		}
		return false;
	}
	else return true;
}

function checkArticoli(){
	var toremove=document.getElementsByClassName("errorcode");
	while(toremove.length){
		document.forms["formArticolo"][0].removeChild(toremove[0]);
	}
	var tit=document.forms["formArticolo"][1].value;
	var des=document.forms["formArticolo"][2].value;
	var type=document.forms["formArticolo"][3].value;
	var iday=document.forms["formArticolo"][4].value;
	var fday=document.forms["formArticolo"][5].value;
	var testo=document.forms["formArticolo"][6].value;
	var prezzo=document.forms["formArticolo"][7].value;
	var tipoprezzo=document.forms["formArticolo"][8].value;
	var out=[];
	if(tipoprezzo!="fisso" && tipoprezzo!="mese"){
		out.push(createError("Tipo di tariffa non valido","class"));
	}
	if(prezzo<0 || prezzo>9999){
		out.push(createError("Valore prezzo non valido","class"));
	}
	if(testo.trim()==""){
		out.push(createError("Testo non valido","class"));
	}
	var di=new Date(iday);
	var df=new Date(fday);
	if(iday!="" && fday!="" && di.getDate()>=Date.now().getDate() && df.getDate()>=Date.now().getDate() && di.getDate()>df.getDate()){
		out.push(createError("Date incompatibili","class"));
	}
	if(fday!="" && df.getDate()<Date.now().getDate()){
		out.push(createError("Data di fine gi&agrave; passata","class"));
	}
	if(fday==""){
		out.push(createError("Data di fine mancante","class"));
	}
	if(iday!="" && di.getDate()<Date.now().getDate()){
		out.push(createError("Data di inizio gi&agrave; passata","class"));
	}
	if(iday==""){
		out.push(createError("Data di inizio mancante","class"));
	}
	if(type!="servizio" && type!="offerta" && type!="notizia"){
		out.push(createError("Tipo non valido","class"));
	}
	if(des.trim()==""){
		out.push(createError("Descrizione non valida","class"));
	}
	if(tit.trim()==""){
		out.push(createError("Titolo non valido","class"));
	}
	if(out.length!=0){
		for(var i=0;i<out.length;i++){
		document.forms["formArticolo"][0].insertBefore(out[i],document.forms["formArticolo"][0].childNodes[3]);	
		}
		return false;
	}
	else return true;
}
function checkUtente(){
	var toremove=document.getElementsByClassName("errorcode");
	while(toremove.length){
		document.forms["formUtente"][0].removeChild(toremove[0]);
	}
	if(document.getElementById("successcode")!=null){
		document.forms["formUtente"][0].removeChild(document.getElementById("successcode"));
	}
	if(document.forms["formUtente"].length==7 || document.forms["formUtente"].length==8){
		var nome=document.forms["formUtente"][1].value;///^[a-zA-Z0-9]{5,32}$/
		var cognome=document.forms["formUtente"][2].value;
		var email=document.forms["formUtente"][3].value;
		var tel=document.forms["formUtente"][4].value;
		var psw=document.forms["formUtente"][5].value;
	}
	else{
		var nome=document.forms["formUtente"][2].value;
		var cognome=document.forms["formUtente"][3].value;
		var email=document.forms["formUtente"][4].value;
		var tel=document.forms["formUtente"][5].value;
		var psw=document.forms["formUtente"][6].value;
	}
	var out=[];
	if(psw.search(/^[a-zA-Z0-9]{5,32}$/)!=0){
		out.push(createError("Inserisci una Password da 5 a 32 caratteri con solo cifre e lettere","class"));
	}
	if(tel.search(/^[0-9]{9,10}$/)!=0){
		out.push(createError("Inserisci un numero di Telefono lungo 9 o 10 cifre","class"));
	}
	if(email.search(/^([a-zA-Z0-9]+\.*[a-zA-Z0-9]+)+@[a-zA-Z0-9]{1,64}\.[a-zA-Z]+$/)!=0){
		out.push(createError("Email non valida","class"));
	}
	if(cognome.search(/^[a-zA-Z]+$/)!=0){
		out.push(createError("Cognome non valido","class"));
	}
	if(nome.search(/^[a-zA-Z]+$/)!=0){
		out.push(createError("Nome non valido","class"));
	}
	if(out.length!=0){
		for(var i=0;i<out.length;i++){
		document.forms["formUtente"][0].insertBefore(out[i],document.forms["formUtente"][0].childNodes[3]);	
		}
		return false;
	}
	else return true;
}