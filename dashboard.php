
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--  MAIL SCRIPTS -->
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php
  
  include('./environment.php');

  function openImapConnection($host, $user, $password) {
    $imap = imap_open($host, $user, $password);
    echo ($imap ? 'connection successfull' : 'connection failed');
    return $imap;
  }

  function printMailContentHTML($imap, $id) {
    $header=imap_headerinfo($imap, $id);
    $message = (imap_fetchbody($imap,$id, 2));
    print(quoted_printable_decode($message)."<br>");  
  };

  function printMailList($imap) {
    for ($i = 1; $i <= 100; $i++) {
      $headerInfo = imap_header($imap, $i);   
      echo $headerInfo->from[0]->personal . "<br />";

      $date = strtotime($headerInfo->date);
      echo date("Y.m.d  -  h:i:s", $date) . "<br /><br />";
    }
  
  };


  function getTimeFromSpecificMail($headerInfo) {
    $date = strtotime($headerInfo->date);
    echo date("Y.m.d  -  h:i:s", $date) . "<br />";
  }
  
  function getSenderNameFromSpecificMail($headerInfo) {
    echo $headerInfo->sender[0]->personal  . "<br />";
  }

  $imap = openImapConnection($host, $user, $password);
  $header = imap_header($imap, 100);
  $headerInfo = imap_headerinfo ( $imap , 8 , $from_length = 10 , $subject_length = 10);
  $totalNumberOfMessages = imap_num_msg($imap);
  $folders = imap_list($imap, "{login-21.loginserver.ch}", "*");
  $emailData = imap_search($imap, '')


  

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
    <div id="dashboard-wrapper">

      <div class="mail-list">
        <?php printMailList($imap); ?>
      </div>
      <div class="mail-meta">
        <?php 
          getSenderNameFromSpecificMail($headerInfo);
          getTimeFromSpecificMail($headerInfo);
        ?>
      </div>
      <div class="mail-content">
        <?php printMailContentHTML($imap, 8); ?>
      </div>
    </div>

    </div>
  </body>
</html>