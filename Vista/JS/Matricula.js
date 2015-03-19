function BuscarEstudiante() {

  var cod=document.getElementById("CodigoDNI").value;
	var dataString={DNI:document.getElementById("CodigoDNI").value};   

  $.ajax({

    type: "POST",

    url: "/siage/Recursos/Datos.php?Modulo=Persona&Accion=BuscarEstudiante&Pagina=0&Size=100",

    data: dataString,

    cache:false,

      success: function (data) {           	

          var dats = data; 

          htmlt="<div class='panel-body'>";            

          htmlt+="<table class='table table-striped'>";

          	htmlt+="<tr>";

          		htmlt+="<td>";           

          			htmlt+="<div class='datos-Personal form-group'>";

          					htmlt+="<label for='name' class='col-sm-2 control-label'>Carrera Profecional : "+data["data"][0]["Carrera"]+"</label>";

          			htmlt+="</div>";

          		htmlt+="</td>";

            	htmlt+="<td>";

            			htmlt+="<div class='datos-Personal form-group'>";

            				htmlt+="<label for='name' id='Semestre' class='col-sm-2 control-label'> Semestre: "+data["data"][0]["semestre"]+"</label>";

               			htmlt+="</div>";

            	htmlt+="</td>";            	

            htmlt+="</tr>";

            htmlt+="<tr>";

            	htmlt+="<td>";            	

            			htmlt+="<div class='datos-Personal form-group'>";

            				htmlt+="<label for='name' class='col-sm-2 control-label'>Nombre y Apellidos : "+data["data"][0]["Nombre"]+" "+data["data"][0]["Apellido"]+"</label>";

            			htmlt+="</div>";

            	htmlt+="</td>";

            	htmlt+="<td>";

            			htmlt+="<div class='datos-Personal form-group'>";

            				htmlt+="<label for='name' class='col-sm-2 control-label'>Fecha de Nacimiento : "+data["data"][0]["Nombre"]+"</label>";

            			htmlt+="</div>";

            	htmlt+="</td>";	            	

            htmlt+="</tr>";

            htmlt+="<tr>";

            	htmlt+="<td>";

            			htmlt+="<div class='datos-Personal form-group'>";

            				htmlt+="<label for='name' class='col-sm-2 control-label'>Direccion Domiciliaria: "+data["data"][0]["Direccion"]+"</label>";

            			htmlt+="</div>";

            	htmlt+="</td>";

            	htmlt+="<td>";

            			htmlt+="<div class='datos-Personal form-group'>";

            				htmlt+="<label for='name' class='col-sm-2 control-label'>DNI: "+data["data"][0]["DNI"]+"</label>";

            			htmlt+="</div>";	            

            	htmlt+="</td>";

            htmlt+="</tr>";

            htmlt+="<tr>";

            	htmlt+="<td>";

            			htmlt+="<div class='datos-Personal form-group'>";

            				htmlt+="<label for='name' class='col-sm-2 control-label'>Correo Electronico: "+data["data"][0]["Email"]+"</label>";

            			htmlt+="</div>";

            	htmlt+="</td>";

            	htmlt+="<td>";

            			htmlt+="<div class='datos-Personal form-group'>";

            				htmlt+="<label for='name' class='col-sm-2 control-label'>Telefono: "+data["data"][0]["Telefono"]+"</label>";

            			htmlt+="</div>";	            

            	htmlt+="</td>";

            htmlt+="</tr>";

            htmlt+="</table>";  

            htmlt+="</div>";

            htmlt+="<input type='hidden' id='CodigoAlumno' name='CodigoAlumno' value='"+data["data"][0]["Codigo"]+"'>";

            htmlt+="<input type='hidden' id='idCiclo' name='idCiclo' value='"+data["data"][0]["idCiclo"]+"'>";

            htmlt+="<input type='hidden' id='idCarrera' name='idCarrera' value='"+data["data"][0]["idCarrera"]+"'>";     	

            VerificarMatricula(data["data"][0]["idCiclo"],cod);

          htmlt+="</tbody></table>";

          $("#Matricula").html(htmlt);

         //buscarPeriodo();

      },

      error: function(result) { 

      }

  });

}

