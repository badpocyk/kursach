<?php session_start();
$id=$_REQUEST['id'];
$db=mysqli_connect("localhost","root","","mysql") or die("Ooops...".mysqli_error($db));
//$res = mysqli_query($db, "SELECT Kod, Naimenov, photo1 FROM procedury");
$res = mysqli_query($db, "SELECT Kod, Naimenov, photo1,photo2,photo3,descr FROM procedury WHERE Kod='$id'");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>DedGuitars</title>
    <link rel="stylesheet" href="styles/masters.css">
    <script src="jquery-3.3.1.js"></script>
    <style>
    .grid{
      display: grid;
      grid-template-columns: 1fr 1fr;
      grid-template-rows: 300px 300px;
    }
    .grid-itm{
      margin-left: 60px;
      margin-top: 30px;
      border-radius: 1px;
      box-shadow: 0 0 0px 0px rgba(219,219,219,1);
      justify-content: : center;
    }
    .tovar:hover{
      transform: scale(1.5, 1.5);
    }
    </style>
  </head>
  <body>
    <div class="header" align="left" style="background-color: #dddddd">
      <div class="logo">
        <p><a href="index.php">
          <img src="logo.png">
        </a></p>
      </div>


      <?php
       if (isset($_SESSION['log']) and $_SESSION['log'] == true)
      {
      	echo "<strong>Welcome " , $_SESSION['username'] , "!</strong>";
        echo "<form action=exit.php name=result method = post>";
        echo "<br><button type=submit>EXIT!</button>";
        echo "</form>";
      }
      else{
        ?>  <form class='logout' method="post">
            <a href="users.php">
              <p style="text-align:right"><input type="button" name="login" value="login"></p>
            </a>
            <a href="reg.php">
              <p style="text-align:right"><input type="button" name="reg" value="Registration"></p>
            </a>
          </form>
          <?php
      }
      ?>

    </div><div class="main">
    <div class="container" align="center">
	    <div id="sidebar">
        `<a href="services.php" class="button"><h1>Our services</h1></a>
        <a href="specialists.php" class="button"><h1>Our specialists</h1></a>
        <a href="prices.php" class="button"><h1>Prices</h1></a>
        <a href="about.php" class="button"><h1>About us</h1></a>`
	    </div>
	    <div id="content">
        <div class="news">
          <div class="photos">
            <h1 style="font-size: 40px; margin-left: 550px;"><?php while ($row=mysqli_fetch_array($res)){ echo $row['Naimenov'];?></h1>
            <div class="grid">
              <?php

                 $descr=$row['descr'];
                 for ($i=1;$i<=3;$i++){
                   echo "<div class='grid-itm'>";
                   $i = (string)$i;
                   $photo = 'photo' . $i;
                 ?>
                 <img src="<?php echo $row[$photo]?>" class="tovar">
                 <?php echo "</div>";
               $id= $row['Kod'];}?>
               </div><br><br><h1><?php
               echo $row['descr'];}
               ?></h1>
                <?php  if (isset($_SESSION['log']) and $_SESSION['log'] == true and $_SESSION['username'] == 'admin'){
                 ?>
                 <form action=db_changeproduct.php method="POST">
                   <input type = submit name="change" value="Change">
                   <input style="visibility: hidden;" name="id" value='<?php echo $row['id'];?>'>
                 </form>

                 <form action="db_del_obr.php" method="POST">
                   <input type = submit name="del" value="Delete">
                   <input style="visibility: hidden;" name="id" value='<?php echo $row['id'];?>'>
                 </form>

               <?php }
               else {
                 if (isset($_SESSION['log']) and $_SESSION['log'] == true){?>
                 <form action="" method="POST">
                   <input style="visibility: hidden;" name="id" value="<?php echo $row['id'];?>">
                   <a class="id_tovara" id_tovara="<?php echo $id;?>"><input type="button" name="korzina" value="Добавить в заказы" onClick="cart()"></a>
                 </form>

               <?php }}

?>


           </div>
          </div>
        </div>
	    </div>
    </div>
	    <div id="clear">

	    </div>

	    <div id="footer">
        <h1>DedGuitars Inc. +79109255012</h1>
	    </div>
    </div>
  </body>
</html>
