<?php
session_start();

if (!$_SESSION['user']) {
	header('Location: ../index.php');
}

include '../inc/func.php';

// require_once '../inc/connect.php';
// $id = $_SESSION['user']['id'];
// $sql = $pdo->prepare("SELECT * FROM `posts` WHERE `userId` = $id;");
// $sql->execute();
// $result = $sql->fetchAll();




?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AI Learn</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../styles/style.css">
	<link rel="shortcut icon" href="../images/brain-logoIcon.png">
	
</head>

<body>
	<div class="main">
		<div class="container py-5 ">
			<div class="row g-5">
				<nav class="navbar navbar-expand-lg navbar-light bg-light white-nav">
					<div class="container">
						<a href="#"><img src="../images/AI-logo.png" alt="logo" class="logo"></a>
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse ml-5" id="navbarSupportedContent">
							<ul class="navbar-nav me-auto mb-2 mb-lg-0">
								<li class="nav-item mx-3">
									<a class="nav-link" aria-current="page" href="posts.php">Курсы</a>
								</li>
								<li class="nav-item mx-3">
									<a href="profile.php" class=" nav-link">Личный кабинет</a>
								</li>
								<li class="nav-item mx-3">
									<a class="nav-link" href="#">Ваши посты</a>
								</li>
								<li class="nav-item mx-3">
									<a class="nav-link" href="create.php">Добавить статью</a>
								</li>
							</ul>
							<?php
							if (!$_SESSION['user']) {
								echo '<button type="button" class="px-4 btn login-button text-uppercase" data-bs-toggle="modal" data-bs-target="#loginModal">Войти</button>';
							} else {
								echo '
                <div class="btn-group dropstart">
					<button type="button" class="btn btn-primary dropdown-toggle login-button text-uppercase" data-bs-toggle="dropdown" aria-expanded="false">
					' . $_SESSION["user"]["login"] . '
					</button>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="profile.php">Личный кабинет</a></li>
						<li><a class="dropdown-item" href="#">Ваши посты</a></li>
						<li><a class="dropdown-item" href="posts.php">Курсы</a></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li> <a href="inc/log_out.php" class="dropdown-item" href="#">Выход</a></li>
					</ul>
				</div>';
							}
							?>


						</div>
					</div>
				</nav>


				<div class="col-lg-4 col-md-6">
					<div class="card">
						<img src="../<?= $_SESSION['user']['icon'] ?>" class="card-img-top" alt="...">
						<div class="card-body px-5">
							<h5 class="card-title pt-2">Ваш id: <?= $_SESSION['user']['id'] ?></h5>
							<p class="card-text py-3">Здесь отображены все ваши посты</p>
						</div>
					</div>
				</div>

				<div class="main-right col-lg-8">
					<div class="row justify-content-center g-4">
						<?php

						foreach ($result as $value) { ?>
							<div class="col-lg-4 col-md-6">
								<div class="card">
									<!-- <img src="" class="card-img-top" alt="..."> -->
									<div class="card-body px-5">
										<h5 class="card-title pt-2"><?= $value['title'] ?></h5>
										<p class="card-text py-3"><?= $value['description'] ?></p>
										<a href="../<?= $value['PDF'] ?>" class="btn btn-primary ">Открыть PDF</a>
										
										<a href="?delete=<?= $value['id'] ?>" class="btn btn-danger btn-sm mt-2" data-toggle="modal" data-target="#deleteModal<?= $value['id'] ?>">Удалить пост</a>
										<?php require 'modal.php'; ?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>


			</div>
		</div>
	</div>

	<footer class="footer mt-3">
		<div class="container py-5 text-center">
			<div class="footer-links pb-2">
				<a href="">Согласие на обработку данных</a>
				<a href="">Служба поддержки</a>
				<a href="">Политика конфиденциальности</a>
			</div>
			<p class="footer-text">© nazvaniesaita.ru, 2054 | Название компании или ИП ОГРН 0000000000000</p>
		</div>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		</body>

		</html>