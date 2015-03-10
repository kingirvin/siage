function guardar(sd)
{
	var dataString={DNI:document.getElementById("DNI").value,
					Nombre:document.getElementById("Nombre").value,
					Apellido:document.getElementById("Apellido").value,
					Direccion:document.getElementById("Direccion").value,
					Telefono:document.getElementById("Telefono").value,
					Email:document.getElementById("Email").value,
					Especialidad:document.getElementById("Especialidad").value};
    $.ajax({
          type: "POST",
            url: "/Recursos/Datos.php?Modulo=Persona&Accion=RegistrarDocente&Pagina=0&Size=100",            	 
            data: dataString,
            cache:false,
          success: function (data) 
          {       
            //document.getElementById("Periodo").value=data["data"][0]["Nombre"];                  
          },
          error: function(data) {
          }          
        }); 	
}
