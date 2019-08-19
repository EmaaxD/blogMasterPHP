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

//editamos entrada
if (isset($_POST['tipo']) && $_POST['tipo'] == 'edit') {
	$devolvemos = array();

	$data = validateEmpty($_POST,1);
	if (!isset($data['empty'])) {
		$update = editarRegistro($conexion,$data,'post');
		if (!isset($update['error'])) {
			$devolvemos['UpdatePost']['success'] = $update['success'];
		}
	}else{
		$devolvemos['UpdatePost']['error']['empty'] = $data['empty'];
	}

	header("Location: ../entradas.php?id=$data[id_post]");
}

//eliminamos entrada
if (isset($_GET['eliminar'])) {
	$eliminar = deleteRegistry($conexion,'entradas','id_entrada',$_GET['id']);
	if (!isset($eliminar['error'])) {
		header("Location: ../entradas.php?mis_entradas=1");
	}else{
		echo $eliminar['msj'];
	}
}