<!doctype html>
<html lang="es">
<?php $conectar= pg_connect("host=127.0.0.1 dbname=cualquiera port=5432 user=postgres password=*******") or die ("Error de Conexion".pg_last_error()); ?>
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="css/nav-vertical.css">
    <style media="screen">
    thead input {
      width: 100%;
    }
    </style>
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

    <div class="content-container">

      <div class="container-fluid">

        <!-- Main component for a primary marketing message or call to action -->
        <div class="container ">

          <center><h2>Personal</h2></center>



          <div class="row justify-content-end">


              <button type="button" class="btn btn-primary btn-lg " data-toggle="modal" data-target="#staticBackdrop">Añadir</button>



          </div>


          <table id="tabla" class="table table-bordered table " style="width:100%">
            <thead class="thead-dark" style="width:100%;">
              <tr>
                <th scope="col">Sucursal</th>
                <th scope="col">CI</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Apellido Materno</th>

                <th scope="col">Turno</th>
                <th scope="col">Puesto</th>
                <th scope="col">Cambio</th>

              </tr>
            </thead>
            <tbody>

              <?php //empieza while Personal
              $sql="SELECT id_personal,ci,ext_ci,nombres,apellido_paterno,apellido_materno, suc_nombre, nombre_turno, nombre_puesto
                    FROM personal a
                            INNER JOIN sucursal b ON a.id_sucursal = b.id_sucursal
                            INNER JOIN puesto c ON a.id_puesto = c.id_puesto
                            INNER JOIN horario_sucursal d ON a.id_horario_sucursal = d.id_horario_sucursal
                                        INNER JOIN horario x ON d.id_horario = x.id_horario INNER JOIN turno z ON x.id_turno = z.id_turno
                    WHERE a.personal_borrado=FALSE;";

              $result = pg_query($conectar, $sql);

             while ($personas = pg_fetch_assoc($result)) {

               echo"         <tr>
                               <td>".$personas['suc_nombre']."</td>
                               <td>".$personas['ci']." ".$personas['ext_ci']."</td>
                               <td>".$personas['nombres']."</td>
                               <td>".$personas['apellido_paterno']."</td>
                               <td>".$personas['apellido_materno']."</td>
                               <td>".$personas['nombre_turno']."</td>
                               <td>".$personas['nombre_puesto']."</td>
                               <td><a href='#' class='badge badge-primary'>Editar</a>
                                   <a href='borrar_personal.php?personal=".$personas['id_personal']."' class='badge badge-danger'>Borrar</a>
                               </td>
                             </tr>";
             }

               ?>



            </tbody>

            <tfoot>
              <tr>
                <th scope="col">CI</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Apellido Materno</th>
                <th scope="col">Sucursal</th>
                <th scope="col">Turno</th>
                <th scope="col">Puesto</th>
                <th scope="col">Cambio</th>
              </tr>
            </tfoot>

          </table>


        </div>

        </div>

      </div>
    </div>


    <!-- modal añadir persona -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Datos de Persona</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

<?php echo"<form action='crea_personal.php' method='post' enctype='multipart/form-data'>"; ?>


        <div class="modal-body">


            <div class="form-row">

              <div class="col-6">

                <div class="form-group">

                  <label for="message-text" class="col-form-label">Nombre:</label>

                  <div class="md-form justify-content">
                    <input type="text" name="nombrePersona" class="form-control" id="nombre" required>
                  </div>

                </div>

                <div class="form-group">

                  <label for="message-text" class="col-form-label">Apellido Paterno:</label>

                  <div class="md-form justify-content">
                    <input type="text" name="apellidoPaterno" class="form-control" id="apellidoPaterno" required>
                  </div>

                </div>

                <div class="form-group">

                  <label for="message-text" class="col-form-label">Apellido Materno:</label>

                  <div class="md-form justify-content">
                    <input type="text" name="apellidoMaterno" class="form-control" id="apellidoMaterno" required>
                  </div>

                </div>

                <div class="form-group">
                  <label for="recipient-name" class="col-form-label" >Sucursal:</label>
                  <select class="custom-select" name="sucursalElegida" id="sucursalID" onchange="changeFunc();">
                    <option selected></option>
                    <?php
                    if(!$conectar){
                      echo "No se pudo conectar con el servidor";
                    }else {
                      // code..

                    $sql="SELECT id_sucursal, suc_nombre FROM sucursal WHERE id_empresa=1 AND sucursal_borrado=FALSE;";

                    $result = pg_query($conectar, $sql);

                   while ($SelSucursal = pg_fetch_assoc($result)) {

                     echo"<option value='$SelSucursal[id_sucursal]'>".$SelSucursal['suc_nombre']."</option>";
                   }
                 }

                     ?>


                  </select>
                </div>
