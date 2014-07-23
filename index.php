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
	<table>
				<tr><td><label for="name">Введите имя</label></td>
					<td><input type="text" name="name"/></td></tr>
				<tr><td><label for="email">Введите e-mail</label></td>
					<td><input type="text" name="email"/></td></tr>
				<tr><td><label for="txt">Введите текст</label></td>
					<td><textarea name="msg" value="" placeholder="Введите сообщение"></textarea></td></tr>
				<tr><td><input type="submit"/></td></tr>
				<tr><td><input type="submit" name="clear" value="Очистить"/></td></tr>
				<tr><td><input type="hidden" name="action" value="add_record"></td></tr>
			</table>
	</form>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>