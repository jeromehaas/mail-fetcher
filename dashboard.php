
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--  MAIL SCRIPTS -->
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php
  
  session_start();
  if (isset($_SESSION['host'], $_SESSION['username'], $_SESSION['password'])) {
    $host = $_SESSION['host'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $_SESSION['loggedIn'] = true;
  } else {
    header("Location: http://localhost:8888/mail-fetcher/");
  };

  function openImapConnection($host, $username, $password) {
    $imap = imap_open($host, $username, $password);
    return $imap;
  }

  function formatTime($date) {
    $date = strtotime($date);
    return date("Y.m.d  -  h:i:s", $date);
  }
 
  function printMailContentHTML($imap, $id) {
    $header=imap_headerinfo($imap, $id);
    $message = (imap_fetchbody($imap,$id, 2));
    print(quoted_printable_decode($message));  
  };

  function printMailList($imap) {
    for ($i = 1; $i <= 100; $i++) {
      $headerInfo = imap_headerinfo($imap, $i);
      echo '
      <a class="dashboard__mail-list__anchor" href="http://localhost:8888/mail-fetcher/dashboard.php?currentMail=' . $i . '">
        <li class="dashboard__mail-list__list-item">
          <p class="dashboard__mail-list__sender">' . $headerInfo->from[0]->personal . '</p>
          <p class="dashboard__mail-list__date">' . formatTime($headerInfo->date) . '</p>
        </li>
      </a>';
    }
  };

  function printMailMeta($headerInfo) {
    echo '
    <img class="dashboard__mail-meta__img" src="./media/icons/avatar.svg" alt="Avatar">
    <div class="dashboard__mail-meta__text">          
      <p class="dashboard__mail-meta__sender">' . $headerInfo->sender[0]->personal . '</p>
      <p class="dashboard__mail-meta__date">' . formatTime($headerInfo->date) .  '</p>
    </div>';
  }

  $imap = openImapConnection($host, $username, $password);
  $headerInfo = imap_headerinfo( $imap , $_GET['currentMail'] ?? 1);
  $totalNumberOfMessages = imap_num_msg($imap);
  $folders = imap_list($imap, "{login-21.loginserver.ch}", "*");
  $emailData = imap_search($imap, '');
  $currentMail = $_GET['currentMail'] ?? 1;
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
    <div id="dashboard__wrapper">

      <div class="dashboard__mail-list">
        <ul class="dashboard__mail-list__list">
          <?php printMailList($imap); ?>
        </ul>
      </div>

      <div class="dashboard__mail-meta">
        <?php printMailMeta($headerInfo); ?>
      </div>       
         
      <div class="dashboard__mail-content">
        <?php printMailContentHTML($imap, $currentMail); ?>
      </div>

    </div>

    </div>
  </body>
</html>