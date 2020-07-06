$(document).ready(function() {
	/*Funcion que toma parametros del posteo y envia peticion de ajax*/
	$("#postear").click(function(event) {
		if ($("#contenidoPst").val()=='') {
			alert('Debe ingresar texto para postear'); 	
		}
		else{

			var dt = new Date();
			var mes = dt.getMonth()+1;
			var parametros= 
			"txt-post="+$("#contenidoPst").val()+
			"&pst-hora="+dt.getHours()+
			"&pst-minutos="+dt.getMinutes()+
			"&pst-segundos="+dt.getSeconds()+
			"&pst-dia="+dt.getDate()+
			"&pst-mes="+mes+
			"&pst-anio="+dt.getFullYear();
			console.log(parametros);

			$.ajax({
				url: "ajax/post.php",
				method: "POST",
				data: parametros,
				success:function(respuesta){
					console.log(respuesta);
					Postea();
				},
				error:function(){
					alert("Ocurrio un error.");
				}
			});

		}
	});

	/*Funcion que se encraga de mostrar sugerencias en las busqeudas*/
	var consulta;

     //hacemos focus al campo de búsqueda
     $("#busqueda").focus();

    //comprobamos si se pulsa una tecla
    $("#busqueda").keyup(function(e){

          //obtenemos el texto introducido en el campo de búsqueda
          var parametros = "b="+ $("#busqueda").val();                                                                   
          //hace la búsqueda

          $.ajax({
          	type: "POST",
          	url: "ajax/buscar.php",
          	data: parametros,
          	dataType: "html",
          	error: function(){
          		alert("error petición ajax");
          	},
          	success: function(data){
          		$("#resultado").css("display", "initial");                                                     
          		$("#resultado").empty();
          		$("#resultado").html(data);

          	}
          });


      });

    
});

function Postea() {
	    //obtine lo escrito en <textarea>
	    var obtener = [$("#contenidoPst").val()];  
	    memoria = new Array();
	    memoria.push(obtener);
	    $(".timeline-wrapper").fadeIn(200);
	    $(".timeline-wrapper").fadeOut( 2000, function() {
	    	console.log(memoria);
	    	var d = new Date();
	    	var mes = d.getMonth()+1;
	    	var n = d.getFullYear()+'-'+d.getDate()+'-'+mes+'  '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
	    	$("#postSepara").after('<div class="card mb-3">'+		                
	    		'<div class="card-body">'+		     		                 
	    		'<p>'+memoria[0]+'</p>'+
	    		'<p class="card-text"><small class="text-muted">'+n+'</small></p>'+
	    		'</div>'+
	    		'</div>');
	    	$("#contenidoPst").val('');
	    });
	};
	/*Elimina contacto al dar click*/
	function Eliminar(correo) {

		var parametros= "correoEliminar="+correo
		$.ajax({
			url: "ajax/eliminarContacto.php",
			method: "POST",
			data: parametros,
			beforeSend: function(){
				alert("Esta seguro que desea eliminar a: "+correo+" de tus contactos?");
			},
			success:function(respuesta){
				console.log(respuesta);
				alert("El contacto: "+ correo + "se ha eliminado con Exito");
				location.reload();
			},
			error:function(){
				alert("Ocurrio un error.");
			}
		});
	};

	function Contacto(correo,nombre1,apellido1) {
		console.log(correo +" "+ nombre1  +" "+ apellido1);
		$("#modalContacto").html(Modal(correo,nombre1,apellido1));

		$("#addContacto").click(function(event) {
    	addContacto(correo);

    });
	}
/*Crea la ventana modal con la busqueda*/
	function Modal(correo,nombre1,apellido1) {
			return '<div class="row" id="div-contact">'+
                           '<div id="'+correo+'" class="col-sm">'+
                           '<img class="rounded-circle" src="images/default.jpg" alt="Generic placeholder image" width="140" height="140">'+
                           '<h2>'+nombre1+" "+apellido1+'</h2>'+
                           '<p>'+correo+'</p>'+
                           '</div>'+
                           '</div>';
                           
	}

/*Funcion que envia una solicitud de amistad en ventana modal*/

function addContacto(correo) {

		var parametros= "correoSolicitud="+correo
		$.ajax({
			url: "ajax/enviaSolicitud.php",
			method: "POST",
			data: parametros,
			beforeSend: function(){
				alert("Esta seguro de enviar solicitu a: "+correo);
			},
			success:function(respuesta){
				console.log(respuesta);
				if (respuesta=1) {
					alert("Se ha enviado solicitud a: "+ correo + " con Exito");
				} else {
					alert("No se envio la solicitud debido a que ya fue enviada o ya es tu contacto");
				}
				
				location.reload();
			},
			error:function(){
				alert("Ocurrio un error.");
			}
		});
	};

	function Aceptar(cuentaActual,idContacto,idCuentaContacto) {
		var parametros= "cuentaActual="+cuentaActual+
						"&idContacto="+idContacto+
						"&idCuentaContacto="+idCuentaContacto;
		$.ajax({
			url: "ajax/aceptaSolicitud.php",
			method: "POST",
			data: parametros,
			success:function(respuesta){
				/*if (respuesta=1) {*/
					alert("Se acepto la solicitud de amistad");
				console.log(respuesta);
				/*location.reload();*/
				/*} else {
					alert("Hubo un problema");
				}*/
				
			},
			error:function(){
				alert("Ocurrio un error.");
			}
		});
	}

	function Rechazar(cuentaActual,idContacto,idCuentaContacto) {
		var parametros= "cuentaActual="+cuentaActual+
						"&idContacto="+idContacto+
						"&idCuentaContacto="+idCuentaContacto;
		$.ajax({
			url: "ajax/rechazaSolicitud.php",
			method: "POST",
			data: parametros,
			success:function(respuesta){
				if (respuesta=1) {
					alert("Se rechazo la solicitud de amistad");
				console.log(respuesta);
				location.reload();
				} else {
					alert("Hubo un problema");
				}
				
			},
			error:function(){
				alert("Ocurrio un error.");
			}
		});
	}