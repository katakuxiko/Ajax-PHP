<?php
	session_start();
	require_once 'connect.php';

	$r_login = $_POST['r_login'];
	$username = $_POST['username'];
	$r_password = $_POST['r_password'];
	$re_password = $_POST['re_password'];

	$error_fields = [];

	$checkLogin = mysqli_query($connect,"SELECT * FROM users WHERE login = '$r_login'");

if(mysqli_num_rows($checkLogin)>0){
	$response = [
		"status" => false,
		"type"=>1,
		"message" => "Такой пользователь уже существует",
		"fields" =>['r_login']
	];

	echo json_encode($response);
	die();
}

if ($r_login ==''){
	$error_fields[] ='r_login';
}
if ($username == '') {
	$error_fields[] = 'username';
}
if ($r_password == '') {
	$error_fields[] = 'r_password';
}
if ($re_password == '') {
	$error_fields[] = 're_password';
}
	if (!empty($error_fields)) {
		$response = [
			"status" => false,
			"type" => 1,
			"message" => "Вы не заполнили некоторые поля",
			"fields" => $error_fields
		];

		echo json_encode($response);

		die();
	}

	//if($r_login != null && $r_password != null && $re_password != null && $username != null){
	if ($r_password === $re_password ){
		if($_FILES['icon']['type']==='image/png' || $_FILES['icon']['type'] === 'image/jpeg'){
		
			$path ='images/uploads/'. time() . $_FILES['icon']['name'];
			if(!move_uploaded_file($_FILES['icon']['tmp_name'],'../' . $path)){
				$_SESSION['message'] = 'Ошибка при загрузке иконки';
				header('Location: ../index.php');
		 }
	} else if($_FILES['icon']['name'] === null){
		$path = 'images/uploads/standart.jpg';
	}
	 else {
		$response = [
			"status" => false,
			"message" => "Поддерживается только PNG/JPEG"
		];
		echo json_encode($response);
		die();
	}
		
		$r_password = md5($r_password);
		mysqli_query($connect, "INSERT INTO `users` (`id`, `name`, `login`, `password`, `icon`) 
		VALUES (NULL, '$username','$r_login' , '$r_password', '$path')");
		$response = [
			"status" => true,
			"message" => "Вы успешно зарегистрировались"
		];
		$_SESSION['message'] = "Вы успешно зарегистрировались";
		echo json_encode($response);

	}else{
		$response = [
			"status" => false,
			"type" => 2,
			"message" => "Пароли не совпадают"
		];
		echo json_encode($response);
	}	
// } else {
// 	$_SESSION['message'] = 'Возможно вы не ввели некоторые обязательные данные';
// 	header('Location: ../index.php');
// }
	
	?>