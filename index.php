<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Гостевая книга</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="shortcut icon" href="favicon.ico" type="image/icon">
</head>
<body>
	<div id="guest">
		<h2>Гостевуха</h2>
		<form action="backend.php" method="GET">
			<input type="text" name="name" placeholder="Введите имя"/><br/>
			<input type="text" name="email" placeholder="Введите e-mail"/><br/>
			<textarea rows="10" name="msg" placeholder="Введите сообщение"></textarea><br/>
				<div class="submit_block">
					<input class = "submit" type="submit"/>
					<input class = "submit" type="submit" name="clear" value="Очистить"/>
				</div>
			<input type="hidden" name="action" value="add_record">
		</form>
	</div>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>