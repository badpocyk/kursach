<?php
$db=mysqli_connect("localhost","root","","mysql") or die("Ooops...".mysqli_error($db));

if (isset($_POST['reg']))
{
  $login=$_REQUEST['log_in'];
  $password=$_REQUEST['password'];
  if (empty($login) || empty($password))
  {
    echo "Zapolnite vse polya!<br>";
    echo "<a href='reg.php'>back</a>";
  }
  elseif(mysqli_num_rows(mysqli_query($db,"SELECT * FROM login WHERE log_in = '$login'")))
  {
    echo "Polzocatel s takim imenem sushestvuet!<br>";
    echo "<a href='reg.php'>Back</a>";
  }
  else {
    $z=mysqli_query($db,"INSERT INTO login(log_in,password) VALUES ('$login','$password')");
    echo "Success!<br>";
    echo '<script>window.location.href = "index.php";</script>';
  }
}
?>
