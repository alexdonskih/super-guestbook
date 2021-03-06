<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Гостевая книга</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="shortcut icon" href="favicon.ico" type="image/icon">
</head>
<body>
<noscript><p>Ваш браузер не поддерживает Javascript!</p></noscript>
<div id="guest">
	<h2>Гостевуха</h2>
		<form id="form">
			<input id="name" type="text" name="name" placeholder="Имя"/><br/>
			<input id="email" type="text" name="email" placeholder="E-mail"/><br/>
			<textarea id="msg" name="msg" placeholder="Сообщение"></textarea><br/>
			<input type="button" id="submit" value="Отправить"/>
			<input type="hidden" name="action" value="add_record">
		</form>
	<div id="dialog">
		<p id="success">Сообщение отправлено</p>
		<p id="error">Ошибка</p>
	</div>
	<div id="messages">
	</div>
</div>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>