<!DOCTYPE html>
<html lang="en">

<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--  LOGIN SCRIPT -->
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php
if (isset($_POST['login-submit'])) {

  $errorArray = array();

  $email = htmlentities($_POST['email']);
  $password = htmlentities($_POST['password']);
  
  if (empty($email) || empty($password)) {
    $_SESSION['message'] = 'please provide email and username';
  } else {
    header("Location: http://localhost:8888/mail-fetcher/dashboard.php");
  }

}
?>
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--  PAGE CONTENT -->
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->

  <?php include('./partials/head.php'); ?>
  <body>
  <div id="page-wrapper">
  
  <?php include('./partials/header.php'); ?>

    <form id="login-form" action="index.php" method="POST">
      <label class="login-form__label" for="email">E-Mail Adresse</label>
      <input class="login-form__input" name="email" type="text" placeholder="Bitte fügeb Sie hier Ihre E-Mail Addresse ein...">
      <label class="login-form__label" for="password">Passwort</label>
      <input class="login-form__input" name="password" type="text" placeholder="Bitte fügeb Sie hier Ihr Passwort ein...">
      <input class="login-form__submit" name="login-submit" type="submit" value="Einloggen">
    </form>


  <div id="notifier">
    <?php
      if(isset($_SESSION['message'])) {
          echo $_SESSION['message'];
          unset($_SESSION['message']);
      }
    ?>
  </div>
  </div>
  </body>
</html>