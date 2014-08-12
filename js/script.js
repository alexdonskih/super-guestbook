$(document).ready(function(){
	// your js/jquery code here
	var submit_form = document.getElementById('submit');
	submit_form.onclick=function(event) {
		var name_field  = document.getElementById('name');
		var email_field = document.getElementById('email');
		var textarea    = document.getElementById('msg');

		var check = '';
		var arr1 = [];
		if(name_field.value == '') {
			check = arr1.push("Имя");
		}
		if (email_field.value == '') {
			check = arr1.push("Email");
		}
		if (textarea.value == '') {
			check = arr1.push("Текст");
		}
		if(check != '') {
			alert('Пожалуйста, введите ' + arr1.join() + '.');
			event.preventDefault ? event.preventDefault() : (event.returnValue=false);
		}
	}
});