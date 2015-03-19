$(document).ready(function(){

    comboCarrera();    

    comboModulo();

    comboCiclo();

    comboCurso();

    comboArea();

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

function comboArea()

{    

    $("#Area").kendoComboBox({

        placeholder: "Seleccione Area",

        dataTextField: "Nombre",

        dataValueField: "idArea",

        filter: "contains",

        autoBind: false,

        minLength: 3,

        dataSource: {

            type: "json",

            serverFiltering: true,

            transport: {

                read: {

                    url: "/siage/Recursos/Datos.php?Modulo=Curso&Accion=ListarArea&Pagina=0&Size=100",

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

function comboCiclo()

{    

    $("#Ciclo").kendoComboBox({

        placeholder: "Seleccione Ciclo",

        dataTextField: "Nombre",

        dataValueField: "idCiclo",

        filter: "contains",

        autoBind: false,

        minLength: 3,

        dataSource: {

            type: "json",

            serverFiltering: true,

            transport: {

                read: {

                    url: "/siage/Recursos/Datos.php?Modulo=Carrera&Accion=ListarCiclo&Pagina=0&Size=100",
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

function comboModulo()

{    

    $("#Modulo").kendoComboBox({

        placeholder: "Seleccione Modulo",

        dataTextField: "Nombre",

        dataValueField: "idModulo",

        filter: "contains",

        autoBind: false,

        minLength: 3,

        dataSource: {

            type: "json",

            serverFiltering: true,

            transport: {

                read: {

                    url: "/siage/Recursos/Datos.php?Modulo=Carrera&Accion=ListarModulo&Pagina=0&Size=100",

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

function comboCurso()

{    

    $("#Cursos").kendoComboBox({

        placeholder: "Seleccione Curso",

        dataTextField: "Nombre",

        dataValueField: "idCurso",

        filter: "contains",

        autoBind: false,

        minLength: 3,

        dataSource: {

            type: "json",

            serverFiltering: true,

            transport: {

                read: {

                    url: "/siage/Recursos/Datos.php?Modulo=Curso&Accion=Listar&Pagina=0&Size=100",

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

function RegistrarCurso() 

{   

   var dataString={idArea:document.getElementById("Area").value,

                    Nombre:document.getElementById("Nombre").value,

                    Descripcion:document.getElementById("Descripcion").value,

                    Horas:document.getElementById("Horas").value,

                    Creditos:document.getElementById("Creditos").value};     

    $.ajax({

          type: "POST",

            url: "/siage/Recursos/Datos.php?Modulo=Curso&Accion=RegistrarCurso&Pagina=0&Size=100",

            data: dataString,

            cache:false,

          success: function (result) 

          {                         

          },

          error: function(result) {

          }          

        });    

}

function RegistrarCursoCliclo() 

{   

   var dataString={Carrera:document.getElementById("Carrera").value,

                    idModulo:document.getElementById("Modulo").value,

                    idCiclo:document.getElementById("Ciclo").value,

                    idCursos:document.getElementById("Cursos").value};     

    $.ajax({

          type: "POST",

            url: "/siage/Recursos/Datos.php?Modulo=Curso&Accion=RegistrarCursoCliclo&Pagina=0&Size=100",

            data: dataString,

            cache:false,

          success: function (result) 

          {    

            alert(result.responseText);

          },

          error: function(result) {

          }          

        });    

}