<?php

define('HOST', 'localhost');
define('USER', 'bh12571_spamol');
define('DBNAME', 'bh12571_spesivykh');
define('PASSWORD', 'uz^hlbK4PRWB');

$data_sql = array(
	'getWorks' => 'SELECT works.id, works.title, works.img, works.url, works.description FROM works'
);

function connectToDB(){
	setlocale(LC_CTYPE, array('ru_RU.utf8', 'ru_RU.utf8'));
	setlocale(LC_ALL, array('ru_RU.utf8', 'ru_RU.utf8'));
	$pdo = new PDO("mysql:dbname=".DBNAME.";charset=UTF8;host=".HOST.";", USER, PASSWORD);
	return $pdo;
}

function getDataAsArray(PDO $pdo, $sql){
	$result = $pdo->query($sql);
	return $result->fetchALL(PDO::FETCH_ASSOC);
}