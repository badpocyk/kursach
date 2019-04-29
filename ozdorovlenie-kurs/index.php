<?php session_start();
$db=mysqli_connect("localhost","root","","mysql") or die("Ooops...".mysqli_error($db));
$res = mysqli_query($db, "SELECT Kod, Naimenov, photo1 FROM procedury");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Zdorovyak</title>
    <link rel="stylesheet" href="styles/master.css">
    <script src="jquery-3.3.1.js"></script>
    <script>
    $( document ).ready(function(){
    $('.id_tovara').click(function(){
      var id_product = $(this).attr("id_tovara");
      $.ajax({
        type: "POST",
        url: "cart.php",
        data: {id:id_product},
        success: function(){
        alert('Added!');
        window.location.href = "index.php";
      }
      });
      });
    });
    </script>
  </head>

  <body>
    <div class="header" align="left" style="background-color: #dddddd">
      <p><a href="index.php">
          <img src="logo.png">
        </a></p>
      </div>
      <?php if (isset($_SESSION['username']) and $_SESSION['username'] != 'admin' and $_SESSION['log'] == true){
        $login = $_SESSION['username'];
        $kolvo = mysqli_query($db, "SELECT COUNT(*) AS mean FROM korzina WHERE client='$login'");
        while ($kol = mysqli_fetch_array($kolvo))
        $koll=$kol['mean'];
      ?>
      <div id="smalcart">

  <h2><strong>Count of selected services: </strong><?php echo $koll;?></h2>
  <h3><a href='to_korzina.php'>To Your services</a></h3>
  <h3><a href='to_korzina.php'>Order!</a></h3>
</div>
<?php }if (isset($_SESSION['log']) and $_SESSION['log'] == true)
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
      if (isset($_SESSION['admin']) and $_SESSION['username'] == 'admin'){
        ?>
        <form action="k_zakazam.php" method="post">
          <input type="submit" name="k_zakazam" value="To orders">
        </form>
        <?php
      }
      ?>

    </div><div class="main">
    <div class="container" align="center">
	    <div id="sidebar">
        <a href="services.php" class="button"><h1>Our services</h1></a>
        <a href="specialists.php" class="button"><h1>Our specialists</h1></a>
        <a href="prices.php" class="button"><h1>Prices</h1></a>
        <a href="about.php" class="button"><h1>About us</h1></a>
	    </div>
	    <div id="content">
        <div class="news">
          <div class="photos">
            <h1 style="font-size: 40px; margin-left: 550px;">Our health Center!</h1>
            <div class="grid">
              <?php
               while ($row=mysqli_fetch_array($res)){
                 echo "<div class='grid-itm'>";
                 ?>
               <form  name="product" enctype="multipart/form-data" action="product.php" method="POST">
                 <a href="product.php?id=<?php echo $row['Kod'];?>"><input type="hidden" name="id" value="<?php echo $row['Kod'];?>">
                 <img src='<?php echo $row['photo1']?>'>
                 <h1><?php echo $row['Naimenov'];?></h1>
               </a></form>
                 <?php if (isset($_SESSION['log']) and $_SESSION['log'] == true and $_SESSION['username'] == 'admin'){
                 ?>
                 <form action=db_changeproduct.php method="POST">
                     <input type = submit name="change" value="Change">
                     <input style="visibility: hidden;" name="id" value='<?php echo $row['Kod'];?>'>
                 </form>
                 <form action="db_del_obr.php" method="POST">
                    <input type = submit name="del" value="Delete">
                    <input style="visibility: hidden;" name="id" value='<?php echo $row['Kod'];?>'>
                 </form>

               <?php }
               else {
                  if (isset($_SESSION['log']) and $_SESSION['log'] == true){?>
                  <form action="" method="POST">
                    <input style="visibility: hidden;" name="id" value="<?php echo $row['Kod'];?>">
                    <a class="id_tovara" id_tovara="<?php echo $row['Kod'];?>"><input type="button" name="korzina" value="Add to list" onClick="cart()"></a>
                  </form>
               <?php }}
               echo "</div>";
                   }
                    if (isset($_SESSION['log']) and $_SESSION['log'] == true and $_SESSION['username'] == 'admin')
                 	{
                     echo "<div class='grid-itm'>";
                     echo "<a href='db_insert.php';>";
                     echo "<h1 style='margin-top: 50px; margin-right: 29px;'>Add service</h1>";
                 ?>
                 <img src="plus.png" style="width: 150px; height: 150px; margin-left: 150px; margin-top: 50px;">
                 <?php echo "</a></div>";}
                 ?>
            </div>

           </div>
          </div>
        </div>
	    </div>
    </div>
	    <div id="clear">

	    </div>

	    <div id="footer">
        <h1>Zdorovyak Inc. +79109255012</h1>
	    </div>
    </div>
  </body>
</html>
