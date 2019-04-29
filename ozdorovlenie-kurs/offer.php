<?php session_start(); ?>

<html>
<head>
<style type="text/css">
  body{background-image: url('../fon.png');
       margin-left: 670px;
       margin-top: 100px;}
  p{
    font-size: 14px;
    font-family: sans-serif,Arial;
  }
</style>
<link rel="stylesheet" href="styles/masters.css">
</head>
<body>
  <h1>Please write your personal data</h1>
  <form action="buy.php" method="POST" >
    <p>First name<br><input type="text" name="first" autofocus required></p>
    <p>Second name<br><input type="text" name="second" autofocus required><br></p>
    <p>Phone number<br><input type="number" name="phone" autofocus required><br></p>
    <p>E-Mail<br><input type="text" name="email" autofocus required><br></p>
    <input type="hidden" name="data" value="<?php echo date('Y-m-d');?>">
    <input type="submit" name="zakazat" value="Order!">
    <p><a href='to_korzina.php'>Back to your order</a></p>
    <p><a href='index.php'>Go home</a></p>
  </form>
  <body>
</html>
