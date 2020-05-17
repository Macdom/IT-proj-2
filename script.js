function Walidacja(){
	var errors = "";
	var valid = true;
	
	var dat = document.forms["form"]["data"].value;
	if(dat == ""){
		errors=errors.concat("Nie wpisano pola Data.\n");
		valid = false;
	}
	
	var wis = document.forms["form"]["wisla"].value;
	if(wis == ""){
		errors=errors.concat("Nie wpisano goli dla Wisły.\n");
		valid = false;
	}
	else{
		if((isNaN(wis)) || (wis < 0) || (wis >= 10)){
			errors=errors.concat("Liczba goli musi być nieujemna i mniejsza niż 10.\n");
			valid = false;
		}
	}
	
	var cra = document.forms["form"]["cracovia"].value;
	if(cra == ""){
		errors=errors.concat("Nie wpisano goli dla Cracovii.\n");
		valid = false;
	}
	else{
		if((isNaN(cra)) || (cra < 0) || (cra >= 10)){
			errors=errors.concat("Liczba goli musi być nieujemna i mniejsza niż 10.\n");
			valid = false;
		}
	}		
	
	if(valid == false) alert(errors);
	return valid;
}

function rysuj(){
	let wisWyg = parseInt(document.getElementById("wis_w").textContent);
	let craWyg = parseInt(document.getElementById("cra_w").textContent);
	let rem = parseInt(document.getElementById("r").textContent);
	let wszystkie = wisWyg + craWyg + rem;

	let canvas = document.getElementById("canvas");
	let ctx = canvas.getContext("2d");
	
	let kolory = ['blue', 'red', 'gray'];
	
	let katy = [2*Math.PI * (wisWyg/wszystkie), 2*Math.PI * (craWyg/wszystkie), 2*Math.PI * (rem/wszystkie)];
	
	let poczatek = 0;
	let koniec = 0;
	
	for (let i = 0; i < katy.length; i++){
		poczatek = koniec;
		koniec += katy[i];
		
		ctx.beginPath();
		ctx.fillStyle = kolory[i];
		
		ctx.beginPath();
		ctx.moveTo(500, 250);
		ctx.arc(500, 250, 250, poczatek, koniec);
		ctx.lineTo(500, 250);
		ctx.stroke();
		
		ctx.fill();
	}


}



