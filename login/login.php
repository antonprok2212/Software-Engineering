
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Вход</title>
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
						Авторизация
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Введите логин">
						<input class="input100" type="text" name="login" placeholder="Логин">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Введите пароль">
						<input class="input100" type="password" name="password" placeholder="Пароль">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<input class="login100-form-btn" name="auth" type="submit" value="Войти">
					</div>

					<div class="text-center p-t-24">
						<a class="txt2" href="#">
							Забыл логин или пароль?
						</a>
					</div>

					<div class="text-center p-t-20">
						<a class="txt2" href="reg.php">
							Создать аккаунт
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
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

				function generateCode($length=6) {
					$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
					$code = "";
					$clen = strlen($chars) - 1;
					while (strlen($code) < $length) {
						$code .= $chars[mt_rand(0,$clen)];
					}
					return $code;
				}


				if(isset($_POST['auth']))
				{
    				// Вытаскиваем из БД запись, у которой логин равняеться введенному
					$query = mysqli_query($con,"SELECT id, password FROM users WHERE login='".mysqli_real_escape_string($con,$_POST['login'])."' LIMIT 1");
					$data = mysqli_fetch_assoc($query);

    				// Сравниваем пароли
					if($data['password'] === md5(md5(trim($_POST['password']))))
					{
       					// Генерируем случайное число и шифруем его
						$hash = md5(generateCode(10));
        				// Записываем в БД новый хеш авторизации и IP
						mysqli_query($con, "UPDATE users SET hash='".$hash."' WHERE id='".$data['id']."'");
						// Ставим куки
						setcookie("id", $data['id'], time()+60*60*24*30, "/");
        				setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true); // httponly !!!
						// Переадресовываем браузер на страницу проверки нашего скрипта
        				header("Location: ../genpage.php");
    }
    else
    {
    	print "Вы ввели неправильный логин/пароль";
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