$(document).ready(function(){

    comboCarrera(); 
    comboDocente();
    UltimoPeriodo();
    h();

});
function h() 
{ 
  var myBookId = $(this).data('id');

  var myBookId = $(this).data('id'); $(".modal-body #DNI").val( myBookId );
}


function comboCarrera ()

{    

    $("#Carrera").kendoComboBox({

        placeholder: "Seleccione Carrera",

        dataTextField: "nombre",

        dataValueField: "idCarrera",

        filter: "contains",

        autoBind: false,

        minLength: 3,

        dataSource: {

            type: "json",

            serverFiltering: true,

            transport: {

                read: {

                    url: "/siage/Recursos/Datos.php?Modulo=Carrera&Accion=Listar&Pagina=0&Size=100",

                }

            },

            schema: 

            {

              data: "data",//lo que  esta definido detro de data:{} solo los datos
              total: "total"//los que esta ddefinido en total: es la cantidad de elementos devueltos                   

            }

        }

    }).data("kendoComboBox");    

}

function comboDocente ()
{    

    $("#Docente").kendoComboBox({

        placeholder: "Seleccione Docente",

        dataTextField: "Nombre",

        dataValueField: "idDocente",

        filter: "contains",

        autoBind: false,

        minLength: 3,

        dataSource: {

            type: "json",

            serverFiltering: true,

            transport: {

                read: {

                    url: "/siage/Recursos/Datos.php?Modulo=Persona&Accion=ListarDocente&Pagina=0&Size=100",

                }

            },

            schema: 

            {

              data: "data",//lo que  esta definido detro de data:{} solo los datos

              total: "total"//los que esta ddefinido en total: es la cantidad de elementos devueltos                   

            }

        }

    }).data("kendoComboBox");    

}

function UltimoPeriodo() 

{  

  var dataString;

    $.ajax({

          type: "POST",

            url: "/siage/Recursos/Datos.php?Modulo=Periodo&Accion=UltimoPeriodo&Pagina=0&Size=100",

            data: dataString,

            cache:false,

          success: function (data) 

          {  

            if(data["total"]>0)     

              document.getElementById("Periodo").value=data["data"][0]["Nombre"];

              document.getElementById("idperiodo").value=data["data"][0]["idPeriodo"];                  

          },

          error: function(data) {

          }          

        });  

}   

function RegistrarPeriodo()

{

   var dataString={Nombre:document.getElementById("Nombre").value};

    $.ajax({

          type: "POST",

            url: "/siage/Recursos/Datos.php?Modulo=Periodo&Accion=Registrar&Pagina=0&Size=100",

            data: dataString,

            cache:false,

          success: function (data) 

          {       

            //document.getElementById("Periodo").value=data["data"][0]["Nombre"];                  

          },

          error: function(data) {

          }          

        }); 

    UltimoPeriodo();

}

function RegistrarCursoDocente()

{

   var dataString={Nombre:document.getElementById("Nombre").value};

    $.ajax({

          type: "POST",

            url: "/siage/Recursos/Datos.php?Modulo=Periodo&Accion=Registrar&Pagina=0&Size=100",

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



function ListarCursoCarrera()

{  

    /******/

    var lista = $("#tayta");

    var dataString = {

      idperiodo:document.getElementById("idperiodo").value,

      Carrera:document.getElementById("Carrera").value

    };

    $.ajax({

      type: "POST",

      url: "/siage/Recursos/Datos.php?Modulo=Carga&Accion=ListarCursoCarga&Pagina=0&Size=100",

      data: dataString,

      cache:false,

      success: function (data) 

      { 

          lista.empty();

          for (var dato in data["data"]) {  
              lista.append("<div class='list-group-item'>"+
                              "<div>"+data["data"][dato]["Nombre"]+""+
                                "<span class='pull-right'>"+                                  
                                  "<a data-toggle='modal' data-id='777777777' title='Add this item' class='open-Modal btn btn-primary'  href='javascript:void(0);' onclick='MostrarDocente("+data["data"][dato]["idCarga"]+","+data["data"][dato]["idCurso_Semestre"]+");'>test</a>"+
                                "</span>"+
                            "</div>"+
                            "</div>");
          };         

      },

      error: function(result) {

          lista.empty();

          lista.append("<div class='list-group-item'>"+JSON.stringify(result)+"</div>");

      }

    });     

}
function MostrarDocente(a,b)
{
  VerificarDocenteCurso(a,b);
  document.getElementById("idCarga").value=a;
  document.getElementById("idCursoSemestre").value=b;
  $('#myModalDoc').modal('toggle')  
}
function VerificarDocenteCurso(a,b)
{   
    var dataString={idCarga:a,
                    idCurso_Semestre:b};
      $.ajax({
      type: "POST",
      url: "/siage/Recursos/Datos.php?Modulo=Persona&Accion=ListarDocenteCursoCarga&Pagina=0&Size=100",
      data: dataString,
      cache:false,
      success: function (data) 
      { 
         document.getElementById("nombreDocente").innerHTML="Docente : " +data["data"][0]["nombre"];
      },
      error: function(result) {  
     alert(result.responseText);     
      },
    });
       
    
}
function AgregarCursoCarga(sd)
{      
   var formdata=new FormData(sd);        
          $.ajax({
              url: "/siage/Recursos/DatosFormulario.php?Modulo=Carga&Accion=RegistrarCursoCarga&Pagina=0&Size=100",
              type: "POST",
              data: formdata,
              async:false,
              success: function (result) 
              {              
              alert(result.responseText);
              },
              error: function(result) {       
                alert(result.responseText);
              },
                cache: false,
                contentType: false,
                processData: false
                });  
 /* alert(document.getElementsByName("Docente_input").value);

   var dataString = {

      idcarga:idcarga,

      idCurso_Semestre:idCurso_Semestre,

      idDocente:document.getElementsByName("Docente").value

    };

    $.ajax({

          type: "POST",

            url: "/siage/Recursos/Datos.php?Modulo=Carga&Accion=RegistrarCursoCarga&Pagina=0&Size=100",

            data: dataString,

            cache:false,

          success: function (data) 

          {       

            //document.getElementById("Periodo").value=data["data"][0]["Nombre"];                  

          },

          error: function(data) {

          }          

        }); */

}

function MostrarTodos() { 

    $("#tayta").children().children(".select_teach").show("fast");   

}



function OcultarTodos() {

    $("#tayta").children().children(".select_teach").hide("fast");
    document.getElementById("dato").value=0;

}



function SeleccionarProfeta (item,sd) {

    var listaitem = $(item).parent().parent().parent();
    $(listaitem).children('.select_teach').show("fast");       
}

function OcultarSelect (item) {

    var listaitem = $(item).parent().parent().parent().parent();

    listaitem.children('.select_teach').hide("fast");

}