<?php
include_once("class/class_conexion.php");
$conexion = new Conexion();
$sql = "select c.idCuenta from Cuenta c
where c.email='admin'";
//$params = array(1, "some data");
$conexion->consultaSql($sql);
$stmt = $conexion->consultaSql($sql);
if( $stmt === false ) {
	die( print_r( sqlsrv_errors(), true));
}

echo "<table border='1'>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>";

while($row = $conexion->obtenerFila($stmt))
{
	echo "<tr>";
	echo "<td>" . $row['idCuenta'] . "</td>";
	echo "</tr>";
}
echo "</table>";


$conexion->liberarResultado($stmt);

?>