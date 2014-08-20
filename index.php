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
		<form id="form" action="backend.php" method="GET">
			<input id="name" type="text" name="name" placeholder="Имя"/><br/>
			<input id="email" type="text" name="email" placeholder="E-mail"/><br/>
			<textarea id="msg" name="msg" placeholder="Сообщение"></textarea><br/>
			<input id="submit" type="submit"/>
			<input type="hidden" name="action" value="add_record">
		</form>
		<?=file_get_contents($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].str_replace('index.php', '', $_SERVER['PHP_SELF']).'/backend.php?action=get_messages');?>
</div>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>