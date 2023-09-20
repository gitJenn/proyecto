<?php
if (strlen(session_id()) < 1) 
session_start();

						
if (!isset($_SESSION["nousuario"]))
{
  header('Location: login.php');

  
}else

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
  <h5>Nueva Categoría</h5>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Agregar Categoria <i class="fa fa-address-book" aria-hidden="true"></i> </button>
    </div>
</div>

</div>

<div class="col-lg-12">
<div class="card card-secondary card-outline">
        <div class="card-body">
          <h1>Listado de Categorias</h1>
                <table id="tbllistado" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Opciones</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
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
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                  </tr>
                </tfooter>
                          
</table>

  </div>
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
        <h5 class="modal-title">Registro de categorias</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
    <form id="formulario" name="formulario">

    <div class="row">
        <div class="col-md-6">
        
        <input type="hidden" name="idcategoria" id="idcategoria" class="form-control" value="">
        
            <label>Categoria:</label>
            
                <input type="text" name="categoria" id="categoria" class="form-control" value="" required="required" pattern="" title="">
            
        </div>
        <div class="col-md-6"> 
        <label>Descripcion:</label>
            
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="" required="required" pattern="" title="">
        
    </div>
    </div>    

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-door-closed"></i> Cancelar</button>
        <button type="button" onclick="guardarRegistro();" class="btn btn-primary"> <i class="fas fa-save"></i> Registrar </button>
      </div>
</form>
</div>
    </div>
  </div>
</div>



<?php
 require 'footer.php';

?>
<script type="text/javascript" src="js/categoria.js"></script>
