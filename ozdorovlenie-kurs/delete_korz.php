<?php session_start();
$db=mysqli_connect("localhost","root","","mysql") or die("Ooops...".mysqli_error($db));

$id = $_REQUEST['id'];

$z = mysqli_query($db, "DELETE FROM korzina WHERE id = '$id'");
echo "Deleted!<br>";
echo '<script>window.location.href = "to_korzina.php";</script>';
?>
