﻿<?php
$data = $_GET;
switch($data['action']){
	case 'add_record':
		// добавляем в файл
		$name = trim(strip_tags($data['name']));
		$email = trim(strip_tags($data['email']));
		$txt = trim(strip_tags($data['msg']));

		//проверка на пустоту, версия 1
		if(empty($name) || empty($email) || empty($txt)) {
			echo 'Пожалуйста, заполните все формы корректно';
			echo '<meta http-equiv="refresh" content="1; url='.$_SERVER['HTTP_REFERER'].'">';
		} else {
			$msg = $name.' '.$email.' '.$txt."\n";
				//открытие и запись файла
				$fp = fopen('book.txt', 'a+');
				$success = fwrite($fp, $msg);
					if($success){
						echo 'Ваше сообщение успешно отправлено';
				} else {
					echo 'Ошибка записи в файл';
				}
		fclose($fp);
		echo '<meta http-equiv="refresh" content="1; url='.$_SERVER['HTTP_REFERER'].'">';
		}
	break;
	case 'otheraction':
		// do other stuff
	break;
}