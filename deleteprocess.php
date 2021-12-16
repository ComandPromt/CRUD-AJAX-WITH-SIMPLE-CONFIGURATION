<?php

if(isset($_POST['id']) && isset($_POST['tabla'])){

	include_once('config.php');
		
	$user_fun = new Userfunction();
		
	print json_encode($user_fun->eliminarDatos($_POST['id'],$_POST['tabla']));

}

?>