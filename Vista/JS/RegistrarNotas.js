function ListarDocente()

{  

    /******/

    var lista = $("#tayta");

    var dataString = {

      idperiodo:document.getElementById("DNI").value,

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

                                  "<button class='btn btn-xs btn-info' onclick='SeleccionarProfeta(this);'><span class='glyphicon glyphicon-pencil'></span></button>"+

                                "</span>"+

                              "</div>"+

                              "<div class='panel panel-info select_teach' style='display: none; margin-top: 15px;'>"+

                                "<div class='panel-heading'><strong>AGREGAR DOCENTE</strong>"+

                                "<div class='pull-right'><button class='close miniclose' onclick='OcultarSelect(this);'>x</button></div></div>"+

                                "<div class='panel-body'>"+

                                  "<div class='btn-group'>"+

                                    "<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>"+

                                      "Action <span class='caret'></span>"+

                                    "</button>"+

                                    "<ul class='dropdown-menu' role='menu'>"+

                                      "<li><a href='#'>Action</a></li>"+

                                      "<li><a href='#'>Another action</a></li>"+

                                      "<li><a href='#'>Something else here</a></li>"+

                                      "<li class='divider'></li>"+

                                      "<li><a href=''>Separated link</a></li>"+

                                    "</ul>"+

                                  "</div>"+

                                "</div>"+

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