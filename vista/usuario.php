<?php
 require 'head.php';

?>

<div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <br>
              </div>
            </div>
            <div class="row">
            <div class="col-lg-12">
            <div class="card card-primary card-outline">

  <div class="card-body">
  <h5>Nuevo Usuario</h5>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Registro de usuario <i class="fa fa-user" aria-hidden="true"></i> </button>
  </div>
</div>
  </div>



  <div class="col-lg-12">

  <div class="card card-secondary card-outline">
    
        <div class="card-body">

                <h1>Listado de Usuarios</h1>
                <table id="tbllistado" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr>
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Login</th>
                    <th>Cargo</th>
                    <th>Email</th>
                    <th>Foto</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                  <tbody>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                  </tr>
</tbody>
<tfooter>
                  <tr>
                  <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Login</th>
                    <th>Cargo</th>
                    <th>Email</th>
                    <th>Foto</th>
                    <th>Estado</th>
                  </tr>
                </tfooter>
                          
</table>

  </div>
  </div>
  </div>
  </div>
</div>
</section>
</div>

<script>
  $(function () {
    $("#tbllistado").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tbllistado_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<!-- Large modal -->

<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
        <h5 class="modal-title">Registro de usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
    <form id="formulario" name="formulario">

    <div class="row">
        <div class="col-md-6">
        
        <input type="hidden" name="idusuario" id="idusuario" class="form-control" value="">
        
            <label>Nombre:</label>
            
                <input type="text" name="nombre" id="nombre" class="form-control" value="" required="required" pattern="" title="">
            
        </div>
        <div class="col-md-6"> 
        <label>Login:</label>
            
            <input type="text" name="login" id="login" class="form-control" value="" required="required" pattern="" title="">
        
    </div>
    </div>    
    <div class="row">
        <div class="col-md-6">
            <label>Correo:</label>
            
                <input type="text" name="email" id="email" class="form-control" value="" required="required" pattern="" title="">
            
        </div>
        <div class="col-md-3"> 
        <label>Cargo:</label>
            
        <select name="cargo" id="cargo" class="form-control selectpicker" required="">
          <option value="Seleccionar" select >Seleccionar</option>
            <option value="Gerente">Gerente</option>
            <option value="Supervisor">Supervisor de Almacén</option>
              <option value="Cajero">Cajero</option>   
          </select> 


    </div>

    <div class="col-md-3"> 
        <label>Clave:</label>
            
            <input type="password" name="clave" id="clave" class="form-control" value="" required="required" pattern="" title="">
        
    </div>

    </div>    



    <div class="row">
    


    <div class="col-md-6">
<div class="form-group">
                      <label for="exampleInputFile">Imagen: </label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="imagen" name="imagen" onchange="updateFileName(this);">
                          <label class="custom-file-label" for="imagen" id="imagenLabel">Elegir Archivo</label>
                        </div>
                  
                      </div>
                    </div>
  
    <input type="hidden" name="imagenactual" id="imagenactual">
 
    <img src="https://th.bing.com/th/id/R.0945a9d7844fdc9d894a58381e089df6?rik=Kx0dGKSL%2fuZo2Q&riu=http%3a%2f%2fahrarfars.com%2fImages%2ficon-signin.png&ehk=yIs9XL9IxPWLTFirqDaUlfY15xOaS3bG5hhNVAy7IRE%3d&risl=&pid=ImgRaw&r=0" 
   width="200px" height="200px" style="display: block; margin-left: auto; margin-right: auto" id="imagenmuestra">

</div>






    <div class="form-group col-lg-6">
      <label>Permisos:</label>

      <ul style="list-style: none;" id="permisos">
                              
      </ul>
    </div>




    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar <i class="fas fa-ban"></i></button>
        <input type="reset" value="Limpiar" class="btn btn-danger" onclick="limpiar();">
        <button type="button" onclick="guardarRegistro();" class="btn btn-primary"> <i class="fas fa-save"></i> Registrar</button>
      </div>
</form>
</div>
    </div>
  </div>
</div>
</div>



<?php
 require 'footer.php';

?>


<script type="text/javascript" src="js/usuario.js"></script>


