<?php

	//Получаем данные из глобальной переменной $_GET, так как мы передаем данные методом GET
	$name = $_GET['name']; // Вытаскиваем имя в переменную
    $email = $_GET['email']; // Вытаскиваем почту в переменную
    $tel = $_GET['telephone']; // Вытаскиваем телефон в переменную
	$message = "Поздравляем, $name, отправка сообщений на почту $email работает"; // Формируем сообщение, отправляемое на почту
	$to = $email; // Задаем получателя письма
	$from = "noreply-site.web.cofp.ru"; // От кого пришло письмо
	$subject = "Письмо с примера простой формы сайта web.cofp.ru"; // Задаем тему письма
	$headers = "From: $from\r\nReply-To: $to\r\nContent-type: text/html; charset=utf-8\r\n"; // Формируем заголовок письма (при неправильном формировании может ломаться кодировка и т.д.)

if(!empty($name) && !empty($email) && !empty($tel)) {  // Делаем проверку
    $email_validate = filter_var($email, FILTER_VALIDATE_EMAIL);

    if(check_length($name, 2, 25) && check_length($tel, 10, 10) && $email_validate) {
        echo "Спасибо ваши данные отправленны. </b>";
    } else { // добавили сообщение
        echo "Введенные данные некорректны";
    }
} else { // добавили сообщение
    echo "Заполните пустые поля";
}

// Параметры для подключения
$db_host = "localhost";
$db_user = "root"; // Логин БД
$db_password = ""; // Пароль БД
$db_base = 'yoganameemailtel'; // Имя БД
$db_table = "yoga"; // Имя Таблицы БД

// Подключение к базе данных
$mysqli = new mysqli($db_host,$db_user,$db_password,$db_base);

// Если есть ошибка соединения, выводим её и убиваем подключение
if ($mysqli->connect_error) {
    die('Ошибка : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

$result = $mysqli->query("INSERT INTO ".$db_table." (name,email,tel) VALUES ('$name','$email','$tel')");

if ($result == true){
    echo "Информация занесена в базу данных";
}else{
    echo "Информация не занесена в базу данных";
}

//if (mail($to, $subject, $message, $headers)) { // При помощи функции mail, отправляем сообщение, проверяя отправилось оно или нет
//		echo "<p> $tel $name $email Сообщение успешно отправлено</p>"; // Отправка успешна
//	}
//	else {
//		echo "<p> $tel $name $email Что-то пошло не так, как планировалось</p>"; // Письмо не отправилось
//	}

function clean($value = "") {  //  функция для очистки данных от HTML и PHP тегов
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    return $value;
}

function check_length($value = "", $min, $max) {  // функцию для проверки длинны строки
    $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
    return !$result;
}

?>