<!--SELECIONAR SUCURSAL FIN-->
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label" >Turno:</label>
                  <select class="js-example-basic-multiple" name="sucursal_horarioElegida[]" multiple="multiple" style="width: 100%" required>
                    
                    <?php
                    if(!$conectar){
                      echo "No se pudo conectar con el servidor";
                    }else {
                      // code..

                      $sql="SELECT id_horario_sucursal,nombre_turno, ingreso_1, salida_1, minutos_gracia
                            FROM horario_sucursal a
                                INNER JOIN horario b ON a.id_horario = b.id_horario INNER JOIN turno z ON b.id_turno = z.id_turno
                                INNER JOIN sucursal d ON a.id_sucursal= d.id_sucursal
                            WHERE a.id_sucursal='$_COOKIE[sucursal]' AND b.borrado=FALSE;";

                      $result = pg_query($conectar, $sql);

                   while ($selHorario = pg_fetch_assoc($result)) {

                     $horas=$selHorario['nombre_turno']." ".$selHorario['ingreso_1']." a ".$selHorario['salida_1'];

                     echo"<option value='$selHorario[id_horario_sucursal]'>".$horas."</option>";
                   }
                 }
                     ?>


                  </select>
                </div>




              </div>

              <div class="col-6">

                <div class="form-group">

                  <label for="message-text" class="col-form-label">Mail:</label>

                  <div class="md-form justify-content">
                    <input type="email" name="sucursalMail" class="form-control" id="exampleFormControlInput1" placeholder="nombre@ejemplo.com" required>
                  </div>

                </div>

                <div class="form-group">
                  <label for="message-text" class="col-form-label">CI:</label>
                  <div class="md-form justify-content">
                    <input type="text" name="CI" class="form-control" id="recipient-name" required>
                  </div>
                </div>


                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="EXT" value="si" id="defaultCheck1" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                  <label class="form-check-label" for="defaultCheck1">
                    Extension
                  </label>
                </div>

                <div class="collapse" id="collapseExample">

                  <input type="text" name="extensionCI" class="form-control" id="recipient-name">

                </div>
                <!--fin extension-->

                <div class="form-group">
                  <label for="recipient-name" class="col-form-label" >Puesto:</label>
                  <select class="custom-select" name="puestoElegido" id="inputGroupSelect02" required>
                    <option selected></option>
                    <?php
                    if(!$conectar){
                      echo "No se pudo conectar con el servidor";
                    }else {
                      // code..

                    $sql="SELECT id_puesto,nombre_puesto FROM puesto;";

                    $result = pg_query($conectar, $sql);

                   while ($puesto = pg_fetch_assoc($result)) {

                     echo"<option value='$puesto[id_puesto]'>".$puesto['nombre_puesto']."</option>";
                   }
                 }

                     ?>


                  </select>
                </div>
                <!--PUESTOS PREDEFINIDOS-->

                <div class="form-group">
                  <label for="message-text" class="col-form-label">Telefono:</label>
                  <div class="md-form justify-content">
                    <input type="text" name="personaTelefono" class="form-control" id="recipient-name" required>
                  </div>
                </div>
                <!--POSIBLE HORARIO-->

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



    <!-- Optional JavaScript -->


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


    <script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    </script>

    <script>


    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
        }
        var numero = getUrlVars()["sucursal"];

        //alert(numero);
        if(parseInt(numero)){
          document.getElementById("nombre").value = getUrlVars()["nombre"];
          document.getElementById("apellidoPaterno").value = getUrlVars()["paterno"];
          document.getElementById("apellidoMaterno").value = getUrlVars()["materno"];

          $("#staticBackdrop").modal("show");
          document.getElementById("sucursalID").value=getUrlVars()["sucursal"];

        }

        function changeFunc() {
          // get references to select list and display text box
          var e = document.getElementById("sucursalID");

          var nombre = document.getElementById("nombre").value;
          var apMa = document.getElementById("apellidoMaterno").value;
          var apPa = document.getElementById("apellidoPaterno").value;
          var strUser = e.options[e.selectedIndex].value;

          document.cookie = "sucursal="+strUser+"";
          window.location.assign("personal.php?empresa=1&sucursal="+strUser+"&paterno="+apPa+"&materno="+apMa+"&nombre="+nombre);


        }
          // assign onclick handlers to the buttons


    </script>


    <script >

    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#tabla thead tr').clone(true).appendTo( '#tabla thead' );
        $('#tabla thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );

            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );

        var table = $('#tabla').DataTable( {
            orderCellsTop: true,
            fixedHeader: true
        } );
    } );


    </script>
  </body>
  <?php pg_close($conectar); ?>
</html>