function VerificarMatricula(argument,sd) 
{
  //alert(sd);
      var dataString={DNI:sd};

    $.ajax({

      type: "POST",

      url: "/siage/Recursos/Datos.php?Modulo=Matricula&Accion=VerificarMatricula&Pagina=0&Size=100",

      data: dataString,

      cache:false,

      success: function (data) 
      {  
       // alert(data['total']);
        if (data['total']>0) 
          {
             htmlt="";
            $("#Cursos").html(htmlt); 
            htmlt="<label for='name' class='col-sm-2 control-label'> Semestre : ALUMNO MATRICULADO</label>";
            $("#Periodo").html(htmlt);            
          }
        else
          { 
            buscarPeriodo();           
            BuscarMatriculaEstudiante(argument);
            
          }
      },
      error: function(result) 
      {        
      }
  });
}

function BuscarMatriculaEstudiante(sd) { 

	var dataString={DNI:sd};

    $.ajax({

      type: "POST",

      url: "/siage/Recursos/Datos.php?Modulo=Curso&Accion=ListaCursosCiclo&Pagina=0&Size=100",

      data: dataString,

      cache:false,

      success: function (data) {  

        /*if(data.length>0)

        {*/

          var dats = data;

        	indicadores="<table  class='table table-condensed'>";

            indicadores+="<thead>";

        			indicadores+="<tr>";

          			indicadores+="<th class='Modulo'>Modulo</th>";

          			indicadores+="<th class='td_Curso'>Unidad Didactica</th>";

          			indicadores+="<th class='td_Hora'>Horas</th>";

          			indicadores+="<th class='td_Credito'>Credito</th>";

        			indicadores+="</tr>";

      			indicadores+="</thead>";

  		      indicadores+="<tbody>";

          	for(indice in dats["data"]) { 

              indicadores+="<tr class='success'>";

              indicadores+="<td class='td_Modulo'>"+data["data"][indice]['AreaCurso']+"</td>";

              indicadores+="<td class='td_Curso'>"+data["data"][indice]['CursoNombre']+"</td>";

              indicadores+="<td class='td_Hora'>"+data["data"][indice]['Horas']+"</td>";

              indicadores+="<td class='td_Credito'>"+data["data"][indice]['Creditos']+"</td>";                 

              indicadores+="</tr>";          

            }

            indicadores+="</tbody></table>";

            indicadores+="<div class='panel panel-default'>";

              indicadores+="<div class='panel-footer' style='overflow:hidden;text-align:right;'>";

                indicadores+="<div class='form-group'>";

                  indicadores+="<div class='col-sm-offset-2 col-sm-10'>";  

                    indicadores+="<button type='submit' class='boton btn btn-primary' onclick='guardar();'>Registrar</button>";

                    indicadores+="<input type='submit' name='submit' class='boton btn btn-primary' value='Cancelar'>";

                  indicadores+="</div>";

                indicadores+="</div>";

              indicadores+="</div> ";

            indicadores+="</div>";                      

           $("#Cursos").html(indicadores);

         /* } else {

            $("#Cursos").html("<p>Alumno Matriculado</p>");

          }*/        

      },

      error: function(result) { 

      }

    });

}



function buscarPeriodo() {

	var dataString={idCiclo:document.getElementById("idCiclo").value};

    $.ajax({

      type: "POST",

      url: "/siage/Recursos/Datos.php?Modulo=Periodo&Accion=BuscarPeriodo&Pagina=0&Size=100",

      data: dataString,

      cache:false, 

      success: function (data) {

      	var dats = data;

      	indicadores="<input type='hidden' name='idPeriodo' id='idPeriodo' value='"+data["data"][0]["idPeriodo"]+"'>";

        indicadores+="<input type='hidden' name='idCarga' id='idCarga' value='"+data["data"][0]["idCarga"]+"'>";

        indicadores+="<label for='name' class='col-sm-2 control-label'> Semestre : "+data["data"][0]["Nombre"]+"</label>"; 

      	$("#Periodo").html(indicadores);  	

      },

      error: function(result) { 

      }

    });	

}



function guardar() {

	var dataString={

    Codigo:document.getElementById("CodigoAlumno").value,

    idCarga:document.getElementById("idCarga").value,

    idCarrera:document.getElementById("idCarrera").value,

    idCiclo:document.getElementById("idCiclo").value

  }; 

  $.ajax({

      type: "POST",

      url: "/siage/Recursos/Datos.php?Modulo=Matricula&Accion=RegistrarMatricula&Pagina=0&Size=100",

      data: dataString,

      cache:false,

    success: function (result) {            

      //alert(result.responseText);

    },

    error: function(result) {                   

    }  

  });

}