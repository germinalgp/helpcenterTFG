<?php
	/**
	* En nuestro MVC es el controlador que llama al modelo cambiar_competencia
	* @author Germinal GARRIDO PUYANA
	* @version v1.1(0218)
	*/
date_default_timezone_set('Europe/Madrid');
//Llamada al modelo
require_once("../models/cambiar_competencia_model.php");
$cambiar_competencia=new cambiar_competencia_model();
$error = $cambiar_competencia->cambiar_competencia();
 
//Llamada a la vista 
if ($error == 99){
	$intrusion = 1;
	require_once("../index.php");
}else{
	require_once("../respuesta.php");
}	


?>