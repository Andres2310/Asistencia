<!doctype html>
<html lang="es">
<?php
$conectar= pg_connect("host=127.0.0.1 dbname=cualquiera port=5432 user=postgres password=*********") or die ("Error de Conexion".pg_last_error());

if(!$conectar){
echo "No se pudo conectar con el servidor";
}
 ?>
  <head>
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/nav-vertical.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />


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
          <a href="turnos.php">
            <i class="fa fa-info-circle" aria-hidden="true"></i> Turnos
          </a>
        </li>
      </ul>
    </div>
<?php
$hola=23;
 ?>
    <div class="content-container">

      <div class="container-fluid">

        <!-- Main component for a primary marketing message or call to action -->
        <div class="container ">

          <center><h2>Lista de Sucursales</h2></center>
          <div class="row justify-content-end">


              <button type="button" class="btn btn-primary btn-lg " data-toggle="modal" data-target="#staticBackdrop">Añadir</button>




          </div>

          <table id="tabla" class="table table-bordered  " >
            <thead class="thead-dark">
              <tr>
                <th scope="col"></th>
                <th scope="col">Nro de sucursal</th>
                <th scope="col">Sucursal</th>
                <th scope="col">Direccion</th>
                <th scope="col">Modificar</th>


              </tr>
            </thead>
            <tbody>




              <?php
              //while Sucursales
              $sql="SELECT id_sucursal, numero_sucursal, suc_nombre,direccion FROM sucursal
                            WHERE sucursal.sucursal_borrado=FALSE;";
              $result = pg_query($conectar, $sql);



             while ($sucursales = pg_fetch_assoc($result)) {

               echo "        <td><a class='btn btn-link' data-toggle='collapse' href='#collapseExample".$sucursales['id_sucursal']."' role='button' aria-expanded='false' aria-controls='collapseExample".$sucursales['id_sucursal']."'><span class='badge badge-pill badge-info'>▼</span></a></td>
                             <td>".$sucursales['numero_sucursal']."</td>
                             <td>".$sucursales['suc_nombre']."</td>
                             <td>".$sucursales['direccion']."</td>
                             <td><a href='#' class='badge badge-primary'>Editar</a>
                                 <a href='borrar_sucursal.php?sucursal=".$sucursales['id_sucursal']."' class='badge badge-danger'>Borrar</a>
                             </td>


                             <!--collapsar de horarios-->
                           <tr class='collapse multicolapse' id='collapseExample".$sucursales['id_sucursal']."'>
                             <td style='display: none;'><a class='btn btn-link' data-toggle='collapse' href='#collapseExample".$sucursales['id_sucursal']."' role='button' aria-expanded='false' aria-controls='collapseExample".$sucursales['id_sucursal']."'><span class='badge badge-pill badge-info'>▼</span></a></td>
                             <td colspan='5'>".$sucursales['numero_sucursal']."
                                 <table class='table table-bordered table-sm' >
                                 <thead >
                                   <tr>

                                     <th scope='col'>Turnos</th>
                                     <th scope='col'>Hr.Ingreso 1</th>
                                     <th scope='col'>Hr.Salida 1</th>

                                     <th scope='col'>min gracia</th>
                                   </tr>
                                 </thead>
                                 <tbody>";



                    //while horario turno n
                    $sql2="SELECT nombre_turno, ingreso_1, salida_1, minutos_gracia
                            FROM horario_sucursal a
                                INNER JOIN horario b ON a.id_horario = b.id_horario INNER JOIN turno z ON b.id_turno = z.id_turno
                                INNER JOIN sucursal d ON a.id_sucursal= d.id_sucursal
                            WHERE a.id_sucursal='$sucursales[id_sucursal]'
                            AND b.borrado=FALSE;";      //CAMBIAR 1 POR ID SUCURSAR

                    $result2= pg_query($conectar, $sql2);
                    while ($sucursalHorarios = pg_fetch_assoc($result2)) {
                      echo"                        <tr>
                                                <td>".$sucursalHorarios['nombre_turno']."</td>
                                                <td>".$sucursalHorarios['ingreso_1']."</td>
                                                <td>".$sucursalHorarios['salida_1']."</td>

                                                <td>".$sucursalHorarios['minutos_gracia']."</td>
                                              </tr>";
                                            }//fin while horario de turno


                                    echo "</tbody>
                                          </table>
                                        </td>
                                        <td style='display: none;'>".$sucursales['suc_nombre']."</td>
                                        <td style='display: none;'>".$sucursales['direccion']."</td>
                                        <td style='display: none;'><a href='#' class='badge badge-primary'>Editar</a>
                                            <a href='#' class='badge badge-danger'>Borrar</a></td>
                                      </tr>";
                  }//fin while llenado de sucursales

                      ?>


            </tbody>

            <tfoot>
              <tr>
                <th scope="col"></th>
                <th scope="col">Nro de sucursal</th>
                <th scope="col">Sucursal</th>
                <th scope="col">Direccion</th>
                <th scope="col">Modificar</th>

              </tr>
            </tfoot>

          </table>


        </div>

        </div>

      </div>
    </div>


    <!-- modal añadir empresa -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Datos Sucursal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

        <form action="crea_sucursal.php?empresa=<?php echo $_GET['empresa']?>" method="post" enctype="multipart/form-data">

        <div class="modal-body">


            <div class="form-row">

              <div class="col-6">

                <div class="form-group row">

                  <label for="message-text" class="col-sm-3 col-form-label">Nro:</label>

                  <div class="col-sm-8">
                    <input type="number" name="sucursalNumero" class="form-control" required>
                  </div>

                </div>

                <div class="form-group row">

                  <label for="message-text" class="col-sm-3 col-form-label">Sucursal:</label>

                  <div class="col-sm-8">
                    <input type="text"  name="sucursalNombre" class="form-control" required>
                  </div>

                </div>


              </div>

              <div class="col-6">

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Direccion</label>
                  <textarea class="form-control" name="sucursalDireccion" rows="2"></textarea>
                </div>

              </div>

            </div>

<br>


            <div class="form-row ">

              <div class="col">

                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label" >Turno:</label>
                    <select class="js-example-basic-multiple" name="idHorario[]" multiple="multiple" style="width: 100%">
                      <?php

                      $result = pg_query($conectar,"SELECT id_horario,nombre_turno, ingreso_1, salida_1, minutos_gracia
                                                    FROM horario a
                                                        INNER JOIN turno b ON a.id_turno = b.id_turno WHERE a.borrado=FALSE;");

                      while ($turno = pg_fetch_assoc($result)) {

                        $horas=$turno['nombre_turno']." ".$turno['ingreso_1']." a ".$turno['salida_1']." - ".$turno['ingreso_2']." a ".$turno['salida_2'];

                        echo"<option value='$turno[id_horario]'>".$horas."</option>";
                        }
                       ?>

                    </select>
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

    <script>

        $('#tabla').DataTable({
        "pagingType": "full_numbers"
        });


    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        });
    </script>
  </body>
</html>
