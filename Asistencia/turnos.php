<!doctype html>
<html lang="es">
<?php $conectar= pg_connect("host=127.0.0.1 dbname=cualquiera port=5432 user=postgres password=********") or die ("Error de Conexion".pg_last_error()); ?>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="css/nav-vertical.css">

    <title>menu principal</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-global sticky-top justify-content-center" style="background-color: #1f4d7e;">
      <!-- Navbar content -->
      <a class="navbar-brand" href="empresa.php">
        <img src="promonitor.jpg" width="60" height="60" class="d-inline-block align-top" alt="70px">

      </a>

      <a class="navbar-brand mx-auto font-weight-bold text-monospace " href="#"><h2>Promonitor</h2></a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item ml-auto">
                <a class="nav-link" href="#">Cerrar Sesion</a>
            </li>
        </ul>
      </div>
    </nav>


    <div class="sidebar-container">

      <ul class="sidebar-navigation">
        <li>
          <a href="kardex.php">
            <i class="fa fa-home active" aria-hidden="true" ></i> Kardex
          </a>
        </li>
      <!--<li>
          <a href="menu.html?empresa=1">
            <i class="fa fa-tachometer" aria-hidden="true"></i> Reporte General
          </a>
        </li> -->

        <li>
          <a href="personal.php?empresa=1">
            <i class="fa fa-users" aria-hidden="true"></i> Personal
          </a>
        </li>
        <li>
          <a href="sucursal.php?empresa=1">
            <i class="fa fa-cog" aria-hidden="true"></i> Sucursal
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-info-circle" aria-hidden="true"></i> Turnos
          </a>
        </li>
      </ul>
    </div>

    <div class="content-container">

      <div class="container-fluid">

        <!-- Main component for a primary marketing message or call to action -->
        <div class="container ">

          <center><h2>Lista de Turnos</h2></center>
          <div class="row justify-content-end">


              <button type="button" class="btn btn-primary btn-lg " data-toggle="modal" data-target="#staticBackdrop">Añadir</button>



          </div>
        </div>

<div class="container">

  <div class="table-responsive" >

    <table  class="table table-bordered table-md table-hover" id="tabla">
      <thead class="thead-dark">
        <tr>


          <th scope="col">Turnos</th>
          <th scope="col">Hr.Ingreso </th>
          <th scope="col">Hr.Salida </th>
          <th scope="col">Minutos de gracia</th>
          <th scope="col">acciones</th>

        </tr>
      </thead>
      <tbody>

        <?php
        if(!$conectar){
          echo "No se pudo conectar con el servidor";
        }else {
          // code..

        $sql="SELECT id_horario,b.id_turno,nombre_turno, ingreso_1, salida_1, minutos_gracia
              FROM horario a
                  INNER JOIN turno b ON a.id_turno = b.id_turno
                          WHERE borrado=FALSE;";

        $result = pg_query($conectar, $sql);

        while ($horario = pg_fetch_assoc($result)) {

         echo"      <tr>
                 <td>".$horario['nombre_turno']."</td>
                 <td>".$horario['ingreso_1']."</td>
                 <td>".$horario['salida_1']."</td>
                 <td>".$horario['minutos_gracia']."</td>
                 <td><a href='?edit=".$horario['id_horario']."&turno=".$horario['nombre_turno']."&in1=".$horario['ingreso_1']."&sal1=".$horario['salida_1']."&checkbox=".$horario['id_turno']."&min=".$horario['minutos_gracia']."' class='badge badge-primary'>Editar</a>
                     <a href='borrar_turno.php?horario=".$horario['id_horario']."' class='badge badge-danger'>Borrar</a>
                 </td>
               </tr>";
        }
        }
         ?>


      </tbody>

      <tfoot>
        <tr>

          <th scope="col">Turnos</th>
          <th scope="col">Hr.Ingreso </th>
          <th scope="col">Hr.Salida </th>
          <th scope="col">Minutos de gracia</th>
        </tr>
      </tfoot>

    </table>

  </div>


          </div>

        </div>
      </div>


