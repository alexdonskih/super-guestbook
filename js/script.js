$(document).ready(function(){
	// your js/jquery code here
	var submit_form = document.getElementById('submit');
	submit_form.onclick=function(event) {
		var name_field  = document.getElementById('name');
		var email_field = document.getElementById('email');
		var textarea    = document.getElementById('msg');

		var check = "";
		if(name_field.value == '') {
			check = check + ' Имя ' + ',';
		}
		if (email_field.value == '') {
			check = check + ' E-mail ' + ',';
		}
		if(textarea.value == '') {
			check = check + ' Текст ' + ',';
		}

		if(check != '') {
			alert('Пожалуйста, введите' + check);
			event.preventDefault ? event.preventDefault() : (event.returnValue=false);
		}
	}
});