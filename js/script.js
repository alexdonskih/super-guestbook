$(document).ready(function(){
	var name_field  = document.getElementById('name');
	var email_field = document.getElementById('email');
	var textarea    = document.getElementById('msg');
	//функция для возврата номера нужной страницы при клике по ссылке
	function number() {
		y = $('a').text();
		return y;
	}

/*Дата и время*/

//Функция, добавляет возможность форматирования стоки даты и времени
	Date.prototype.toLocaleFormat = function(format) {
		var f = {y : this.getYear() + 1900,m : this.getMonth() + 1,d : this.getDate(),H : this.getHours(),M : this.getMinutes(),S : this.getSeconds()}
		for(k in f)
			format = format.replace('%' + k, f[k] < 10 ? "0" + f[k] : f[k]);
		return format;
	};

//Забираем и форматируем дату
	var currentdate = new Date();
	var datetime = currentdate.toLocaleFormat('%d-%m-%y %H:%M:%S')


/*AJAX POST & GET messages*/
	var submit_form = document.getElementById('submit');
	submit_form.onclick=function(event) {
		var check = [];
		if(name_field.value == '') {
			check.push('Имя');
		}
		if (email_field.value == '') {
			check.push('Email');
		}
		if (textarea.value == '') {
			check.push('Текст');
		}
		if(check.length != 0) {
			check_msg = 'Пожалуйста, введите ' + check.join(', ') + '.';
			alert(check_msg);
			event.preventDefault ? event.preventDefault() : (event.returnValue=false);
		}
		else {
		var ajax_msg = '<p><strong>' + name_field.value + '</strong> ' + email_field.value + '</p>' +'<p>'+ datetime +'</p>'+ textarea.value + '<hr/>';
			$.ajax({
  				method: 'POST',
  				url: 'backend.php',
  				data: {
  					name: name_field.value,
        			email: email_field.value,
        			msg: textarea.value,
        			action: 'add_message',
        			}
			})
  			.done(function( data, Status ) {
    			$('#messages').prepend(ajax_msg);
    			$('#name').val('');
    			$('#email').val('');
    			$('#msg').val('');
    			$('#success').addClass('success');
    			$('#success').fadeOut(5000);
    			$('#error').hide();
    			$('#dialog').show();
  			})
  			.error(function() {
  				$('#error').addClass('error');
  				$('#error').fadeOut(5000);
  				$('#success').hide();
  				$('#dialog').show();
  			});
		}
	}

//AJAX GET messages
	$.get('backend.php', {
		action: 'get_messages',
		//page: number() //через эту переменную передается номер страницы?
	})
		.done (function (data, status) {
		$('#messages').append(data);
		})
	});

