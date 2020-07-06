<!DOCTYPE html>
<html>
<head>
      <link rel="stylesheet" href="css/style.css">
      <script src="js/inicio.js"></script>
</head>
<body>

</body>
</html>
<?php
include_once("../sesion.class.php"); 
include_once("../class/class_conexion.php");

$session = new sesion();
$usuario = $session->get("usuario");

$buscar = $_POST['b'];

if(!empty($buscar) && isset($usuario)) {
      buscar($buscar);
}

function buscar($b) {
      $conexion = new Conexion();

      $sqlBusqueda = 
      "SELECT cu.email,p.nombre1, p.apellido1
      FROM Cuenta cu INNER JOIN Persona p ON cu.Persona_idPersona=p.idPersona
      WHERE p.nombre1 LIKE"."'%".$b."%'";


      $busqueda = $conexion->consultaSql($sqlBusqueda);

      $contar = sqlsrv_num_rows($busqueda);

      if(!($row=$conexion->obtenerFila($busqueda))){
            echo "No se han encontrado resultados para '<b>".$b."</b>'.";
      }else{
            while($row=$conexion->obtenerFila($busqueda)){
                  $nombre = $row['nombre1'];
                  $apellido = $row['apellido1'];

                  echo '<div class="col-sm">'.$nombre." ".$apellido.'</div>'.'<div class="col-sm"><button id="verContacto" 
                  onclick="Contacto('."'".$row["email"]."'".','."'".$row["nombre1"]."'".','."'".$row["apellido1"]."'".')" 
                  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                              Ver...
                        </button><div class="dropdown-divider"></div></div>';
            }
      }
}

?>