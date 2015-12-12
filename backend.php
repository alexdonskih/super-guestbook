<?php
//назначаем константы для коннекта к БД
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'guestbook');

$data = $_GET;
$data_post = $_POST;
$num_rec_per_page = 10; //ограничение числа записей на страницу
$messages = array (
	'form_error'       => 'Пожалуйста, заполните все формы корректно',
	'msg_send'         => 'Ваше сообщение успешно отправлено',
	'msg_send_error'   => 'Ошибка отправки сообщения',
	'mysqli_cn_error'  => 'Ошибка соединения с базой данных',
	'mysqli_query_err' => 'Ошибка формирования запроса к базе данных',
	'mysqli_table_cr'  => 'Первый запуск скрипта. Таблица успешно создана'
);
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die($messages['mysqli_cn_error']);

//условие проверки существования таблицы
$query = "CREATE TABLE IF NOT EXISTS messages(
 	`id` INT(11) NOT NULL AUTO_INCREMENT ,
 	`name` VARCHAR( 25 ) NOT NULL DEFAULT  '',
 	`email` VARCHAR( 50 ) NOT NULL DEFAULT  '',
 	`msg` TEXT,
 	`datetime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
	PRIMARY KEY ( `id` )
	)";

mysqli_query($dbc, $query);

switch($data['action']){
	case 'get_messages':
	if (isset($data['page'])) { $page  = $data['page']; } else { $page=1; }; //если из массива приходит страница, $page = её номеру, иначе = 1
	$start_from = ($page-1) * $num_rec_per_page; //начало возвращаемой строки = номер страницы-1 * количество записей
		$query = "SELECT id, name, email, msg, UNIX_TIMESTAMP(datetime) as dt FROM messages ORDER BY id DESC LIMIT $start_from, $num_rec_per_page";
		$sql = mysqli_query($dbc, $query) or die($messages['mysqli_query_err']);

		//организуем вывод данных
		while($row   = mysqli_fetch_assoc($sql)) {
			$table_id = $row['id'];
			$table_name  = $row['name'];
			$table_email = $row['email'];
			$table_msg   = $row['msg'];
			$table_date  = date('d-m-Y H:i:s',$row['dt']);

			echo "<p><strong>{$table_id}{$table_name}</strong> {$table_email}</p><p>{$table_date}</p>{$table_msg}<hr/>";

		}
		//вывод блока со страницами
		$sql_count = "SELECT * FROM messages"; //выборка всех записей
		$rs_result = mysqli_query($dbc, $sql_count); //стартует запрос
		$total_records = mysqli_num_rows($rs_result);  //счетчик числа записей
		$total_pages = ceil($total_records / $num_rec_per_page); //частное от деления кол-ва записей на число записей на страницу

		//вывод страниц
		echo "<a id='1' href='index.php?page=1'>".'|<'."</a> "; // Первая страница

		for ($i=1; $i<=$total_pages; $i++) {
            echo "<a id='".$i."' href='index.php?page=".$i."'>".$i."</a> "; //организуем цикл, где номер страницы изменяется до $total_pages
		};
		echo "<a id='$total_pages' href='index.php?page=$total_pages'>".'>|'."</a> "; // Последняя страница
		break;
}

$data_post['action'] = (empty($data_post['action'])) ? false : $data_post['action'];
switch($data_post['action']){
	case 'add_message':

	$form_name   = trim(strip_tags($data_post['name']));
	$form_email  = trim(strip_tags($data_post['email']));
	$form_msg    = trim(strip_tags($data_post['msg']));

	if(empty($form_name) || empty($form_email) || empty($form_msg)) {
			echo $messages['form_error'];
		} else {
			$query = "INSERT INTO messages (name, email, msg) VALUES ('$form_name', '$form_email', '$form_msg')";
			$sql = mysqli_query($dbc, $query);
		}
		if($sql) {
			echo $messages['msg_send'];
		} else {
			echo $messaqes['msg_send_error'];
		}
break;
}
mysqli_close($dbc);
?>