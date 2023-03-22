<!DOCTYPE html>
<html lang="en">
<head>
	<title>Регистрация</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/mainlogin.css">

</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="" method="post">
					<span class="login100-form-title">
						Регистрация
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Введите имя">
						<input class="input100" type="text" name="name" placeholder="Имя">
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Введите фамилию">
						<input class="input100" type="text" name="surname" placeholder="Фамилия">
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Введите почту,пример: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Ел.почта">
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Введите пароль">
						<input class="input100" type="text" name="login" placeholder="Логин(для входа)">
					</div>


					<div class="wrap-input100 validate-input" data-validate = "Введите пароль">
						<input class="input100" type="password" name="password" placeholder="Пароль">
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Введите телефон">
						<input class="input100" type="tel" name="phone" placeholder="Телефон">
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Выберете пол">
						<p class="radio"><input class="input100" type="radio" name="sex" value="Мужчина">Мужчина</p>
						<p class="radio"><input class="input100" type="radio" name="sex" value="Мужчина">Женщина</p>
					</div>

					<div class="container-login100-form-btn">
						<input class="login100-form-btn" name="register" type="submit" value="Зарегистрироваться">
					</div>
				</p>
				<div class="text-center p-t-20">
					Уже есть аккаунт?
					<a class="txt2" href="login.php">
						Войти
					</a>
				</div>
				<div class="text-center p-t-20">
						<a class="txt2" href="../index.php">
							<i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
							На главную
							
						</a>
				</div>
			</form>	

			<?php require_once("includes/connection.php");

			if(isset($_POST['register'])){
				$err = [];

				    // проверям логин
				if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
				{
					$err[] = "Логин может состоять только из букв английского алфавита и цифр";
				}

				if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
				{
					$err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
				}

				    // проверяем, не сущестует ли пользователя с таким именем
				$query = mysqli_query($con, "SELECT id FROM users WHERE login='".mysqli_real_escape_string($con, $_POST['login'])."'");
				if(mysqli_num_rows($query) > 0)
				{
					$err[] = "Пользователь с таким логином уже существует в базе данных";
				}

				    // Если нет ошибок, то добавляем в БД нового пользователя
				if(count($err) == 0)
				{
					$name = htmlspecialchars($_POST['name']);
					$surname = htmlspecialchars($_POST['surname']);
					$sex = htmlspecialchars($_POST['sex']);
					$email = htmlspecialchars($_POST['email']);
					$phone = htmlspecialchars($_POST['phone']);
					$login = htmlspecialchars($_POST['login']);
					$password = md5(md5(trim($_POST['password'])));

					mysqli_query($con,"INSERT INTO users SET name='".$name."',
						surname='".$surname."',
						sex='".$sex."', 
						phone='".$phone."',
						email='".$email."',
						login='".$login."',
						password='".$password."'");
					header("Location: sucreg.php"); exit();
				}
				else
				{
					print "<b>При регистрации произошли следующие ошибки:</b><br>";
					foreach($err AS $error)
					{
						print $error."<br>";
					}
				}
			}
			?>
		</div>
	</div>
</div>




<!--===============================================================================================-->	
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/tilt/tilt.jquery.min.js"></script>

<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
</html>