<?php
require_once('linker_li.php');
$mysqli->query("SET NAMES 'utf8'");
$metodo = $_REQUEST['metodo'];

if ($metodo == 'Pruebota'){
  echo "Esta es la pruebota grandota";
}

if ($metodo == 'Pruebita'){
  echo "Esta es la pruebita chiquita";
}

if ($metodo == 'GuardaProducto'){
  $codigo = $_POST['codigo'];
  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio'];
  $status = 0;

  $query = "insert into productos (codigo, descripcion, precio)
            values ('$codigo','$descripcion','$precio')";
  $result = $mysqli->query($query);
  if ($result != FALSE){
    $status = 1;
  }

  if ($status == 1){
    echo json_encode(array('status' => 'Success'));
  }
  else {
    echo json_encode(array('status' => 'Error'));
  }

}

/*
if ($tipo == ''){
	$id = $_REQUEST['id'];
	$status = 0;
	$query = "select id, razon_social,codigo
	          from clientes where id=500";
	$result = $mysqli->query($query);
	if ($result != FALSE) {
		$output = array();
		while ($row = $result->fetch_assoc()){
			$resultado = array('id' => $row['id'],
					   'value' => $row['razon_social'],
					   'label' => $row['razon_social'],
					   'codigo' => $row['codigo']);
		   	$output[] = $resultado;
		   	$status = 1;
		}
	}
	if ($status == 1){
		echo json_encode(array('status' => 'Success', 'datos' => $output));
	}
	else
		echo json_encode(array('status' => 'Error', 'query' => $query));
}
*/
?>
