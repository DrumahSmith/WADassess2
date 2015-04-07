<html><head><title>Form example</title></head>
<body>
<?php
//using sessions to retrieve any information created on another page
	session_id('WAD2015'); //set our session to the cookie created earlier
	session_start(); //open up the session for reading
	if ( isset($_SESSION['person'])) //has the data been stored in the session storage?
	{	//grab the values from the session storage
		$firstname 	= $_SESSION['person']['firstname'];
		$lastname 	= $_SESSION['person']['lastname'];
		$phone 		= $_SESSION['person']['phone'];

	}
	
?>
<form name="formed" method="POST" action="demo1-handler.php">

	<label for "firstname">Firstname</label>
	<input type="text" name="firstname" value="<?php echo $firstname;?>" />
	<br />
	
	<label for "lastname">Lastname</label>
	<input type="text" name="lastname" value="<?php echo $lastname;?>" />
	<br />
	
	<label for "phone">Phone</label>
	<input type="text" name="phone" value="<?php echo $phone;?>" />	
	<br />
	
	<input type="submit" name="sendit" value="Send">
</form>



</body>
</html>
