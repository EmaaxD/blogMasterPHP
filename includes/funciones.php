<?php  
require_once 'fuciones.mysql.php';

//validar campos vacios y otros campos
function emptyValidate($datos){
	
	$devolvemos = array();

	foreach ($datos as $key => $value) {

		//validamos campos vacions
		if ($value == '') {
			
			$devolvemos['empty'] = 'Ningun campo debe estar vacio';

		}else{

			//validamos correo
			if ($key == 'correo') {

				$correoValido = emailValidate($value);

				if ($correoValido != 'error') {
					$devolvemos['correoValidado'] = $correoValido;
				}else{
					$devolvemos['errorEmail'] = 'El correo no es valido';
				}

			}else{
				$devolvemos[$key] = limpiarCadena($value);
			}

			//validamos password
			if ($key == 'password') {
				
				if (strlen($value) >= 5) {
					$passwordValida = encripPassword($value);
					$devolvemos['passwordEncriptada'] = $passwordValida;
				}else{
					$devolvemos['errorPassword'] = 'Se necesita al menos 6 caracteres en la contraseña';
				}
			}

			unset($devolvemos['password']);
			unset($devolvemos['tipo']);
		}
	}

	return $devolvemos;
}

//validar solo campos vacios
function validateEmpty($datos){
	$devolvemos = array();

	if (isset($datos['tipo'])) {
		unset($datos['tipo']);
	}

	foreach ($datos as $key => $value) {
		if ($value != '') {
			$devolvemos['success'] = 'Todo correcto';
			$devolvemos['id'] = null;
			$devolvemos[$key] = limpiarCadena($value);
		}else{
			$devolvemos['empty'] = 'No se puede enviar campos vacios';
		}	
	}

	return $devolvemos;
}

//validar post
function validatePost($data){
	$devolvemos = array();
	$empty = false;

	if (isset($data['tipo'])) {
		unset($data['tipo']);
	}

	foreach ($data as $key => $value) {
		if ($key != 'usuario') {
			if ($value != '') {
				$devolvemos[$key] = trim($value);
			}else{
				$empty = true;
			}
		}
	}

	if ($empty) {
		$devolvemos['empty'] = 'Ningun campo debe estar vacio';
	}else{
		$devolvemos['usuario'] = (int) $data['usuario'];
		$devolvemos['id'] = null;	
	}
	
	return $devolvemos;
}

//validar correo
function emailValidate($correo){

	$devolvemos = '';

	if (filter_var($correo, FILTER_SANITIZE_EMAIL)) {
		$devolvemos = filter_var($correo, FILTER_VALIDATE_EMAIL);
	}else{
		$devolvemos = 'error';
	}

	return $devolvemos;
}

//encriptar password
function encripPassword($contra){
	
	$opciones = array('cost' => 12);

	$hash_pass = password_hash($contra, PASSWORD_BCRYPT,$opciones);

	return $hash_pass;
}

//quitar los espacios en blancos
function limpiarCadena($cadena){
	$cadena = str_replace(' ', '', $cadena);
	return trim($cadena);
}

//no permitir numero en cadena
function noNumber($cadena){

	$devolvemos = array();

	if (preg_match("/[0-9]/", $cadena)) {
		$devolvemos['error'] = 'No se permite numeros';
	}else{
		$devolvemos['success'] = $cadena;
	}

	return $devolvemos;
}

//mostrando msj errores
function mostrarError($errores,$campo,$caja = null){
	$alerta = "";

	if (is_null($caja)) {
		//alerta simplre
		if (isset($errores[$campo]) && !empty($campo)) {
			$alerta =  "<div class='msj-error'><p>".ucfirst($errores[$campo])."</p></div>";
		}
	}else{
		//alerta en una caja
		$alerta = '<div class="error"><p>'.ucfirst($errores[$campo]).'</p></div>';
	}

	return $alerta;
}

