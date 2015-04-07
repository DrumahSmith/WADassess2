<html><head><title>Array Demo 3</title></head>
<body>
<h1>Array Demo 3</h1>
<?php 
		//index keys are automatically created - starting from 0
		//1..5 are the values.
		$A = array(1,2,3,4,5); //creates and array with some values
		print_r($A); //print the variable (similar to echo)
		echo '<br />';
		
		//creates and array with some values and keys
		$A = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5); 
		//a,b,c,d,e are called keys. ie the array index
		print_r($A);		

		//creates and array with some values and mixed keys
		$A = array('a' => 1, 'b' => 2, 3, 4, 5 ); 
		//a,b,c,d,e are called keys. ie the array index
		print_r($A);			
?>
</body><html>
