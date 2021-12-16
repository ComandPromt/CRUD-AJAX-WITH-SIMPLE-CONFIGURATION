<?php

include_once('config.php');
		
$user_fun = new Userfunction();
		
print $user_fun->insertarDatos($_POST['valores'],$_POST['celdas'],$_POST['tabla']);

?>