</div>




    <!-- modal añadir empresa -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Nuevo Turno</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

        <form action="crea_turno.php?prueba=10" method="post" enctype="multipart/form-data">

        <div class="modal-body">

              <div class="form-row">

                <div class="form-group">

                  <label class="form-label" for="defaultCheck1">
                    Nombre turno
                  </label>
                  <input type="text" name="nombre_turno" class="form-control" id="recipient-name" required>

                </div>

              </div>




            <div class="form-row">

              <div class="col-6">

                <div class="form-group">

                  <label for="message-text" class="col-form-label">Hora de entrada 1:</label>

                  <div class="md-form justify-content">
                    <input type="time" id="inputMDEx1" name="horaIn1" class="form-control" required>
                  </div>

                </div>
              </div>

              <div class="col-6">

                <div class="form-group">
                  <label for="message-text" class="col-form-label">Hora de salida 1:</label>
                  <div class="md-form justify-content">
                    <input type="time" id="inputMDEx1" name="horaOut1" class="form-control" required>
                  </div>
                </div>

              </div>

            </div>




<br>

            <div class="form-row">

              <div class="col-6">
                <div class="form-group">
                  <label for="quantity" class="col-form-label">minutos de gracia:</label>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <input type="number" id="quantity" name="min_gracia" value="0" class="form-control" required>
                </div>
              </div>

            </div>



          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" name="submit" class="btn btn-primary">Agregar</button>
          </div>
          </form>
        </div>


      </div>
    </div>
    <!-- termina nueva empresa-->


    <!-- modal editar empresa -->
    <div class="modal fade" id="editar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editarLabel" aria-hidden="true">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editarLabel">Nuevo Turno</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
  <?php echo "<form action='editar_turno.php?horario=".$_GET['edit']."&turnoId=".$_GET['checkbox']."' method='post' enctype='multipart/form-data'>" ?>


        <div class="modal-body">

              <div class="form-row">

                <div class="form-group">

                  <label class="form-label" for="editar">
                    Nombre turno
                  </label>
                  <input type="text" name="nombre_turno" class="form-control" id="turno" required>

                </div>

              </div>




            <div class="form-row">

              <div class="col-6">

                <div class="form-group">

                  <label for="message-text" class="col-form-label">Hora de entrada 1:</label>

                  <div class="md-form justify-content">
                    <input type="time" id="ingreso_1" name="horaIn1" class="form-control" required>
                  </div>

                </div>
              </div>

              <div class="col-6">

                <div class="form-group">
                  <label for="message-text" class="col-form-label">Hora de salida 1:</label>
                  <div class="md-form justify-content">
                    <input type="time" id="salida_1" name="horaOut1" class="form-control" required>
                  </div>
                </div>

              </div>

            </div>




<br>

            <div class="form-row">

              <div class="col-6">
                <div class="form-group">
                  <label for="quantity" class="col-form-label">minutos de gracia:</label>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <input type="number" id="minutos" name="min_gracia" value="0" class="form-control" required>
                </div>
              </div>

            </div>



          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" name="submit" class="btn btn-primary">Agregar</button>
          </div>
          </form>
        </div>


      </div>
    </div>
    <!-- termina editar empresa-->



<?php
//cierra coneccion servidor
pg_close($conectar); ?>




    <!-- Optional JavaScript -->


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


<!--editar script-->
    <script>


    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
        }
        var numero = getUrlVars()["edit"];

        //alert(numero);
        if(parseInt(numero)){
          $("#editar").modal("show");
          document.getElementById("turno").value = getUrlVars()["turno"];
          document.getElementById("ingreso_1").value = getUrlVars()["in1"];
          document.getElementById("salida_1").value = getUrlVars()["sal1"];
          if(getUrlVars()["in2"]){
          document.getElementById("check").checked = true;
          document.getElementById("ingreso_2").value = getUrlVars()["in2"];
          document.getElementById("salida_2").value = getUrlVars()["sal2"];
            }

          document.getElementById("minutos").value = getUrlVars()["min"];

          $("#editar").modal("show");


        }

          // assign onclick handlers to the buttons


    </script>

    <script>

        $('#tabla').DataTable({

        "pagingType": "full_numbers"

    });


    </script>
  </body>
</html>
