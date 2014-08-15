<?php
$data = $_GET;
switch($data['action']){
	case 'add_record':

		// задаем основные переменные
		$name     = trim(strip_tags($data['name']));
		$email    = trim(strip_tags($data['email']));
		$txt      = trim(strip_tags($data['msg']));
		$date     = date('Y-m-d G:i:s');
		$redir    = '<meta http-equiv="refresh" content="1; url='.$_SERVER['HTTP_REFERER'].'">';

		$messages = array (
			'form_error'       => 'Пожалуйста, заполните все формы корректно',
			'msg_send'         => 'Ваше сообщение успешно отправлено',
			'file_write_error' => 'Ошибка записи в файл'
		);
		echo $redir;

		// проверка на пустоту
		if(empty($name) || empty($email) || empty($txt)) {
			echo $messages['form_error'];

		} else {
			$msg = $date.'|'.$email.'|'.$name.'|'.$txt."\n";

		// открытие и запись файла
			$fp = fopen('book.txt', 'a+');
			if(fwrite($fp, $msg)){
				echo $messages['msg_send'];
			} else {
				echo $messages['file_write_error'];
			}
		fclose($fp);
		}
	break;
	case 'get_messages':
		$messages = array (
			'file_not_found'  => 'Файл не найден',
			'fread_error'     => 'Файл не может быть прочитан',
		);
		$filename = 'book.txt';

		// проверка существования файла
		if(file_exists($filename)) {

			//проверка читабельности файла
			if(is_readable($filename)) {

				//открываем файл и помещаем его содержимое в массив
				$fp = fopen($filename, 'r+');
				$content = file($filename);
					if(is_array($content)) {

						// помещаем элементы массива в список
						echo '<ul>';

						// проходимся по массиву и выводим форматированный результат
						foreach($content as $line) {
							list($date, $email, $name, $msg) = explode('|', $line);
							echo '<li>';
							echo $date.' | '.$email.' | '.$name.' | '.$msg;
							echo '</li>';
						}
						echo '</ul>';
					}
			}else {
				echo $messages['fread_error'];
			}
		} else {
			echo $messages['file_not_found'];
		}
	break;
}