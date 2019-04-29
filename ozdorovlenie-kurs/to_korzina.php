<?php session_start();
$db=mysqli_connect("localhost","root","","mysql") or die("Ooops...".mysqli_error($db));
 ?>

<html>
<head>
<style type="text/css">
  body{background-image: url('../fon.png');
       margin-left: 630px;
       margin-top: 100px;}
  p{
    font-size: 14px;
    font-family: sans-serif,Arial;
  }
  table{
    border-collapse: collapse;
    border: 0px;
  }
   a:hover{
    background: #dddddd;
    color: #cccccc;
  }
  td,th,tr{
    border: 0px;
  }
</style>
<link rel="stylesheet" href="styles/masters.css">
</head>
<body>
  <?php
  $name = $_SESSION['username'];
  echo "<h1>$name, Your order: </h1>";
  $table = mysqli_query($db, "SELECT id,usluga FROM korzina WHERE client='$name'");
  ?>
  <table border= 1px>
  <tr>
  <td>#</td>
  <td>Name of service</td>
  </tr><?php
  $con = 1;
  while ($arr = mysqli_fetch_array($table))
  { ?> <tr>
          <td><?php echo $con;?></td>
          <td><?php echo $arr['usluga'];?></td>
          <td>
            <form action="delete_korz.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $arr['id'];?>">
              <input type="submit" name="delete" value="Delete item">
            </form>
          </td>
        </tr>
        <?php
      $con += 1;
  }
  $kolvo = mysqli_query($db, "SELECT COUNT(*) AS mean FROM korzina WHERE client='$name'");
  while ($kol = mysqli_fetch_array($kolvo))
  $koll=$kol['mean'];
  echo "<tr><td><strong>Count of services: </strong></td><td>$koll</td></tr>";
  ?>
  <td>
    <form action="offer.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $arr['id'];?>">
      <input type="submit" name="delete" value="Checkout!">
    </form>
  </td>

  <?php
  echo"</tr></table><br>";
  ?>
  <a href="index.php"><h2>Go back!</h2></a>
</body>
</html>
