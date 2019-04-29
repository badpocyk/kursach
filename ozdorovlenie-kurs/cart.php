<?php session_start();
$db=mysqli_connect("localhost","root","","mysql") or die("Ooops...".mysqli_error($db));

  $login = $_SESSION['username'];
  $id = $_POST['id'];
  $cart=mysqli_query($db , "SELECT Kod,Naimenov FROM procedury WHERE Kod='$id'");
  $cart_ = mysqli_fetch_array($cart);
  $naimenov = $cart_['Naimenov'];
  $z=mysqli_query($db, "INSERT INTO korzina(client,usluga) VALUES ('$login','$naimenov')");

?>
