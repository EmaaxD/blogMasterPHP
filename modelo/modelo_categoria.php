<?php
session_start(); 
require_once '../includes/conexion.php'; 
require_once '../includes/funciones.php';
$conexion = conexion();

//creamos nueva categoria
if (isset($_POST['tipo']) && $_POST['tipo'] == 'nuevo') {
	
	$devolvemos = array();

	$data = validateEmpty($_POST);
	
	if (!isset($data['empty'])) {
		
		$row = verifyData($conexion,'categorias','nombre',$data['nombre'],'registro');

		if (!isset($row['existeDato'])) {
			//preguntamos si no tiene numeros
			$nombre = noNumber($data['nombre']);
			
			if (!isset($nombre['error'])) {
				//preparando consulta
				$insert = insertCategorias($conexion,$data);

				//si se inserto correctamente
				if ($insert) {
					$_SESSION['success'] = $insert['success'];
				}else{
					$devolvemos['errorInsert'] = $insert['error'];
				}
			}else{
				$devolvemos['errorCadena'] = $nombre['error'];
			}

		}else{
			$devolvemos['existeRegis'] = $row['existeDato'];
		}	
	}else{

		$devolvemos['empty'] = $data['empty'];
	}

	$_SESSION['errores'] = $devolvemos;
	header("Location: ../categorias.php?nueva=1");
}