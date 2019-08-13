<?php  
session_start();
require_once '../includes/conexion.php';
require_once '../includes/funciones.php';
$conexion = conexion();

//creamos nueva entrada
if (isset($_POST['tipo']) && $_POST['tipo'] == 'nuevo') {
	$data = validatePost($_POST);

	if (!isset($data['empty'])) {
		$insert = insertPost($conexion,$data);
		if (!isset($insert['error'])) {
			$_SESSION['post']['insert_post'] = $insert['success'];
		}else{
			$_SESSION['post']['insert_error'] = $insert['error'];
		}
	}else{
		$_SESSION['post']['empty_post'] = $data['empty'];
	}

	header("Location: ../entradas.php?nueva=1");
}