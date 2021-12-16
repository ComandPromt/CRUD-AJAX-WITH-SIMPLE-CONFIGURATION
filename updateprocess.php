<?php

if(isset($_POST['valores']) && isset($_POST['valores']) && isset($_POST['tabla']) && isset($_POST['id'])){

	include_once('config.php');
		
	$user_fun = new Userfunction();
		
	print $user_fun->actualizarDatos($_POST['valores'],$_POST['celdas'],$_POST['tabla'],$_POST['id']);

}

?>