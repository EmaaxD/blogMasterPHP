<?php  
function conexion(){
	
	//datos para la conexion
	$data = array('local' => 'localhost','user' => 'root','pass' => '','database' => 'blogmasterphp');

	//conexion
	$conexion = new mysqli ($data['local'],$data['user'],$data['pass'],$data['database']);

	//configuracion de caracteres
	mysqli_query($conexion, "SET NAMES 'utf8'");

	// if ($conexion) {
	// 	echo 'todo bien';
	// }else{
	// 	echo 'todo mal';
	// }

	return $conexion;
}
