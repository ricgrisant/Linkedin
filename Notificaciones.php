
<?php
   require_once("sesion.class.php");
  include_once("class/class_conexion.php");
   
   $sesion = new sesion();
   $usuario = $sesion->get("usuario");
   $idMiCuenta=0;
   

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
      <link rel="stylesheet" href="css/style.css">
      <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
      <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
      <script src="js/inicio.js"></script>
</head>
<body>
    <h3>Notificaciones</h3>
       <div class="row container">
                <div class="col-xs-0 col-lg-4">
                    
                </div>
                <div class="col-xs-12 col-sm-12 col-lg-8  container center-blocks">

       <?php 
          $conexion = new Conexion(); 




          $consulta = $conexion->consultaSql("
            SELECT * FROM dbo.notificacionesContactos('".$usuario."') 
            ORDER BY idContacto DESC
   ");
            /*Aceptar solicitud
            UPDATE Contacto
            SET estado='A'
            WHERE idContacto= $row["idContacto"]*/
            /*Aceptar solicitud
            DELETE FROM Contacto
            WHERE idContacto= $row["idContacto"]*/
          if ($row = $conexion->obtenerFila($consulta)){ 
             do { 
                /*Imprime notificaciones de solicitudes de contacto recibidas*/
                if($row["estado"]==='S')
                  echo '
                        <div class="row card ">
                          <div class="col-7 body-card">  
                            </br>
                            <span><strong>'.$row["nombre1"].' '.$row["apellido1"].' </strong>quiere agregarte a sus contactos</span><br/></br>
                             <button type="button" class="btn" onclick="Aceptar('."'".$usuario."'".','.$row["idContacto"].','.$row["idCuenta"].');">Aceptar</button>
                             <button type="button" class="btn btn-danger" onclick="Rechazar('."'".$usuario."'".','.$row["idContacto"].','.$row["idCuenta"].');">Rechazar</button>
                             <br/>
                            <br/>
                          </div>
                        </div>
                       ';
                /*Imprime notificaciones de solicitudes de contacto aceptadas por el otro usuario*/
                if($row["estado"]==='A')
                  echo '
                        <div class="row card ">
                          <div class="col-7 body-card">  
                            </br>
                            <span><strong> '.$row["nombre1"].' '.$row["apellido1"].' </strong> te ha aceptado como contacto</span><br/></br>
  
                             <br/>
                            <br/>
                          </div>
                        </div>
                       ';

             } while ($row = $conexion->obtenerFila($consulta)); 
          } else { 
          echo "¡ No hay notificaciones !"; 
          } 
        ?>
        </div>
       </div>   
</body>


</html>