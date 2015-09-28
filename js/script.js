$(document).ready(function(){
	// your js/jquery code here
	var submit_form = document.getElementById('submit');
	submit_form.onclick=function(event) {
		var name_field  = document.getElementById('name');
		var email_field = document.getElementById('email');
		var textarea    = document.getElementById('msg');

		var check = [];
		if(name_field.value == '') {
			check.push("Имя");
		}
		if (email_field.value == '') {
			check.push("Email");
		}
		if (textarea.value == '') {
			check.push("Текст");
		}
		if(check.length != 0) {
			alert('Пожалуйста, введите ' + check.join(', ') + '.');
			event.preventDefault ? event.preventDefault() : (event.returnValue=false);
		}
	}

	$.get("backend.php", {action: "get_messages"})
	.done(function(data){
		$('#messages').append(data);
	});

});

