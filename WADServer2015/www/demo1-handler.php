<html><head><title>Form example</title></head>
<body>
<?php
	session_id('WAD2015'); //give our session a name
	session_start(); //establish our session and initiate a cookie

//----------------------------------------------
//what was the request method?
echo 'Request Method: '.$_SERVER["REQUEST_METHOD"];

//iterate through the unprocessed request data from the form
echo "<br /><br />Variables in the request: <br />";
while ($R = current($_REQUEST)) {
   	echo "<pre>".key($_REQUEST).':'.$R."</pre>";   
	next($_REQUEST);
}	


//----------------------------------------
//use a variable passed with the GET method to clear the session
//any variable can be used
if ($_SERVER["REQUEST_METHOD"] == "GET" and $_GET[clear]==1)
{
	echo "<br /><br />Session storage for 'person' cleared.";
	unset($_SESSION[person]);
}

//----------------------------------------	
//was the request from a form and was the Send button pressed?
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['sendit']))
{
		//grab the values from the form POST area
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$phone = $_POST['phone'];

		//store the values into an array and add it to the session storage. aka our WAD2012 cookie
		//this will allow us to send the values back to another page
		$_SESSION['person'] = array('firstname' => $firstname, 
								  'lastname' => $lastname, 
								  'phone'=>$phone);
}	
		//iterate through the session storage and print the values currently stored for person
		//NOTE: current,key and next are functions used on arrays - refer to the PHP manual section on array functions
		echo "<br /><br />Information currently stored in the 'session' storage:<br />";
		while ($v = current($_SESSION['person'])) {
			echo "<pre>".key($_SESSION['person']).':'.$v."</pre>";   
			next($_SESSION['person']);
		}				

	
?>
<br /><hr>
<a href="demo1-form.php">Back to the form</a>
<a href="demo1-handler.php?clear=1">Clear the session</a>
</body>
</html>
