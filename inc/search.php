<?php 
require_once 'connect.php';
$sql = "SELECT * FROM posts WHERE title LIKE '%".$_POST['name']."%'";

$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result)>0){
	while ($value = mysqli_fetch_assoc($result)){
		$title= $value['title'];
		$description= $value['description'];
		$PDF = $value['PDF'];
		$id = $value['id'];

		echo '
								<div class="col-lg-4 col-md-6">
									<div class="card">
										<div class="card-body px-5">
											<h5 class="card-title pt-2">'. $title.' </h5>
											<p class="card-text py-3">'. $description.' </p>
											<a href="../'.$PDF.'" class="btn my-btn">Открыть PDF</a>
											<a href="?delete='.$id. '" class="btn btn-primary btn-sm mt-2" data-toggle="modal" data-target="#deleteModal'. $id. '">Полное содержание</a>
										. '.require "../pages/fullModal.php"; 
										echo'
											</div>
									</div>
								</div>
						' 
	;}
} else {
	echo '<h1>Ничего не найдено</h1>';
}