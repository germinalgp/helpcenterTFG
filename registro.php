<?php
	/**
	* PHP para realizar el registro de un usuario por parte de un administrador
	* @author Germinal GARRIDO PUYANA
	* @version v1.1(0218)
	*/
	require('conexion.php'); //Incluimos el conexion.php que contiene los datos de la conexion a la base de datos
	include('menu.php');

	
	if ($_SESSION['level'] == 1 || $_SESSION['level'] == 3) {
		if ($_SESSION['block'] > 0){
			mysqli_query ($connection, "UPDATE peticiones SET BLOCK = 0 WHERE ID = ".$_SESSION['block'].""); //DESBLOQUEAMOS
			$_SESSION['block'] = 0;
		}
		echo '<html>
		<head>
				<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
				<title>HELPCENTER - REGISTRO USUARIO</title>
				<link href="styles.css" rel="stylesheet" type="text/css" />
				<link href="../styles.css" rel="stylesheet" type="text/css" /> 	 
				<script type="text/javascript" src="../tinybox.js"></script>
		</head>';
					
		
		if ($error != ''){
			echo '<body style="font: 13px/20px sans-serif;" link="#0000ff" vlink="#0000ff" onload="TINY.box.show({url:\'../message.php?mensaje='.$error.'\',width:320,height:240})">';
		}else{
			echo '<body style="font: 13px/20px sans-serif;" link="#0000ff" vlink="#0000ff">';
		}
		echo '<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>';
		
		if (strpos($_SERVER['PHP_SELF'],'controller') != false){
			$ruta="../";
		}
				
		menu_int(0,0,1,0,0,0);
				 
		echo '<blockquote><blockquote>
				<p align="left"><b><font size="4">REGISTRO DE USUARIOS</font></b></p>
			</blockquote></blockquote>
				
			<blockquote><blockquote>
					
		<table>
		<tr>
		<td>
			<form id="registrarform" method="post" action="'.$ruta.'controller/c_registro.php">
			<fieldset>
				<legend>Registro</legend>
				<p>Por favor, introduzca datos del usuario</p>
				<input type="hidden" name="enviar_peticion" value="1" size="1"></input>
				<label id="label2" for="nick">
					<input type="text" name="nick" tabindex="1" id="nick" />DNI (sin letras):
				</label>
				<label id="label2" for="password">
					<input type="password" name="pass" tabindex="2" id="pass" />Contrase&#241;a:
				</label>
				<label id="label2" for="password2">
					<input type="password" name="pass2" tabindex="3" id="pass2" />Repetir Contrase&#241;a:
				</label>
				<label id="label2" for="nombre">
					<input type="text" name="nombre" tabindex="4" id="nombre" />Nombre y Apellidos:
				</label>
				<label id="label2" for="email">
					<input type="text" name="email" tabindex="4" id="email" />Email:
				</label>
				<label id="label2" for="telephone">
					<input type="text" name="telephone" tabindex="4" id="telephone" />Tel&#233;fono:
				</label>
				<label id="label2" for="level">
					<select name = "level" tabindex="5" id="level">
						<option value = "-1">Escoja una opci&#243;n:</option>
						<option value = "1">1:Desarrollador</option>
						<option value = "2">2:Jefes y/o superiores</option>
						<option value = "3">3:T&#233;cnico</option>
						<option value = "4">4:Operadores</option>
					</select>Nivel:
				</label>
				<label id="label2" for="departamento">
					<select name="departamento" tabindex="6" id="departamento">
						<option value = "-1">Escoja una opci&#243;n:</option>
						<option value = "T&#233;cnico">Grupo T&#233;cnico</option>
						<option value = "Desarrollo">Grupo de Desarrolo</option>
						<option value = "Coordinaci&#243;n">Grupo Coordinaci&#243;n</option>
						<option value = "Administraci&#233;n">Grupo Administraci&#243;n</option>
					</select>Departamento:
				</label>
				<label id="label2" for="submit">
					<input name="Submit" type="submit" id="submit" tabindex="7" value="Enviar" />
				</label>
				<p align = "justify">
				<b>Instrucciones: </b>El formato de Nombre y Apellidos ser&#225; "Nombre APELLIDO1 APELLIDO2", siempre sin acentos. <br> (ejemplo: Fernando Jose TORRES SANZ)
				</p>
				<u>Selecci&#243;n del nivel:</u> 
				<ul>
				<li><p align="justify">Como norma general 4:Operadores.</li>
				<li><p align="justify">Desarrollador ser&#225; para personal cualificado y hay que motivarlo con los desarrolladores de la aplicaci&#243;n.</li> 
				<li><p align="justify">El nivel Jefes y/o superiores se seleccionar&#225; para aquellos superiores que se determine.</li>
				<li><p align="justify">El nivel T&#233;cnico se seleccionar&#225; para miembros del Grupo T&#233;cnico.</li><br>
				</ul>		
			</fieldset>
			</form>
		</td>
		<td valign="top">';
		$colorFila="filaBlanca";
		$sql_registro="SELECT nick, nombre, email, telephone, fecha FROM users WHERE active = 0 ORDER BY fecha ASC";
		$resultado_registro=mysqli_query($connection, $sql_registro);
						
		//MOSTRAR USUARIOS
	echo '<table class="borde" cellpading="1" cellspacing="0">
			<tr>
				<td align="center" colspan="6"><font face="Arial Black" size="5">Peticiones de registro</font></td>
			</tr>
			<tr>
				<td align="center" width="80"><b><font face="Arial">Usuario</font></b></td>
				<td align="center" width="100"><b><font face="Arial">Nombre/Apellidos</font></b></td>
				<td align="center" width="100"><b><font face="Arial">Email</font></b></td>
				<td align="center" width="100"><b><font face="Arial">Tel&#233;fono</font></b></td>
				<td align="center" width="100"><b><font face="Arial">Fecha</font></b></td>										
				<td align="center"><b></b></td>
			</tr>';
				
			while ($datos_registro=mysqli_fetch_array($resultado_registro)){	
			echo '<form id="searchform" method="post" action="'.$ruta.'controller/c_registro.php">
					<tr class="'.$colorFila.'">
						<td align="center">'.$datos_registro["nick"].'</td>
						<td align="center">'.$datos_registro["nombre"].'</td>
						<td align="center">'.$datos_registro["email"].'</td>		
						<td align="center">'.$datos_registro["telephone"].'</td>
						<td align="center">'.$datos_registro["fecha"].'</td>
													
						<td align="center" valign="middle">
							<input type="hidden" name="enviar_peticion" value="2" size="1"></input>								
							<input type="hidden" name="ID" value="'.$datos_registro["nick"].'"></input>
							<input name="Submit" type="submit" id="submit" value="ACEPTAR"></input>											
						</td>
					</tr>
				</form>';							  
				//Cambio el color de la fila	
				if ($colorFila == "filaBlanca") 
				{
					$colorFila = "filaMorada";
				}
				else
				{
					$colorFila = "filaBlanca";
				}
			}	
	echo '</table>';
				
		$colorFila="filaBlanca";
		$sql_delete="SELECT nick, nombre, email, telephone, fecha FROM users WHERE nick NOT LIKE '".$_SESSION['usuario']."' ORDER BY nick ASC";
		$resultado_delete=mysqli_query($connection, $sql_delete);
				
		//MOSTRAR USUARIOS
echo '<br>
		<table class="borde" cellpading="1" cellspacing="0">
		<tr>
			<td align="center" colspan="6"><font face="Arial Black" size="5">Eliminar usuario</font></td>
		</tr>
		<tr class="'.$colorFila.'">
			<td align="center" colspan="5">
			<form id="searchform" method="post" action="'.$ruta.'controller/c_registro.php">
				<select style="width:98%;" name="ESTADO" id="estado">';		
				while ($datos_delete=mysqli_fetch_array($resultado_delete)){
					echo '<option value="'.$datos_delete["nick"].'">'.$datos_delete["nick"].';'.$datos_delete["nombre"].'</option>';
				}			
	echo '</select>
		</td>
		<td>
			<input type="hidden" name="enviar_peticion" value="3" size="1"></input>								
			<input name="Submit" type="submit" id="submit" value="ELIMINAR"></input>		
		</td>
		</tr>
		</table>
	</blockquote></blockquote>
	</body>
</html>';
	
}else {
	$ahora = getdate(); //Obtiene un array con los datos de la fecha y hora actual
	$fecha = $ahora["year"]."-".$ahora["mon"]."-".$ahora["mday"]." ".$ahora["hours"].":".$ahora["minutes"].":".$ahora["seconds"]; //Obtiene el formato adecuado de fecha hora para insertar en la BBDD
	$IP = $_SERVER['REMOTE_ADDR'];
	$pagina = $_SERVER['PHP_SELF'];
	mysqli_query ($connection, "INSERT INTO intrusos (IP,tipo,descripcion,fecha) values ('".$IP."',4,'".$pagina."','".$fecha."') ");
	Header("Location: index.php?intrusion=1");
}


?>
