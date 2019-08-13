<?php  
session_start();
require_once '../includes/conexion.php';
require_once '../includes/funciones.php';
$conexion = conexion();

//creamos nueva entrada
if (isset($_POST['tipo']) && $_POST['tipo'] == 'nuevo') {
	var_dump(validatePost($_POST));
}