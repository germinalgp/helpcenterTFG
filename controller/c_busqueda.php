<?php
	/**
	* En nuestro MVC es el controlador que llama al modelo busqueda
	* @author Germinal GARRIDO PUYANA
	* @version v1.1(0218)
	*/
date_default_timezone_set('Europe/Madrid');
//Llamada al modelo
require_once("../models/busqueda_model.php");
$busqueda=new busqueda_model();
$datos=$busqueda->get_busqueda();

//Llamada a la vista
if ($datos == 99){
	$intrusion = 1;
	require_once("../index.php");
}else{
	require_once("../busqueda.php");
}	



?>