

<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--  LOGIN SCRIPT -->
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php

session_start();
$_SESSION['loggedIn'] = false;

if (isset($_POST['login-submit'])) {

  $host = htmlentities($_POST['host']);
  $host = '{' . $host . '}';
  $username = htmlentities($_POST['username']);  
  $password = htmlentities($_POST['password']);
  $imap = imap_open($host, $username, $password);
  $mailboxheaders = imap_headers($mailbox);

  if (empty($username) || empty($password)) {
    $_SESSION['message'] = 'Bitte geben Sie Host, Benutzernamen und Passowrt Ihres Postfachs an.';
  } else if ($imap == false) {
    $_SESSION['message'] = 'Die angegebenen Zugangsdaten sind nicht korrekt.';
  } else {
    $_SESSION['host'] = $host;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    header("Location: http://localhost:8888/mail-fetcher/dashboard.php");

  }

}
?>
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--  PAGE CONTENT -->
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">
  <?php include('./partials/head.php'); ?>
  <body>
  <div id="page-wrapper">
  
  <?php include('./partials/header.php'); ?>

    <form id="login-form" action="index.php" method="POST">
      <label class="login-form__label" for="email">Host:</label>
      <input class="login-form__input" name="host" type="text" placeholder="Bitte fügen Sie hier Ihre E-Mail Addresse ein...">
      <label class="login-form__label" for="email">Benutzername:</label>
      <input class="login-form__input" name="username" type="text" placeholder="Bitte fügen Sie hier Ihren Benutzernamen ein...">
      <label class="login-form__label" for="password">Passwort:</label>
      <input class="login-form__input" name="password" type="text" placeholder="Bitte fügen Sie hier Ihr Passwort ein...">
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