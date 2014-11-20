<?php

session_start(); //Запускаем сессии

/** 
 * Класс для авторизации
 */ 

require_once 'config.php';

class AuthClass {
    /**
     * Проверяет, авторизован пользователь или нет
     * Возвращает true если авторизован, иначе false
     */

    public function connectDB($user=null){
        $pdo = connectToDB();
        $res = getDataAsArray($pdo, "SELECT users.login, users.password FROM users");
        if(isset($user)){ 
            return $res[0]['login']; 
        }else{
            return $res[0]['password'];
        }
    }

    public function isAuth() {
        if (isset($_SESSION["is_auth"])) { //Если сессия существует
            return $_SESSION["is_auth"]; //Возвращаем значение переменной сессии is_auth (хранит true если авторизован, false если не авторизован)
        }
        else return false; //Пользователь не авторизован, т.к. переменная is_auth не создана
    }

    /**
     * Авторизация пользователя
     * @param string $login
     * @param string $passwors 
     */

    public function auth($login, $passwors) {
        if ($login == $this->connectDB('login') && md5($passwors) == $this->connectDB()) { //Если логин и пароль введены правильно
            $_SESSION["is_auth"] = true; //Делаем пользователя авторизованным
            $_SESSION["login"] = $login; //Записываем в сессию логин пользователя
            return true;
        }
        else { //Логин и пароль не подошел
            $_SESSION["is_auth"] = false;
            return false; 
        }
    }    

    /**
     * Метод возвращает логин авторизованного пользователя 
     */

    public function getLogin() {
        if ($this->isAuth()) { //Если пользователь авторизован
            return $_SESSION["login"]; //Возвращаем логин, который записан в сессию
        }
    }

    public function out() {
        $_SESSION = array(); //Очищаем сессию
        session_destroy(); //Уничтожаем
    }
}

$auth = new AuthClass();

if (isset($_POST["login"]) && isset($_POST["password"])) { //Если логин и пароль были отправлены
    if (!$auth->auth($_POST["login"], $_POST["password"])) { //Если логин и пароль введен не правильно
        //echo "error";
        return false;
    }
}

if (isset($_GET["is_exit"])) { //Если нажата кнопка выхода
    if ($_GET["is_exit"] == 1) {
        $auth->out(); //Выходим
        header("Location: ?is_exit=0"); //Редирект после выхода
    }
}

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Личный сайт Спесивых Максим</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="./apple-touch-icon-precomposed.png">
        <link rel="shortcut icon" href="./favicon.ico">
        <link rel="icon" href="./favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="font/fira.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/media-queries.css" >

        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body class="admin">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!--[if gte IE 9]>
          <style type="text/css">
            .gradient {
               filter: none;
            }
          </style>
        <![endif]-->
        <!--[if lt IE 9]>
            <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->
<div class="adminAuth">
<?php if ($auth->isAuth()) { // Если пользователь авторизован, приветствуем:  
    echo "<div class='titleBlock'>Добро пожаловать!</div>";
    echo "<h2>Здравствуйте, ".$auth->getLogin()."</h2>" ;
    echo "<a href=\"portfolio\" class='logoutAdmin bigSize'>Добавить работу</a>"; //Показываем кнопку выхода
    echo "<a href=\"?is_exit=1\" class='logoutAdmin'>Выйти</a>"; //Показываем кнопку выхода
} else { //Если не авторизован, показываем форму ввода логина и пароля
?>

<div class="titleBlock">Авторизируйтесь</div>
<div class="answerServ">Логин/пароль введен не верно</div>
    <form method="post" action="" id="adminAuth">
        <div class="inputWrap">
            <label for="login">Логин:</label>
            <input type="text" name="login" value="" /><br/>
        </div>
        <div class="inputWrap">
            <label for="password">Пароль:</label>
            <input type="password" name="password" value="" /><br/>
        </div>
        <input type="submit" value="Войти" class="submitAdmin" />
    </form>
<?php 
    }
    echo "</div>";
    include "footer.php";
 ?>