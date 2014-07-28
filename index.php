<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Гостевая книга</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="shortcut icon" href="favicon.ico" type="image/icon">
</head>
<body>
	<form action="backend.php" method="GET">
		<input type="text" name="name" placeholder="Введите имя"/><br/>
		<input type="text" name="email" placeholder="Введите e-mail"/><br/>
		<textarea name="msg" value="" placeholder="Введите сообщение"></textarea><br/>
		<input type="submit"/><br/>
		<input type="submit" name="clear" value="Очистить"/>
		<input type="hidden" name="action" value="add_record">
	</form>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>