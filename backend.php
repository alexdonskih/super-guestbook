<?php
$data = $_GET;
switch($data['action']){
	case 'add_record':

		// задаем основные переменные
		$name     = trim(strip_tags($data['name']));
		$email    = trim(strip_tags($data['email']));
		$txt      = trim(strip_tags($data['msg']));
		$redir    = '<meta http-equiv="refresh" content="1; url='.$_SERVER['HTTP_REFERER'].'">';
		$messages = array (
			'form_error' => 'Пожалуйста, заполните все формы корректно',
			'msg_send' => 'Ваше сообщение успешно отправлено',
			'file_write_error' => 'Ошибка записи в файл'
		);


		// проверка на пустоту
		if(empty($name) || empty($email) || empty($txt)) {
			echo $messages['form_error'];
			echo $redir;
		} else {
			$msg = $name.' '.$email.' '.$txt."\n";

		// открытие и запись файла
			$fp = fopen('book.txt', 'a+');
			if(fwrite($fp, $msg)){
				echo $messages['msg_send'];
			} else {
				echo $messages['file_write_error'];
			}
		fclose($fp);
		echo $redir;
		}
	break;
	case 'otheraction':

		// do other stuff
	break;
}