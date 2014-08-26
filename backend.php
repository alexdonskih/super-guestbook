<?php
//назначаем константы для коннекта к БД
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'guestbook');

$data = $_GET;
$messages = array (
	'form_error'       => 'Пожалуйста, заполните все формы корректно',
	'msg_send'         => 'Ваше сообщение успешно отправлено',
	'file_write_error' => 'Ошибка записи в файл',
	'file_not_found'   => 'Файл не найден',
	'fread_error'      => 'Файл не может быть прочитан',
	'mysqli_cn_error'  => 'Ошибка соединения с базой данных',
	'mysqli_query_err' => 'Ошибка формирования запроса к базе данных',
	'mysqli_table_cr'  => 'Первый запуск скрипта. Таблица успешно создана'
);
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die($messages['mysqli_cn_error']);
$sql = mysqli_query($dbc, "SHOW TABLES FROM questbook");
if(!sql) {
	$create_query = "CREATE TABLE messages(
 	`id` INT(11) NOT NULL AUTO_INCREMENT ,
 	`name` VARCHAR( 25 ) NOT NULL DEFAULT  '',
 	`email` VARCHAR( 50 ) NOT NULL DEFAULT  '',
 	`msg` TEXT,
 	`datetime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
	PRIMARY KEY ( `id` )
	)";
	mysqli_query($dbc, $create_query);
	echo $messages['mysqli_table_cr'];
	mysqli_close($dbc);
}

switch($data['action']){
	case 'add_record':

		// задаем основные переменные
		$form_name   = trim(strip_tags($data['name']));
		$form_email  = trim(strip_tags($data['email']));
		$form_msg    = trim(strip_tags($data['msg']));
		$redir       = '<meta http-equiv="refresh" content="1; url='.$_SERVER['HTTP_REFERER'].'">';
		echo $redir;

		// проверка на пустоту
		if(empty($form_name) || empty($form_email) || empty($form_msg)) {
			echo $messages['form_error'];

		} else {
			// коннект к базе данных и запись в таблицу
			$dbc1 = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die($messages['mysqli_cn_error']);
			$query = "INSERT INTO messages (name, email, msg) VALUES ('$form_name', '$form_email', '$form_msg')";
			$sql1 = mysqli_query($dbc1, $query);

		if($sql1) {
			echo $messages['msg_send'];
		}else {
			echo $messaqes['file_write_error'];
		}
		mysqli_close($dbc1);
		}
	break;

	case 'get_messages':

		$dbc2 = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die($messages['mysqli_cn_error']);
		$query1 = "SELECT id, name, email, msg, UNIX_TIMESTAMP(datetime) as dt FROM messages ORDER BY id DESC LIMIT 5";
		$sql2 = mysqli_query($dbc2, $query1) or die($messages['mysqli_query_err']);

		//организуем вывод данных
		while($row   = mysqli_fetch_assoc($sql2)) {
			$table_name  = $row['name'];
			$table_email = $row['email'];
			$table_msg   = $row['msg'];
			$table_date  = date('d-m-Y H:i:s',$row['dt']);

			echo "<p><strong>{$table_name}</strong> {$table_email}</p><p>{$table_date}</p>{$table_msg}<hr/>";
		}
		mysqli_close($dbc2);
	break;
}