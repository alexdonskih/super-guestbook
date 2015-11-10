$(document).ready(function(){
	var name_field  = document.getElementById('name');
	var email_field = document.getElementById('email');
	var textarea    = document.getElementById('msg');

/*Дата и время*/

/*Функция, добавляет возможность форматирования стоки даты и времени*/
	Date.prototype.toLocaleFormat = function(format) {
		var f = {y : this.getYear() + 1900,m : this.getMonth() + 1,d : this.getDate(),H : this.getHours(),M : this.getMinutes(),S : this.getSeconds()}
		for(k in f)
			format = format.replace('%' + k, f[k] < 10 ? "0" + f[k] : f[k]);
		return format;
	};

/*Забираем и форматируем дату*/
	var currentdate = new Date();
	var datetime = currentdate.toLocaleFormat('%d-%m-%y %H:%M:%S')

/*Конец блока обработки даты и времени*/

/*dialog box*/
$('#dialog').hide();

/*AJAX POST messages*/
	var submit_form = document.getElementById('submit');
	submit_form.onclick=function(event) {
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
		else {
			$.ajax({
  				method: "POST",
  				url: "backend.php",
  				data: {
  					name: name_field.value,
        			email: email_field.value,
        			msg: textarea.value,
        			action: 'add_messages' }
			})
  			.done(function( data, Status ) {
    			console.log('Отправлено'),
    			$('#messages').prepend("<p><strong>" + name_field.value + "</strong> " + email_field.value + "</p>" +"<p>"+ datetime +"</p>"+ textarea.value + "<hr/>")
    			$('#success').addClass("success");
    			$('#error').hide();
    			$('#dialog').show();
  			})
  			.error(function() {
  				$('#error').addClass("error");
  				$('#success').hide();
  				$('#dialog').show();
  			});
		}
	}

/*AJAX GET messages*/
	$.get("backend.php", {action: 'get_messages'})
		.done (function (data, status) {
		$('#messages').append(data);
	});


});

