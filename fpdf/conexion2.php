
<?php
	$mysqli = new mysqli("localhost","root","rootroot","prosigue"); 
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>