//mostrando cualquier error -funcion mejorada-
function mostrandoErrores($data){
	$alerta = '';

	foreach ($data as $key => $value) {
		if ($key != 'insert_post') {
			$alerta = '<div class="error"><p>'.ucfirst($data[$key]).'</p></div>';
		}else{
			$alerta = '<div class="success"><p>'.ucfirst($data[$key]).'</p></div>';
		}
	}

	return $alerta;
}

//mostrando msj success
function mostrarSucess($success){
	$alerta = '';

	if (!empty($success)) {
		$alerta = '<div class="success"><p>'.ucfirst($success).'</p></div>';
	}else{
		$alerta = '<div class="msj-error"><p>Esta vacio el paramentro de la funcion</p></div>';
	}

	return $alerta;
}

//borrar msj de errores
function borrarError(){
	$borrado = null;

	
	if (isset($_SESSION['errores']) || isset($_SESSION['loginEmpty']) || isset($_SESSION['noLoginUser'])  || isset($_SESSION['errorLoginPassword']) || isset($_SESSION['post']['insert_error']) || isset($_SESSION['post']['empty_post']) && !isset($_SESSION['usuario'])) {

		$borrado = session_destroy();

	}else{
		//existe usuario
	}

	return $borrado;
}

//mostrar menos caracteres
function limitandoCaracteres($cadena,$limite){
	
	$devolvemos = '';
	if (strlen($cadena) > $limite) {
		$devolvemos = substr($cadena, 0,$limite).'...';
	}

	return ucfirst($devolvemos);
}

//mostrar categorias
function mostrarCategorias($core, $tipo){
	
	$consulta = obtenerCategorias($core);

	if ($tipo == 'lista') {
		while ($row = $consulta->fetch_assoc()) {
			echo '<li><a href="categorias.php?id='.$row['id_categoria'].'">'.ucfirst($row['nombre']).'</a></li>';
		}
	}else{
		while ($row = $consulta->fetch_assoc()) {
			echo '<option value="'.$row['id_categoria'].'">'.ucfirst($row['nombre']).'</option>';
		}
	}
	
}

//mostrar entradas
function mostrarEntradas($core,$all = null){

	if (is_null($all)) {
		$sqlEntradas = obtenerEntradas($core);
	}else{
		$sqlEntradas = obtenerEntradas($core,1);
	}

	// return $sqlEntradas->fetch_assoc();

	if ($sqlEntradas->num_rows >= 1) {
		while ($row = $sqlEntradas->fetch_assoc()) {
			echo '<article class="entrada">
					<a href="entradas.php?id_post='.$row['id_entrada'].'">
						<h2>'.ucfirst($row['titulo']).'</h2>
						<span class="fecha">'.$row['categoria'].' | '.$row['fecha'].'</span>
						<p>'.limitandoCaracteres($row['descripcion'],47).'</p>
					</a>
				</article>';
		}
	}else{
		echo '<h3>No ahi post publicados</h3>';
	}
}

//mostrar categorias con sus entradas
function mostrarCategoriaEntradas($core,$id){
	$entradas = obtenerCategoriaEntradas($core,$id);

	if ($entradas->num_rows >= 1) {
		while ($row = $entradas->fetch_assoc()) {
			echo '<article class="entrada">
					<a href="entradas.php?id_post='.$row['id_entrada'].'">
						<h2>'.ucfirst($row['titulo']).'</h2>
						<span class="fecha">'.$row['categoria'].' | '.$row['fecha'].'</span>
						<p>'.limitandoCaracteres($row['descripcion'],47).'</p>
					</a>
				</article>';
		}
	}else{
		echo '<h3>No ahi post publicados para esta categoria</h3>';
	}
}

//mostar post selecionado
function mostrarPostSeleccinado($core,$id){
	if (empty($id)) {
		echo '<h1>El post no existe</h1>';
	}else{
		$row = consultCondicion($core,'entradas','id_entrada',$id,1);
		echo '<article class="entrada">
				<h1>'.ucfirst($row['titulo']).'</h1>
				<span class="fecha">'.ucwords($row['user']).' | '.ucfirst($row['categoria']).' | '.$row['fecha'].'</span>
				<p>'.$row['descripcion'].'</p>
			</article>';
	}
}