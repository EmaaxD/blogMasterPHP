<?php
session_start(); 
require_once '../includes/conexion.php';
require_once '../includes/funciones.php';
$conexion = conexion();

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

//editar user
if (isset($_POST['tipo']) && $_POST['tipo'] == 'edit') {
	$errores = array();
	$success = array();
	$data_sanin = array();

	$data = validateEmpty($_POST);

	if (!isset($data['empty'])) {

		foreach ($data as $key => $value) {
			if ($key != 'correo') {
				$data_sanin[$key] = $value;
			}
		}
		
		$correoValido = emailValidate($data['correo']);

		if ($correoValido) {
			$data_sanin['correo'] = $correoValido;
			$isset_email = consultCondicion($conexion,'usuarios','email',$data_sanin['correo']);

			if ($isset_email['id_user'] == $data_sanin['id_user'] || empty($isset_email)) {

				$update = editarRegistro($conexion,$data_sanin,'user');

				if (!isset($update['error'])) {
					$success['success'] = $update['success'];
				}else{
					$errores['errorUpdate'] = $update['error'];
				}
			}else{
				$errores['correoExistente'] = 'El correo ya esta registrado en otra cuenta';
			}
	

		}else{
			$errores['correoNoValido'] = 'El correo no es valido';
		}

	}else{
		$errores['editCamposVacios'] = $data['empty']; 
	}

	if (count($errores) >= 1) {
		$_SESSION['erroresUpdate'] = $errores;
	}

	if (count($success) >= 1) {
		$_SESSION['successUpdate'] = $success;
		$new_data_sesion_user = consultCondicion($conexion,'usuarios','id_user',$data['id_user']);

		$_SESSION['usuario'] = $new_data_sesion_user;
	}
	// var_dump($new_data_sesion_user);
	// die();

	header("Location: ../perfil.php");
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

