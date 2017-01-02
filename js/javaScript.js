function surligne(champ, erreur)
{
	if(erreur)
		champ.style.backgroundColor = "#fba";
	else
		champ.style.backgroundColor = "";
}


function verifierEmail(champ)
{

	console.log(champ.value);
	var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
	if(!regex.test(champ.value))
	{
		surligne(champ, true);
		return false;
	}
	else
	{
		surligne(champ, false);
		return true;
	}
}

function verifier(f){

	alert(f);

	var verifEmail = verifierEmail(f.mailSender);

	if (verifEmail) {
		return true;
	}
	else {
		alert("Veuillez remplir correctement tous les champs");
		return false;
	}
}

