<?php
session_start(); 
require_once '../includes/conexion.php';
$conexion = conexion();
require_once '../includes/funciones.php';

//registro user
if (isset($_POST['tipo']) && $_POST['tipo'] == 'nuevo') {
	
	//datos que llegan del formulario
	$datos = emptyValidate($_POST);

	//array para los errores
	$errores = array();

	//si no hay campos vacios
	if (!isset($datos['empty'])) {

		//si el correo tiene errores
		if (isset($datos['errorEmail'])) {
			$errores['correo'] = $datos['errorEmail'];
		}

		//si la contra tiene errores
		if (isset($datos['errorPassword'])) {
			$errores['password'] = $datos['errorPassword'];	
		}

	}else{
		//si tiene campos vacios en formulario
		$errores['empty'] = $datos['empty'];
	}

	//creando sesion para los errores
	$_SESSION['errores'] = $errores;
	if (count($errores) >= 1) {
		
		header("Location: ../index.php");
	}else{
		//verificamos que un dato no exista en la base de datos antes de insertar
		$verify = verifyData($conexion,'usuarios','nombre',$datos['nombre'],'nombre');

		//no ahi dato iguales
		if (!isset($verify['existeDato'])) {
			//no hay errores, cargamos los datos
			$insert = insertUser($conexion,$datos);

			if ($insert['tipo'] != 'error') {
				$_SESSION['success'] = $insert['msj'];
			}else{
				//error al insertar a la base de datos
				$_SESSION['errorInsert'] = $insert['msj'];
			}
		}else{
			//ahi un dato igual en la base de datos
			$_SESSION['errorDataExist'] = $verify['existeDato'];
		}
	}

	header("Location: ../index.php");
}

//login user
if (isset($_POST['tipo']) && $_POST['tipo'] == 'login') {
	
	//borramos el dato tipo
	unset($_POST['tipo']);

	//recoger los datos del formulario
	$data = validateEmpty($_POST);

	//si no devuelve error la funcion
	if (!isset($data['empty'])) {

		//comprobar registro en la base de datos
		$rows = verifyData($conexion,'usuarios','email',$data['correo']);

		//preguntamos si existe error
		if (!isset($rows['noEncontrado'])) {

			//comprobar la contra ingresada con la que esta en la base de datos
			$pass_verify = password_verify($data['password'], $rows['password']);

			//si coinciden las password
			if ($pass_verify) {
				//creamos una sesion con todos los datos de la db de ese usuario
				$_SESSION['usuario'] = $rows;

				//borramos la session errorLogin
				if (isset($_SESSION['noLoginUser']) || isset($_SESSION['errorLoginPassword'])) {

					session_unset($_SESSION['noLoginUser']);
					session_unset($_SESSION['errorLoginPassword']);
				}
				
			}else{
			//no coinciden las password
				$_SESSION['errorLoginPassword'] = 'Password incorrecta';
				// header("Location: ../index.php");
			}

		}else{
			$_SESSION['noLoginUser'] = $rows['noEncontrado'];
			// header("Location: ../index.php");
		}
		
	}else{
		$_SESSION['loginEmpty'] = $data['empty'];
		
	}

	header("Location: ../index.php");	
}