<?php
date_default_timezone_set('US/Pacific');
//$mysqli = mysqli_connect('localhost', 'usuario', 'password', 'nombre_base_de_datos');
$mysqli = mysqli_connect('localhost', '', '', '');

if (!$mysqli) {
    printf("Can't connect to localhost. Error: %s\n", mysqli_connect_error());
    exit();
}
?>
