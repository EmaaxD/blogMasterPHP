<?php  
		/*FUNCIONES PARA EL MANEJO DE CONSULTAS SQL*/

/*CONSULTAS*/

//funcion para verificar si existe ese registro
function verifyData($core,$tabla,$campo,$data,$nombre = null){
	
	$devolvemos = array();

	$sql = "SELECT * FROM {$tabla} WHERE {$campo} = '$data'";
	$consult = $core->query($sql);

	if (is_null($nombre)) {
		if ($consult->num_rows >= 1) {
			$row = $consult->fetch_assoc();
			foreach ($row as $key => $value) {
				$devolvemos[$key] = $value;
			}
		}else{
			$devolvemos['noEncontrado'] = 'No se encontro registro alguno';
		}
	}else{
		if ($consult->num_rows >= 1) {
			$devolvemos['existeDato'] = 'El '.$nombre.' ya existe';
		}else{
			$devolvemos['success'] = 'Todo bien';
		}
	}

	return $devolvemos;
}

//funcion para zanear cadenas
function zanenadoDatos($core,$data){
	
	$devolvemos = array();

	foreach ($data as $key => $value) {
		$devolvemos[$key] = mysqli_real_escape_string($core,$value);
	}

	return $devolvemos;
}

//consulta tabla categorias
function obtenerCategorias($core){

	$sql = "SELECT * FROM categorias ORDER BY id_categoria ASC";
	$consult = $core->query($sql);

	return $consult;
}

//consulta tabla entradas
function obtenerEntradas($core,$limit = null){
	if (is_null($limit)) {
		$sql = "SELECT e.*, c.nombre AS categoria FROM entradas e INNER JOIN categorias c ON e.id_cate = c.id_categoria ORDER BY e.id_entrada DESC LIMIT 4";
	}else{
		$sql = "SELECT e.*, c.nombre AS categoria FROM entradas e INNER JOIN categorias c ON e.id_cate = c.id_categoria ORDER BY e.id_entrada DESC";
	}

	$consult = $core->query($sql);

	return $consult;
}

//consult con condicion
function consultCondicion($core,$tabla,$campo,$data){
	$devolvemos = array();

	$sql = "SELECT * FROM {$tabla} WHERE {$campo} = '$data'";
	$result = $core->query($sql);

	if ($result->num_rows >= 1) {
		$row = $result->fetch_assoc();
		foreach ($row as $key => $value) {
			$devolvemos[$key] = $value;
		}
	}

	return $devolvemos;
}

/*INSERTS*/

//script para insert usuarios
function insertUser($core,$data){

	$devolvemos = array();

	$datos = zanenadoDatos($core,$data);

	$query = "INSERT INTO usuarios (nombre,apellido,email,password,fecha) VALUES('$datos[nombre]','$datos[apellido]','$datos[correoValidado]','$datos[passwordEncriptada]',NOW())";

	$insert = $core->query($query);

	if ($insert) {
		$devolvemos['tipo'] = 'success';
		$devolvemos['msj'] = 'Cuenta creada';
	}else{
		$devolvemos['tipo'] = 'error';
		$devolvemos['msj'] = 'Error al crear cuenta';
	}

	return $devolvemos;
}

//script para insert categorias
function insertCategorias($core,$data){
	$devolvemos = array();

	$sql = "INSERT INTO categorias VALUES('$data[id]','$data[nombre]')";
	$result = $core->query($sql);

	if ($result) {
		$devolvemos['success'] = 'Se creo correctamente la categoria';
	}else{
		$devolvemos['error'] = 'No se pudo insertar la categoria';
	}

	return $devolvemos;
}

//script para insert entradas
function insertPost($core,$data){
	$devolvemos = array();

	$sql = "INSERT INTO entradas VALUES('$data[id]','$data[usuario]','$data[categoria]','$data[titulo]','$data[descripcion]',NOW())";
	$result = $core->query($sql);

	if ($result) {
		$devolvemos['success'] = 'Se creo post correctamente';
	}else{
		$devolvemos['error'] = 'No se insertaron los datos';
	}

	return $devolvemos;
}

/*UPDATES*/

//script para editar usuario,entrada,categoria
function editarRegistro($core,$data,$type){
	$devolvemos = array();
	$sql = '';
	$result = '';

	if ($type == 'user') {
		$sql = "UPDATE usuarios SET nombre = '$data[nombre]',apellido = '$data[apellido]',email = '$data[correo]' WHERE id_user = '$data[id_user]'";
		$result = $core->query($sql);
		// echo 'editamos usuario';
	}elseif ($type == 'post') {
		echo 'editamos post';
	}else{
		echo 'editamos categoria';
	}

	if ($result) {
		$devolvemos['success'] = 'Se edito correctamente';
	}else{
		$devolvemos['error'] = 'Error al editar';
	}

	return $devolvemos;
}