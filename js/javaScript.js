function surligne(champ, erreur)
{
	if(erreur)
		champ.style.backgroundColor = "#fba";
	else
		champ.style.backgroundColor = "";
}


function verifierEmail(champ)
{
	/*var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
	if(!regex.test(champ.value))
	{
		surligne(champ, true);
		return false;
	}
	else
	{
		surligne(champ, false);
		return true;
	}*/
	return true;
}

function verifier(f){

	var verifEmail = verifierEmail(f.mailSender);

	if (verifEmail) {
		/*var fileOK= document.getElementsByTagName('input');
		console.log($("form#formain input[type=file].value"));*/
		/*console.log(fileOK);
		alert(fileOK);*/

		/*$.get('envoiMail.php', { "file" : fileOK})

		.done(function(data, test, test2) {

			console.log(test, test2);
		})
		.fail(function(data) {
			alert('Error: ' + data);
		});*/

		return true;

	}
	else {
		alert("Veuillez remplir correctement tous les champs");
		return false;
	}
}
             
// drag and drop 
function readURL(input) {

// format OK to be displayed
var fileTypes= ['jpg','jpeg','png'];
	if (input.files && input.files[0]) {

		$fileName=input.files[0].name;
		var extension = $fileName.split('.').pop().toLowerCase();
		
		var reader = new FileReader();

		reader.onload = function(e) {
			$('.image-upload-wrap').hide();

			if ((fileTypes.indexOf(extension)) > -1) {

			$('.file-upload-image').attr('src', e.target.result);
			$('.file-upload-image').show();
			$('.file-upload-content').show();
			$('.image-title').html(input.files[0].name);
			}
			else {
			/*document.getElementById("filename").innerHTML = $fileName;*/
			$('.file-upload-image').attr('src', e.target.result);
			$('.file-upload-image').hide();
			$('.file-upload-content').show();
			$('.image-title').html(input.files[0].name);
			}
		};

		reader.readAsDataURL(input.files[0]);

	} else {
		removeUpload();
	}
}

function removeUpload() {
	$('.file-upload-input').replaceWith($('.file-upload-input').clone());
	$('.file-upload-content').hide();
	$('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function() {
	$('.image-upload-wrap').addClass('image-dropping');
});
$('.image-upload-wrap').bind('dragleave', function() {
	$('.image-upload-wrap').removeClass('image-dropping');
});



// SCROLL DOWN 
$(document).ready(function(){
$('a[href^="#"]').on('click',function (e) {
    e.preventDefault();

    var target = this.hash;
    var $target = $(target);

    $('html, body').stop().animate({
        'scrollTop': $target.offset().top
    }, 900, 'swing', function () {
        window.location.hash = target;
    });
});
});
