<?php
	/**
	* En nuestro MVC es el controlador que llama al modelo add_delete
	* @author Germinal GARRIDO PUYANA
	* @version v1.1(0218)
	*/

date_default_timezone_set('Europe/Madrid');
//Llamada al modelo
require_once("../models/add_delete_model.php");
$add_delete=new add_delete_model();
$mensaje = $add_delete->add_delete();

//Llamada a la vista
if ($mensaje == 99){
	$intrusion = 1;
	require_once("../index.php");
}else{
	require_once("../add_delete.php");
}

?>