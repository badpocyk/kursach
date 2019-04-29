<?php session_start();
  unset($_SESSION['log']);
  unset($_SESSION['username']);
  echo "You're exit! <br>";
  echo '<script>window.location.href = "index.php";</script>';
 ?>
