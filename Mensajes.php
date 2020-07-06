<?php
   require_once("sesion.class.php");
      require_once("class/class_conexion.php");
   
   $sesion = new sesion();
   $usuario = $sesion->get("usuario");
   

?>
<?php 
          $conexion = new Conexion(); 


          $consulta0 = $conexion->consultaSql("
              SELECT idCuenta
              FROM Cuenta
              WHERE email='".$usuario."'"
              );

          if ($row = $conexion->obtenerFila($consulta0))
            $miId = $row["idCuenta"];
?>



<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="css/chat.css">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script src="https://use.fontawesome.com/45e03a14ce.js"></script>

<script>
function obtenerConversacion(id1,id2,contenidoMensaje){
        var parametros = {
                "id1" : id1,
                "contenidoMensaje" : contenidoMensaje,
                "id2" : id2
        };
        $.ajax({
                data:  parametros,
                url:   'phpMensajes/conversaciones.php',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                        $("#idContacto").val(id2);
                },
                success:  function (response) {
                        $("#resultado").html(response);

                }
        });
}

  function enviarMensaje(id1,id2,contenidoMensaje){
          var parametros = {
                  "id1" : id1,
                  "contenidoMensaje" : contenidoMensaje,
                  "id2" : id2
          };
          $.ajax({
                  data:  parametros,
                  url:   'phpMensajes/conversaciones.php',
                  type:  'post',
                  beforeSend: function () {

                          
                  },
                  success:  function (response) {
                          $("#resultado").html(response);
                          $("#mensaje").val('');
                  }
          });
  }

  $(document).ready(function( ) {    
      function actualizar(){
          var parametros = {
                  "id1" : '<?php echo $miId; ?>',
                  "contenidoMensaje" : '',
                  "id2" : $("#idContacto").val()
          };


          $.ajax({
                  data:  parametros,
                  url:   'phpMensajes/conversaciones.php',
                  type:  'post',
                  beforeSend: function () {

                  },
                  success:  function (response) {
                          $("#resultado").html(response);

                  }
          }
          );
        
  }

      setInterval(actualizar, 3000);
  });

</script>


<div class="main_section">
   <div class="container fixed">
      <div class="chat_container">
         <div class="col-sm-3 chat_sidebar">
    	 <div class="row">
       <!--Busqueda-->
            <div id="custom-search-input">
               <div class="input-group col-md-12">
                  <input type="text" class="  search-query form-control" placeholder="Conversación" />
                  <button class="btn btn-danger" type="button">
                  <span class=" glyphicon glyphicon-search"></span>
                  </button>
               </div>
            </div>

            <div class="member_list">
               <ul class="list-unstyled">
				



       <?php 


          $consulta = $conexion->consultaSql("
              SELECT idCuenta, CAST(fecha AS varchar(16)) AS fecha, nombre1, nombre2, apellido1, apellido2 
              FROM dbo.listaChat (".$miId.")
              ORDER BY fecha DESC
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
                /*Imprime lista de contactos con quienes se ha chateado*/
                          echo '
                  <li class="left clearfix" onclick="obtenerConversacion('.$miId.','.$row["idCuenta"].',0);return false;">
                     <span class="chat-img pull-left">
                     <img src="img/user-img2.jpg" class="img-circle">
                     </span>
                     <div  class="chat-body clearfix" >
                        <div class="header_sec">
                           <strong class="primary-font">'.$row["nombre1"].' '.$row["nombre2"].' '.$row["apellido1"].' '.$row["apellido2"].'</strong> <strong class="pull-right">
                           '.$row["fecha"].'</strong>
                        </div>
                     </div>
                  </li>
                  ';

             } while ($row = $conexion->obtenerFila($consulta)); 
          } else { 
          echo "¡ No hay notificaciones !"; 
          } 
        ?>





               </ul>
            </div></div>
         </div>
         <!--chat_sidebar-->
		 
		 
      <div class="col-sm-9 message_section">
		    <div class="row">
		      <div class="new_message_head">
		        <div class="pull-left"><button><i class="fa fa-plus-square-o" aria-hidden="true"></i> Conversación</button></div><div class="pull-right"><div class="dropdown">


            </div>
          </div>
		    </div><!--new_message_head-->
		  

      <div class="chat_area">
		

     <ul class=" list-group">
				



     <sapn class="" id="resultado">  
     Seleccione una conversación 
     </span>



		 
		 </ul>


		 </div><!--chat_area-->
           <span id="idContacto" value=""></span>

          <div class="message_write">
    	 <textarea id="mensaje" class="form-control" placeholder="Escribe un mensaje"></textarea>
		 <div class="clearfix"></div>
		 <div class="chat_bottom">

      <a id="" href="javascript:;" class="pull-right btn btn-success" onclick="enviarMensaje( <?php echo $miId; ?>, $('#idContacto').val(), $('#mensaje').val() );return false;">
      Enviar</a>
     </div>
		 </div>
		 </div>
         </div> <!--message_section-->
      </div>
   </div>
</div>

