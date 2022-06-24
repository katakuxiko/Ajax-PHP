<?php 
 $connect = mysqli_connect('localhost', 'root', '', 'test');
 if(!$connect){
	 die("Could not connect to db");
 }
try {
	$pdo = new PDO('mysql:dbname=test; host=localhost', 'root', '');
} catch (PDOException $e) {
	die($e->getMessage());
}
