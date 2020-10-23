function navbarActionOpenClose() {
    var x = document.getElementById("firstNavbar");
    if (x.className == "topnav responsive") {
        x.className = "topnav";
    } else {
        x.className += " responsive";
		
    }
}
resetMenuClass();
function resetMenuClass() {
    var x = document.getElementById("firstNavbar");
    if (x.className == "topnav Firstresponsive") {
        x.className = "topnav";
    }
}

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function minusSlides(n) {
  showSlides(slideIndex -=1);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  if(slides.length > 0){
	  for (i = 0; i < slides.length; i++) {
		  slides[i].style.display = "none";  
	  }
	  if (n > slides.length) {slideIndex = 1}    
	  if (n < 1) {slideIndex = slides.length}
	  
	  slides[slideIndex-1].style.display = "block";  
  }
}

if(document.getElementsByClassName("prev").length!=0 && document.getElementsByClassName("next").length!=0){
  var slideIndex = 1;
  document.getElementsByClassName("prev")[0].style.display= "initial";
  document.getElementsByClassName("next")[0].style.display= "initial";
  showSlides(slideIndex);
}
