

<?php
include_once("../sesion.class.php"); 
include_once("../class/class_conexion.php");

$session = new sesion();
$usuario = $session->get("usuario");

/*Hay una sesion activa y se envian parametros(minimo el post)*/
if (isset($_POST['idContacto']) && isset($usuario)) 
{

   /*Se carga el post en la BD*/
   $conexion = new Conexion();
   if( $conexion ) 
   {
      
      $sqlCuentaActual = 
      "select c.idCuenta from Cuenta c
      where c.email="."'".$usuario."'";

      $idCuentaActual = $conexion->consultaSql($sqlCuentaActual);
      $row =  $conexion->obtenerFila($idCuentaActual);
      $_SESSION["idCuentaActual"] = $row['idCuenta'];
      sqlsrv_free_stmt( $idCuentaActual);

      $sqlSolicitud = "exec sp_AceptaSolicitudAmistad ".
      $row["idCuenta"].",".$_POST["idCuentaContacto"];

      $aceptaSolicitud = $conexion->consultaSql($sqlSolicitud);
       print_r( $row );

      print_r($conexion->obtenerFila($aceptaSolicitud) );

      /*if(!$aceptaSolicitud){
        return -1;
      }
      else{
         return 1;
      }*/
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

