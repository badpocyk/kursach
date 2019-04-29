<?php session_start();
$db=mysqli_connect("localhost","root","","mysql") or die("Ooops...".mysqli_error($db));

$login=$_SESSION['username'];
$first = $_REQUEST['first'];
$second= $_REQUEST['second'];
$email=$_REQUEST['email'];
$phone=$_REQUEST['phone'];
$data= $_REQUEST['data'];
$zakaz = "";
$korzina = mysqli_query($db, "SELECT usluga FROM korzina WHERE client='$login'");
while ($arr=mysqli_fetch_array($korzina)){
  $zakaz=$zakaz.';'.$arr['usluga'];
}

$summa = mysqli_query($db, "SELECT COUNT(*) AS count FROM korzina WHERE client='$login'");
while ($sum =mysqli_fetch_array($summa)){
  $sm=$sum['count'];
}

  $z = mysqli_query($db, "INSERT INTO orders(login,first,second,email,phone,data,zakaz,count) VALUES('$login','$first','$second','$email','$phone','$data','$zakaz','$sm')");
  $a = mysqli_query($db, "DELETE FROM korzina WHERE client = '$login'");
  echo "Your order was created! We will call you back as soon as possible!<br>";
  echo "<a href='index.php'>Go home</a>";

?>
