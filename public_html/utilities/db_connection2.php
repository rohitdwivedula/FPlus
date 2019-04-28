<?php
function getResult($query){
	$config = parse_ini_file('../../private/db/config.ini');
	$link = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname']);
	return mysqli_query($link, $query);
}
?>