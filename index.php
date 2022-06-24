<?php
session_start();
$userL = $_SESSION['user']['login'];

include 'inc/connect.php';
$users = mysqli_query($connect, "SELECT * FROM `users`");
$posts = mysqli_query($connect, "SELECT * FROM `posts`");
mysqli_num_rows($posts);

$sql = $pdo->prepare("SELECT * FROM `posts` ORDER BY `id` DESC LIMIT 6");
$sql->execute();
$result = $sql->fetchAll();
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
    <link rel="stylesheet" href="styles/style.css">
    <link rel="shortcut icon" href="images/brain-logoIcon.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light white-nav">
        <div class="container">
            <a href="#"><img src="images/AI-logo.png" alt="logo" class="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ml-5" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-3">
                        <a class="nav-link" aria-current="page" href="pages/posts.php">Курсы</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a href="pages/profile.php" class=" nav-link" href="../pages/profile.php">Личный кабинет</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="pages/myposts.php">Ваши посты</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="pages/create.php">Добавить статью</a>
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
						<li><a class="dropdown-item" href="pages/profile.php">Личный кабинет</a></li>
						<li><a class="dropdown-item" href="#">О нас</a></li>
						<li><a class="dropdown-item" href="#">Статьи</a></li>
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
    <!-- Вход -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Вход</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Логин:</label>
                            <input type="email" name="login" class="form-control" id="login-name-auth" placeholder="example@gmail.com">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Пароль:</label>
                            <input type="password" name="password" class="form-control" id="password-auth" placeholder="qwerty123">
                            <div class="modal-footer d-flex justify-content-between">
                                <div>
                                    <button type="button" class="btn btn-info text-white" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal">Зарегестироваться</button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                    <button type="submit" value="Войти" class="btn btn-primary login-btn">Войти</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="res">
                        <h5 class="error"></h5>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- Регистрация -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Регистрация</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Логин: *</label>
                            <input type="email" name="r_login" class="form-control" id="login-name" placeholder="example@gmail.com">
                            <label for="message-text" class="col-form-label">Ваше имя: *</label>
                            <input type="text" name="username" class="form-control" id="userName" placeholder="John">
                            <label for="message-text" class="col-form-label">Ваша иконка:</label>
                            <input type="file" name="icon" class="form-control" id="userIcon">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Пароль: *</label>
                            <input type="password" name="r_password" class="form-control" id="password" placeholder="qwerty123">

                            <label for="message-text" class="col-form-label">Повторите пароль: *</label>
                            <input type="password" name="re_password" class="form-control" id="password-repeat" placeholder="qwerty123">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                <button type="submit" value="Войти" class="btn btn-primary registration-btn">Зарегистироваться</button>

                            </div>

                        </div>

                    </form>
                    <div class="res">
                        <h5 class="errorR"></h5>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="head-main">
        <div class="container py-5 text-center">
            <h5 class="succses"><?php echo $_SESSION['message'];
                                unset($_SESSION['message']) ?></h5>
            <h1 class="title py-2">Главный заголовок сайта</h1>

            <p class="head-main-text py-2">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Distinctio vitae natus repellendus.
            </p>
            <a href="#" class="btn main-button mt-5">Кнопка</a>
        </div>
    </div>
    <div class="main">
        <div class="container py-5">
            <div class="row g-5">
                <div class="main-left col-lg-6">
                    <h5 class="up-title text-uppercase">Надзаголовок</h5>
                    <h2 class="title">Название урока</h2>
                    <p class="main-text pt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit maxime tempore consequatur dolorem vel cupiditate! Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, error?</p>
                    <div class="flex pt-3">
                        <a href="#" class="btn start-button">Приступить к изучению</a>
                        <p class="pages-text">Набор из 0 страниц обучения</p>
                    </div>
                </div>
                <div class="main-right col-lg-6">
                    <img src="images/500x480.png" alt="pic" class="kurs-img">
                </div>
            </div>
        </div>
    </div>

    <div class="cards py-4">
        <div class="container">
            <h2 class="text-center catalog-title my-5">Каталог курсов</h2>
            <div class="row justify-content-center g-4">
                <?php

                foreach ($result as $value) { ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <!-- <img src="" class="card-img-top" alt="..."> -->
                            <div class="card-body px-5">
                                <h5 class="card-title pt-2"><?= $value['title'] ?></h5>
                                <p class="card-text py-3"><?= $value['description'] ?></p>
                                <a href="<?= $value['PDF'] ?>" class="btn my-btn">Открыть PDF</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="cards py-4">
        <div class="container">
            <h2 class="text-center catalog-title my-5">Что вы получите пройдя это обучение</h2>
            <div class="row justify-content-center g-5">
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 text-center">
                        <div class="card-body">
                            <p class="number">1</p>
                            <h5 class="card-title bold-title">Коротко опишите выгоду </h5>
                            <p class="card-text">Описание для раскрытия дополнительных деталей</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 text-center">
                        <div class="card-body">
                            <p class="number">2</p>
                            <h5 class="card-title bold-title">Коротко опишите выгоду </h5>
                            <p class="card-text">Описание для раскрытия дополнительных деталей</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 text-center">
                        <div class="card-body">
                            <p class="number">3</p>
                            <h5 class="card-title bold-title">Коротко опишите выгоду </h5>
                            <p class="card-text">Описание для раскрытия дополнительных деталей</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 text-center">
                        <div class="card-body">
                            <p class="number">4</p>
                            <h5 class="card-title bold-title">Коротко опишите выгоду </h5>
                            <p class="card-text">Описание для раскрытия дополнительных деталей</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 text-center">
                        <div class="card-body">
                            <p class="number">5</p>
                            <h5 class="card-title bold-title">Коротко опишите выгоду </h5>
                            <p class="card-text">Описание для раскрытия дополнительных деталей</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 text-center">
                        <div class="card-body">
                            <p class="number">6</p>
                            <h5 class="card-title bold-title">Коротко опишите выгоду </h5>
                            <p class="card-text">Описание для раскрытия дополнительных деталей</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="digits py-4">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-4">
                    <p class="num"><?= mysqli_num_rows($users); ?></p>
                    <p class="num-text">Зарегестрированных пользователей</p>
                </div>
                <div class="col-lg-4">
                    <p class="num"><?= mysqli_num_rows($posts); ?></p>
                    <p class="num-text">Добавлено статей</p>
                </div>
                <div class="col-lg-4">
                    <p class="num">24/7</p>
                    <p class="num-text">поддержка</p>
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

    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
</body>

</html>