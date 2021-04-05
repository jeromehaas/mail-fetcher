<header id="header">
  <h1 class="header__logo">MailFetcher</h1>
  <?php
  if ($_SESSION['loggedIn']) {
   echo '<a class="header__logout" href="http://localhost:8888/mail-fetcher/">Logout</a>';
  }
  ?>
</header>