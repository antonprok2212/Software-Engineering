  <?php 
  require_once("includes/connection.php");

  require("check.php");

  require "includes/header.html" 
  ?>
  <title>Запись на практику</title>
  <link rel="stylesheet" href="css/practic.css" media="screen">
  
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

  <section class="u-clearfix u-section-1" id="sec-f597">
    <div class="u-clearfix u-sheet u-sheet-1">
      <div class="u-form u-form-1">
        <form class="login100-form validate-form" action="" method="post" >
          <input type="number" name="student" value="<?php echo $id; ?>" class="u-form-control-hidden">
          <div class="u-form-group u-form-select u-form-group-1">
            <label for="select-0b21" class="u-form-control u-label">Инструктор</label>
            <div>
             
              <select id='select-0b21' name='coacher' class=' u-border-1 u-border-grey-30 u-input u-input-rectangle u-white'>
                 <?php
                $sql = "SELECT `name`,`id` FROM `users` WHERE id IN (SELECT id_user FROM coacher)";
                $result = mysqli_query($con, $sql);
                while($object = mysqli_fetch_array($result)){ ?>
                  <option value = <?php echo $object['id'] ?> > <?php echo $object['name'] ?> </option>
                <?php } ?>
              </select> 
            </div>
          </div>
          <div class="u-form-date u-form-group u-form-group-2">
            <label for="date-5431" class="u-form-control u-label">Дата и время</label>
            <input type="datetime-local" placeholder="MM/DD/YYYY" id="date-5431" name="datetime" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
          </div>
          <div class="u-form-address u-form-group u-form-group-4">
            <label for="address-f3f8" class="u-form-control u-label">Точка старта</label>
            <input type="text" placeholder="Введите Ваш адрес" id="address-f3f8" name="address" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
            <style>
              #map{
                height: 300px;
                width: 550px;
                padding: 20px;
              }
            </style>
            <div id="map">
              <script>
                let map;

              function initMap() {
                map = new google.maps.Map(document.getElementById("map"), {
                  center: { lat: 51.49591812565625, lng:31.29160024031615  },
                  zoom: 12,
                });
              }
              </script>
            </div>
            <label for="textarea-2fde" class="u-form-control u-label">(функция в разработке)</label>
          </div>
          <div class="u-form-group u-form-textarea u-form-group-5">
            <label for="textarea-2fde" class="u-form-control u-label">Комментарий</label>
            <textarea rows="4" cols="50" id="textarea-2fde" name="comment" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" placeholder="Опишите лучшее место встречи, пожелания, финиш занятия"></textarea>
          </div>
          <div class="u-align-center u-form-group u-form-submit">
            <input type="submit" name="write" value="Записаться" class="u-btn u-btn-submit u-button-style">
          </div>
        </form>

        <?php 

          if(isset($_POST['write'])){

              $id_student = htmlspecialchars($_POST['student']);
              $id_coacher = htmlspecialchars($_POST['coacher']);
              $datetime = htmlspecialchars($_POST['datetime']);
              $address = htmlspecialchars($_POST['address']);
              $comment = htmlspecialchars($_POST['comment']);
              mysqli_query($con,"INSERT INTO `practice`SET 
                id_student='".$id_student."',
                id_coacher='".$id_coacher."', 
                datetime='".$datetime."',
                address='".$address."',
                comment='".$comment."'     
                ");
              echo $con->error;
              echo "<p align='center'><br>Ожидайте потвердения <p>";
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
      <span>Website Template</span>
    </a>
    <p class="u-text">
      <span>created with</span>
    </p>
    <a class="u-link" href="https://nicepage.com/" target="_blank">
      <span>Website Builder Software</span>
    </a>. 
  </section>
</body>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtmvquYr_KiyfuhW0PBtZWLCohO4Hlm4k&callback=initMap&libraries=&v=weekly"async defer></script>
</html>