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
  <div id="dashboard-wrapper">

    <div class="mail-list">mail list</div>
    <div class="mail-meta">mail list</div>
    <div class="mail-content">mail list</div>
  </div>

  </div>
  </body>
</html>