<?php

include_once('config.php');
		
$user_fun = new Userfunction();
		
print json_encode($user_fun->verDatos($_POST['id'],$_POST['tabla']));

?>