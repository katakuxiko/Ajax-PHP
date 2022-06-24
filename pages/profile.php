<?php
session_start();

if (!$_SESSION['user']) {
	header('Location: ../index.php');
}
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
	<nav class="navbar navbar-expand-lg navbar-light bg-light white-nav">
		<div class="container">
			<a href="../index.php"><img src="../images/AI-logo.png" alt="logo" class="logo"></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse ml-5" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item mx-3">
						<a class="nav-link" aria-current="page" href="../pages/posts.php">Курсы</a>
					</li>
					<li class="nav-item mx-3">
						<a class="profile nav-link" href="../pages/profile.php">Личный кабинет</a>
					</li>
					<li class="nav-item mx-3">
						<a class="nav-link" href="myposts.php">Ваши статьи</a>
					</li>
					<li class="nav-item mx-3">
						<a class="nav-link" href="create.php">Добавить статью</a>
					</li>
				</ul>
				<!-- Default dropstart button -->
				<div class="btn-group dropstart">
					<button type="button" class="btn btn-primary dropdown-toggle login-button text-uppercase" data-bs-toggle="dropdown" aria-expanded="false">
						<?= $_SESSION['user']['login'] ?>
					</button>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="../index.php">Курсы</a></li>
						<li><a class="dropdown-item" href="myposts.php">Ваши статьи</a></li>
						<li><a class="dropdown-item" href="../pages/posts.php">Статьи</a></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li> <a href="../inc/log_out.php" class="dropdown-item" href="#">Выход</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>

	<div class="main">
		<div class="container py-5">
			<div class="row g-5">
				<div class="col-lg-4 col-md-6">
					<div class="card">
						<img src="../<?= $_SESSION['user']['icon'] ?>" class="card-img-top" alt="...">
						<div class="card-body px-5">
							<h5 class="card-title pt-2">Ваш id: <?= $_SESSION['user']['id'] ?></h5>
							<p class="card-text py-3">Если вам не нравится ваша аватарка и вы хотите изменить её</p>
						</div>
					</div>
				</div>
				<div class="main-right col-lg-8">
					<h2 class="title"><?= $_SESSION['user']['username'] ?></h2>
					<p class="main-text pt-3">
						Здраствуй <?= $_SESSION['user']['username'] ?>, поздравляю тебя с регистрацией на нашем сайте,
						наш сайт является учебной платформой, где ты сможешь изучить то, что оставили другие пользователи,
						это различные курсы, книги, материалы в pdf формате, всё это ты можешь найти нажав на кнопку которая находится ниже.
					</p>
					<div class="flex pt-3">
						<a href="../pages/posts.php" class="btn start-button">Приступить к изучению</a>
					</div>
					<p class="main-text pt-3">
						Или же уважаемый <?= $_SESSION['user']['username'] ?>, вы хотите помочь нам и наполнить сайт курсами,
						книгами или же материалами в pdf формате, если это так, уважаемый <?= $_SESSION['user']['username'] ?>,
						нажмите на кнопку которая находится ниже
					</p>
					<div class="flex pt-3">
						<a href="create.php	" class="btn start-button">Создать курс</a>
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
	<script src="../js/main.js"></script>
</body>

</html>