$(document).ready(function(){
    $("#contactos").click(function(){
    	$("#contenido").load('Contactos.php');
    });
    $("#mensajes").click(function(event){
    	$("#contenido").load('Mensajes.php');
	});
	$("#notificaciones").click(function(event){
    	$("#contenido").load('Notificaciones.php');
	});
	$("#empleos").click(function(event){
    	$("#contenido").load('Empleos.php');
	});
});



