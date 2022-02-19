<?php
require_once('linker_li.php');
$mysqli->query("SET NAMES 'utf8'");
$metodo = $_REQUEST['metodo'];

if ($metodo == 'Pruebota'){
  echo "Esta es la pruebota grandota";
}

if ($metodo == 'Pruebita'){
  $estavariable = $_GET['estavariable'];
  echo "Esta es la pruebita chiquita<br><br>";
  echo $estavariable;
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

if ($metodo == 'DameProductosDetalles'){
  $idProducto = $_POST['idProducto'];
  $status = 0;
  $codigo = '';
  $descripcion = '';
  $precio = '';

  //Como solo me resulta un renglo de la consulta, recibo
  //los valores en sus correspondientes variables
  $query = "select codigo, descripcion, precio
            from productos
            where id = '$idProducto'";

  $result = $mysqli->query($query); //Ejecuto la consulta
    if ($result != FALSE) { //Si fue exitosa la consulta
      $output = array();
      while ($row = $result->fetch_assoc()){
        $codigo = $row['codigo'];
        $descripcion = $row['descripcion'];
        $precio = $row['precio'];
        $status = 1;
      }
  }

  if ($status == 1){
    echo json_encode(array('status' => 'Success', 'codigo' => $codigo,
                           'descripcion' => $descripcion, 'precio' =>$precio));
  }
  else {
    echo json_encode(array('status' => 'Error'));
  }
}

if ($metodo == 'DameProductos'){
  $status = 0;
  $query = "select id, codigo
            from productos
            where activo = 1";
  $result = $mysqli->query($query); //Ejecuto la consulta
  if ($result != FALSE) { //Si fue exitosa la consulta
    $output = array();
    while ($row = $result->fetch_assoc()){
      $resultado = array('id' => $row['id'],
          					     'codigo' => $row['codigo']);
      $output[] = $resultado;
      $status = 1;
    }
  }
  //echo "<pre>";
  //print_r($output);
  //echo "</pre>";

  if ($status == 1){
    echo json_encode(array('status' => 'Success', 'items' => $output));
  }
  else {
    echo json_encode(array('status' => 'Error'));
  }
}

if ($metodo == 'GuardaProductoCambio'){
  $codigo = $_POST['codigo'];
  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio'];
  $idProducto = $_POST['idProducto'];
  $status = 0;

  $query = "update productos set codigo='$codigo',
            descripcion='$descripcion', precio='$precio'
            where id = $idProducto";
  $result = $mysqli->query($query); //Ejecuto la consulta
  if ($result != FALSE) { //Si fue exitosa la consulta
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
