$(document).ready(function(){

    comboCarrera(); 

    UltimoPeriodo();     

});

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

    $(".Docente").kendoComboBox({

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

              lista.append("<form enctype='multipart/form-data' onsubmit='AgregarCursoCarga(this);return false;'>"+

                            "<div class='list-group-item'>"+

                              "<div>"+data["data"][dato]["Nombre"]+""+

                                "<span class='pull-right'>"+

                                  "<button class='btn btn-xs btn-info' onclick='SeleccionarProfeta(this);'><span class='glyphicon glyphicon-pencil'></span></button>"+

                                "</span>"+

                                "<input type='hidden' name='idCarga' value='"+data["data"][dato]["idCarga"]+"'>"+

                                "<input type='hidden' name='idCurso_Semestre' value='"+data["data"][dato]["idCurso_Semestre"]+"'>"+

                              "</div>"+

                              "<div class='panel panel-info select_teach' style='display: none; margin-top: 15px;'>"+

                                "<div class='panel-heading'><strong>AGREGAR DOCENTE</strong>"+

                                "<div class='pull-right'><button class='close miniclose' onclick='OcultarSelect(this);'>x</button></div></div>"+

                                "<div class='panel-body'>"+

                                  "<div class='btn-group'>"+

                                    "<div class='form-group'>"+

                                      "<label for='State' class='col-sm-2 control-label'>Docente</label>"+

                                      "<div class='col-sm-11'>"+

                                        "<input  class='Docente' name='Docente' style='width: 400px'/>"+
                                        "<button type='submit' class='btn btn-theme'>AGREGAR</button>"+

                                      "</div>"+

                                    "</div>"+                                    

                                  "</div>"+

                                "</div>"+

                              "</div>"+

                            "</div></form>");                    



          };

          comboDocente();                    

      },

      error: function(result) {

          lista.empty();

          lista.append("<div class='list-group-item'>"+JSON.stringify(result)+"</div>");

      }

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
      //alert(result.responseText);
      },
      error: function(result) {       
      },
        cache: false,
        contentType: false,
        processData: false
        });
  /*
  alert(document.getElementsByName("Docente_input").value);

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

}



function SeleccionarProfeta (item) {

    var listaitem = $(item).parent().parent().parent();  

    $(listaitem).children('.select_teach').show("fast");     

}

function OcultarSelect (item) {

    var listaitem = $(item).parent().parent().parent().parent();

    listaitem.children('.select_teach').hide("fast");

}