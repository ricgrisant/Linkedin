

<?php
include_once("../sesion.class.php"); 
include_once("../class/class_conexion.php");

$session = new sesion();
$usuario = $session->get("usuario");

/*Hay una sesion activa y se envian parametros(minimo el post)*/
if (isset($_POST['correoEliminar']) && isset($usuario)) 
{

	/*Se carga el post en la BD*/
	$conexion = new Conexion();
	if( $conexion ) 
	{
		echo "Conexión establecida a la BD";
		$sqlContacto = 
		"select c.idCuenta from Cuenta c
		where c.email="."'".$_POST['correoEliminar']."'";

		$sqlCuentaActual = 
		"select c.idCuenta from Cuenta c
		where c.email="."'".$usuario."'";

		$idCuentaActual = $conexion->consultaSql($sqlCuentaActual);
		$idCuentaContacto = $conexion->consultaSql($sqlContacto);
		$row =  $conexion->obtenerFila($idCuentaActual);
		$row2 =  $conexion->obtenerFila($idCuentaContacto);
		$_SESSION["idCuentaActual"] = $row['idCuenta'];
		sqlsrv_free_stmt( $idCuentaActual);
		sqlsrv_free_stmt( $idCuentaContacto);

		$sqlEliUsu = "exec sp_eliminarContacto"." ".$row['idCuenta'].",".$row2['idCuenta'];	
		echo $sqlEliUsu;
		$eliminarContacto = $conexion->consultaSql($sqlEliUsu);

	}
	else
	{
		echo "Conexión no se pudo establecer.<br />";
		die( print_r( sqlsrv_errors(), true));
	}

} 
else 
{
	echo "No se ha recibido contenido";
}

?>

