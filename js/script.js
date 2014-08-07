$(document).ready(function(){
	// your js/jquery code here
	document.getElementById('submit').onclick=function(event) {
		var name_field = document.getElementById('name');
		var email_field = document.getElementById('email');
		var textarea = document.getElementById('msg');
		if(name_field.value == '') {
			alert('Заполните имя!');
			event.preventDefault ? event.preventDefault() : (event.returnValue=false);
		}
		if (email_field.value == '') {
			alert('Заполните email!');
			event.preventDefault ? event.preventDefault() : (event.returnValue=false);
		}
		if (textarea.value == '') {
			alert('Заполните текст!');
			event.preventDefault ? event.preventDefault() : (event.returnValue=false);
		}
	}
});