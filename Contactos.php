<?php 
include_once("class/class_conexion.php");
include_once("sesion.class.php");  

$session = new sesion();
$usuario = $session->get("usuario");

if (!$usuario) {
   header("Location: login.php");
} else 
{
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
      <body>
         <!--Cartas de la parte superior-->
         <div class="container">
            <div class="row" id="row1">
               <div class="col-sm">
                  <!--Primera Cartas de la parte superior-->
                  <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                     <div class="card-header">Header</div>
                     <div class="card-body">
                        <h5 class="card-title">Primary card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                     </div>
                  </div>
               </div>
               <!--Segunda Cartas de la parte superior-->
               <div class="col-sm">
                  <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                     <div class="card-header">Header</div>
                     <div class="card-body">
                        <h5 class="card-title">Primary card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                     </div>
                  </div>
               </div>
               <!--Tercera Cartas de la parte superior-->
               <div class="col-sm">
                  <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                     <div class="card-header">Header</div>
                     <div class="card-body">
                        <h5 class="card-title">Primary card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                     </div>
                  </div>
               </div>
            </div>
            <div>
               <!--COntactos-->
               <?php 
               $conexion = new Conexion();
               if( $conexion ) 
               {
                  $sqlUsuario = 
                  "select c.idCuenta from Cuenta c
                  where c.email="."'".$usuario."'";

                  $idCuenta = $conexion->consultaSql($sqlUsuario);
                  $row2 =  $conexion->obtenerFila($idCuenta);
                  sqlsrv_free_stmt( $idCuenta);

                  $sqlContactos="exec sp_misContactos ".$row2['idCuenta'];

                  $contactos = $conexion->consultaSql($sqlContactos);




                  if (!$contactos) {
                    echo "Hubo un problema con la consultaSql";
                    var_dump(sqlsrv_errors());
                 }
                 else
                 {
                  $row=$conexion->obtenerFila($contactos);
                  if ($row===false || $row===null || $row['esContacto']===0) {

                     echo '<div class="row" id="div-contact">
                     <div class="col-lg-12">
                     <img class="rounded-circle" src="images/default.jpg" alt="Generic placeholder image" width="140" height="140">
                     <h2>Oppps!!</h2>
                     <p>Tal parece que no tienes contactos, Comienza a conocer personas.</p>
                     <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
                     </div>
                     </div>';
                  } else {
                     while($row = $conexion->obtenerFila($contactos))
                     {
                        if ($row['esContacto']===1) {
                           $ctTemp[]=$row['Cuenta_idCuenta1'];
                        }

                     }
                     if (isset($ctTemp)) {
                        foreach ($ctTemp as $value) {
                           $sqlGetEmail = 
                           "select c.email,p.nombre1 from Cuenta c
                           inner join Persona p on p.idPersona=c.Persona_idPersona
                           where idCuenta=".$value;
                           $emailCt= $conexion->consultaSql($sqlGetEmail);
                           $row2 =  $conexion->obtenerFila($emailCt);

                           echo 
                           '<div class="row" id="div-contact">
                           <div id="'.$row2["email"].'" class="col-sm">
                           <img class="rounded-circle" src="images/default.jpg" alt="Generic placeholder image" width="140" height="140">
                           <h2>'.$row2["nombre1"].'</h2>
                           <p>'.$row2["email"].'</p>
                           <p><button class="btn btn-danger"onclick="Eliminar('."'".$row2["email"]."'".')">Eliminar</button></p>
                           </div>
                           </div>';
                        }

                     }
                     
                  }
               } 
            } 

            ?>
         </div>
      </body>
      </html>
      
      <?php 
   }
   ?>
