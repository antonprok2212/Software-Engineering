  <?php 
  require_once("includes/connection.php");
  require("check.php");
    require "includes/header.html" 
    ?>
    <title>Профиль</title>
    <link rel="stylesheet" href="css/profile.css" media="screen">
    <?php 

    require "includes/header_two.html";

    if(isset($_COOKIE['hash'])){

      $hash=$_COOKIE['hash'];
      $sql = "SELECT * FROM `users` WHERE hash='$hash'";
      $result = mysqli_query($con, $sql);
      if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
      }else{
        while($row = mysqli_fetch_array($result)){
          $id=$row['id'];
          $name=$row['name'];
          $surname=$row['surname'];
          $sex=$row['sex'];
          $phone=$row['phone'];
          $email=$row['email'];
          $login=$row['login'];
        }
      }
    }
    ?>
    <section class="u-clearfix u-section-1" id="sec-b152">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-form u-form-1">
          <form class="login100-form validate-form" action="" method="post" >
                      <span >Логин: <?php echo $login; ?> </span>
            <div class="u-form-group u-form-name">
              <input type="text" placeholder="Имя"value="<?php echo $name; ?>" id="name-6671" name="name" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
            </div>

            <div class="u-form-email u-form-group">
              <input type="text" placeholder="Фамилия"value="<?php echo $surname; ?>" id="name-6671" name="surname" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
            </div>

            <div class="u-form-group u-form-group-3">
              <input type="text" placeholder="Почта"value="<?php echo $email; ?>" id="text-5c70" name="email" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
            </div>

            <div class="u-form-group u-form-group-4">
              <input type="text" placeholder="Телефон(+380-xx-xxx-xxxx)"value="<?php echo $phone; ?>" id="text-276b" name="phone" type="tel" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
            </div>   
            <div class="u-form-group u-form-group-6">
              <input type="password" placeholder="Введите новый пароль" id="text-6954" name="password" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white">
            </div>
            <div class="u-form-group u-form-radiobutton u-form-group-7">
              <div class="u-form-radio-button-wrapper">
                <input type="radio" name="sex" value="Мужчина" <?php if($sex=="Мужчина"){echo 'checked=""';}?> >
                <label class="u-label" for="radiobutton">Мужчина</label>
                <br>
                <input type="radio" name="sex" value="Женщина" <?php if($sex=="Женщина"){echo 'checked=""';}?> >
                <label class="u-label" for="radiobutton">Женщина</label>
                <br>
              </div>
            </div>

          <div class="u-align-center u-form-group u-form-submit">
            <input class="login100-form-btn" name="edit" type="submit" value="Редактировать">
          </div>

          </form>

          <?php 
          if(isset($_POST['edit'])){
              $name2 = htmlspecialchars($_POST['name']);
              $surname2 = htmlspecialchars($_POST['surname']);
              $sex2 = htmlspecialchars($_POST['sex']);
              $email2 = htmlspecialchars($_POST['email']);
              $phone2 = htmlspecialchars($_POST['phone']);
              $password2 = md5(md5(trim($_POST['password'])));
              mysqli_query($con,"UPDATE `users` SET name='".$name2."',
                surname='".$surname2."',
                sex='".$sex2."', 
                phone='".$phone2."',
                email='".$email2."',
                password='".$password2."' WHERE `users`.`id` = '".$id."'");
              echo "<p align='center'><br>Изменения успешно сохранены <p>";
            }
            
          ?>

        </div>
      </div>
    </section>


    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-8ddc"><div class="u-clearfix u-sheet u-sheet-1">
      <p class="u-small-text u-text u-text-variant u-text-1">Все права защищены</p>
    </div></footer>
    <section class="u-backlink u-clearfix u-grey-80">
      <a class="u-link" href="https://nicepage.com/website-templates" target="_blank">
        <span>Website Templates</span>
      </a>
      <p class="u-text">
        <span>created with</span>
      </p>
      <a class="u-link" href="https://nicepage.com/" target="_blank">
        <span>Website Builder Software</span>
      </a>. 
    </section>
  </body>
  </html>