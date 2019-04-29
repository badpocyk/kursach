<?php session_start();
echo "<form action='index.php' method='post'>";
$db=mysqli_connect("localhost","root","","mysql") or die("Ooops...".mysqli_error($db));
if(isset($_REQUEST['Login']))
{
  $login=$_REQUEST['log_in'];
  $password=$_REQUEST['password'];
  if (empty($login) || empty($password))
  {
    echo "Zapolnite vse polya!<br>";
    echo "<a href='users.php'>Back</a>";
  }
  elseif( mysqli_num_rows(mysqli_query($db, "SELECT * FROM login WHERE log_in = '$login' AND password='$password'")))
  {
          if($login=="admin" && $password=="root")
          {
            $_SESSION['log'] = true;
		        $_SESSION['username'] = "admin";
            echo '<script>window.location.href = "index.php";</script>';
          }
          else {
            $_SESSION['log'] = true;
		        $_SESSION['username'] = $login;
            echo '<script>window.location.href = "index.php";</script>';
          }
  }
  else {
    echo "Wrong loging or password!<br>";
    echo "<a href='users.php'>Back</a>";
  }
}

echo "</form>";
?>
