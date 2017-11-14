<html>
<head>
<link type="text/css" rel="stylesheet" href="main.css">
<?php include 'mainproc.php';?>

<title>
		IR System!
</title>
</head>
<body>
<div id="wrapper">

<div id="headline">search engine!</div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<input name="x" type="text" value="<?php echo $_POST['x'];?>"/>

<button type="submit" name="submit" >search!</button> <br><br>
<span class="error"> <?php echo $error; ?></span> <br>
<div><?php echo $hellyeah ; ?></div>
Generate a new files!
<button name="generate">Generate</button>  <br> <br>
<span class="error"> <?php echo $test; ?></span>

</form>



</div>



</body>
</html>