

	<?php 


				para obtener los post de amigos

                  if (!$sqlContactos) {
                    echo "Hubo un problema con la consultaSql";
                    var_dump(sqlsrv_errors());
                 }
                 else
                 {
                  if ($contactos===false) {

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

                     foreach ($ctTemp as $value) {
                        $sqlPost = 
                        "select * from fn_posteo(".$value.")";
                        $posts = $conexion->consultaSql($sqlPost;
                        $row2 =  $conexion->obtenerFila($post);
                        sqlsrv_free_stmt( $posts);
                     }
                  }

                 /*while($row = $conexion->obtenerFila($posts))
                 {
                   if (isset($row['urlimagen'])) {
                     $horaPost=$row['horaPosteo'];
                     echo '<div class="card mb-3">
                     <img class="card-img-top" src="'.$row['urlimagen'].'">'.
                     '<div class="card-body">
                     <h5 class="card-title">Card title</h5>
                     <p class="card-text">'.$row['contenido'].'</p>'.
                     '<p class="card-text"><small class="text-muted">'.$horaPost->format('Y-m-d H:i:s').'</small></p>
                     </div>
                     </div>';
                  } 
                  else 
                  {
                    $horaPost=$row['horaPosteo'];
                    echo '<div class="card mb-3">'.
                    '<div class="card-body">
                    <p class="card-text">'.$row['contenido'].'</p>'.
                    '<p class="card-text"><small class="text-muted">'.$horaPost->format('Y-m-d H:i:s').'</small></p>
                    </div>
                    </div>';
                 }
              }*/
           } 
        } 

        ?>