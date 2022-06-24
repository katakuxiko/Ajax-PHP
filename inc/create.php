<?php
	session_start();
	require_once 'connect.php';

$title = $_POST['title'];
$description = $_POST['description'];
$text = $_POST['text'];
$error_fields=[];

$checkTitle = mysqli_query($connect, "SELECT * FROM posts WHERE title = '$title'");

if(mysqli_num_rows($checkTitle)>0){
	$response = [
		"status" => false,
		"type" => 1,
		"createSuccses" => "Такая статья уже существует",
		"fields" => ['title']
	];

	echo json_encode($response);
	die();
}

if ($title=="") { 
	$error_fields[] = 'title';
}
if ($description=="") {
	$error_fields[] = 'description';
}

	if (!empty($error_fields)) {
		$response = [
			"status" => false,
			"type" => 1,
		"createSuccses" => "Вы не заполнили некоторые поля",
			"fields" => $error_fields
		];

		echo json_encode($response);

		die();
	}
	if($_FILES['pdf']['type'] === "application/pdf"){
		if($_FILES['pdf']['name'] != null){
			$path ='pdf/uploads'. time() . $_FILES['pdf']['name'];
			if(!move_uploaded_file($_FILES['pdf']['tmp_name'],'../' . $path)){
			$response = [
				"status" => false,
				"createSuccses" => "Ошибка загрузки файла"
				
			];

			echo json_encode($response);

		} } else {
		$path = '';
	}
}
		else{
		$response = [
		"status" => false,
		"createSuccses" => "Вы загрузили не PDF файл"
		];
		echo json_encode($response);
			die();	
		}
		$userid = $_SESSION['user']['id'];
		mysqli_query($connect, "INSERT INTO `posts`(`id`, `title`, `description`, `text`, `PDF`, `userId`)
		 VALUES (null,'$title','$description','$text','$path',$userid);	");


		$response = [
			"status" => true,
	"createSuccses" => "Пост добавлен"
		];
		echo json_encode($response);
