<?php

require_once 'config.php';

$projectName = htmlspecialchars(strip_tags(trim($_POST['titleWork'])), ENT_QUOTES);
$projectUrl = trim($_POST['urlWork']);
$projectDesc = $_POST['descWork'];

function transliterate($st) {
  $st = strtr($st, 
    "абвгдежзийклмнопрстуфыэАБВГДЕЖЗИЙКЛМНОПРСТУФЫЭ",
    "abvgdegziyklmnoprstufieABVGDEGZIYKLMNOPRSTUFIE"
  );
  $st = strtr($st, array(
    'ё'=>"yo",    'х'=>"h",  'ц'=>"ts",  'ч'=>"ch", 'ш'=>"sh",  
    'щ'=>"shch",  'ъ'=>'',   'ь'=>'',    'ю'=>"yu", 'я'=>"ya",
    'Ё'=>"Yo",    'Х'=>"H",  'Ц'=>"Ts",  'Ч'=>"Ch", 'Ш'=>"Sh",
    'Щ'=>"Shch",  'Ъ'=>'',   'Ь'=>'',    'Ю'=>"Yu", 'Я'=>"Ya",
  ));
  return $st;
}
function str2url($str) {
    // переводим в транслит
    $str = transliterate($str);
    // в нижний регистр
    $str = strtolower($str);
    // заменям все ненужное нам на "-"
    $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
    // удаляем начальные и конечные '-'
    $str = trim($str, "-");
    return $str;
}

$uploadDir = "upload/";
$types = array("image/gif","image/png","image/jpeg","image/pjpeg","image/x-png");
$file_size = 2097152;
$file = $_FILES['files'];

if($file['size'] > $file_size || !in_array($file['type'], $types)){
	echo "Файл слишком большой или не является изображением(gif,jpg,png)";
  /*echo "<pre>";
  var_dump($file['name']);
  echo "</pre>";*/

}else if(empty($projectName) || empty($projectUrl) || empty($projectDesc)){ 
	echo "Есть пустые поля!";
}else if($file['error'] == 0){
	$filename = basename($file['name']);
	$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
	if(move_uploaded_file($file['tmp_name'], $uploadDir.str2url($filename).'.'.$extension)){
		$fileurl = $uploadDir.str2url($filename).'.'.$extension;
		$pdo = connectToDB();
		$sql = "INSERT INTO works VALUES (NULL, '$projectName','$projectUrl','$fileurl','$projectDesc')";
		if($pdo->exec($sql)){
			echo 'OK';
		}
	}else{
		echo "Возникла неизвестная ошибка";
	}
}

exit;