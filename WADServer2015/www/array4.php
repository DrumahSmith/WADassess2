<html><head><title>Array Demo 7</title></head>
<body>
<h1>Array Demo 7</h1>
<?php 
	//creates and array with 2 dimensions and mixed values
	$A = array( array(1,2,3,4),
		   array('a','b','c'),
		   array('1.2','2.3','4.5'),
		 ); 
	//pretty print the variable
	echo '<pre>';print_r($A); echo '</pre>'; 	

	for ($row=0; $row<count($A); $row++) {
 	   for ($col=0; $col < count($A[$row]); $col++) {
 	      echo $A[$row][$col].' ';
       }
	   echo '<br />';		
	}		
?>
</body><html>
