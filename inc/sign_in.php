<?php
	session_start();
	require_once 'connect.php';
	
	$login = $_POST['login'];
	$password = $_POST['password'];
	$error_fields = [];


	if ($login ===''){
	$error_fields[]= 'login';
	}
	if ($password ===''){
	$error_fields[] = 'password';
	}
	if(!empty($error_fields)){
		$response =[
			"status"=>false,
			"type"=>1,
			"message"=> "Вы не заполнили некоторые поля",
			"fields"=>$error_fields
		];

	echo json_encode($response);

		die();
	}

	$password = md5($password);

	$checkUser = mysqli_query($connect,"SELECT * FROM `users` where `login` = '$login' and `password` = '$password'");
	if(mysqli_num_rows($checkUser)>0){

		$user = mysqli_fetch_array($checkUser);

		$_SESSION['user']=[
			"id" => $user["id"],
			"username" => $user["name"],
			"login" => $user["login"],
			"icon" => $user["icon"]
		];
	//header('Location: ../pages/profile.php');
	$response = [
		"status" => true
	];
		echo json_encode($response);
	}
	else {
		$response = [
			"status" => false,
			"message" =>"Неверный логин или пароль"
		];
	echo json_encode($response);
}
?>