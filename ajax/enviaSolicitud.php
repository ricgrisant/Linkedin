

<?php
include_once("../sesion.class.php"); 
include_once("../class/class_conexion.php");

$session = new sesion();
$usuario = $session->get("usuario");

/*Hay una sesion activa y se envian parametros(minimo el post)*/
if (isset($_POST['correoSolicitud']) && isset($usuario)) 
{

   /*Se carga el post en la BD*/
   $conexion = new Conexion();
   if( $conexion ) 
   {
      
      $sqlContacto = 
      "select c.idCuenta from Cuenta c
      where c.email="."'".$_POST['correoSolicitud']."'";

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

      $sqlSolicitud = "exec sp_addContacto"." ".$row['idCuenta'].",".$row2['idCuenta']; 
      $enviarSolicitud= $conexion->consultaSql($sqlSolicitud);

      if(!$enviarSolicitud){
        return -1;
      }
      else{
         return 1;
      }
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

