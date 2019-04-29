<html>
<head>
<style type="text/css">
  body{background-image: url('../fon.png');
       margin-left: 230px;
       margin-top: 100px;}
  p{
    font-size: 14px;
    font-family: sans-serif,Arial;
  }
  table{

    border: 0px;
  }
   a:hover{
    background: #dddddd;
    color: #cccccc;
  }

</style>
<link rel="stylesheet" href="styles/masters.css">
</head>
<body>
  <?php
  $db = mysql_connect("localhost","root","");
  mysql_select_db("mysql",$db);
  echo "<h1>Заказы: </h1>";
  $table = mysql_query("SELECT * FROM zakazy");
  ?>
  <table border= 1px>
  <tr>
  <td>№</td>
  </tr><?php
  $con = 1;
  while ($arr = mysql_fetch_array($table))
  { ?> <tr>
          <td><?php echo $con;?></td>
          <td><?php echo $arr['login'];?></td>
          <td><?php echo $arr['fio'];?></td>
          <td><?php echo $arr['city'];?></td>
          <td><?php echo $arr['adres'];?></td>
          <td><?php echo $arr['index'];?></td>
          <td><?php echo $arr['phone'];?></td>
          <td><?php echo $arr['data'];?></td>
          <td><?php echo $arr['zakaz'];?></td>
          <td>
            <form action="delete_zakaz.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $arr['id'];?>">
              <input type="submit" name="delete" value="Удалить">
            </form>
          </td>
        </tr>
        <?php
      $con += 1;
  }

  ?>

  <?php
  echo"</tr></table><br>";
  ?>
  <a href="index.php"><h2>На главную</h2></a>
</body>
</html>
