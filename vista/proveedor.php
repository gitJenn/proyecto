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
        <h5>Nuevo Proveedor</h5>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Agregar Proveedor <i class="fa fa-address-book" aria-hidden="true"></i> </button>
        </div>
        </div>
        </div>


        <div class="col-lg-12">
        <div class="card card-secondary card-outline">
        <div class="card-body">
          <h1>Listado de Proveedores</h1>
                <table id="tblprov" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Opciones</th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Ciudad</th>
                    <th>Contacto</th>
                    <th>Nota</th>
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
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Ciudad</th>
                    <th>Contacto</th>
                    <th>Nota</th>
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
    $("#tblprov").DataTable({
      "responsive": true, "scrollX": false, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tblprov_wrapper .col-md-6:eq(0)');
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

<div class="modal fade bd-example-modal-lg" id="exampleModalprov" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
        <h5 class="modal-title">Registro de proveedores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
    <form id="formprov" name="formprov">

    

  <div class="row">
        <div class="col-12">

        <input type="hidden" name="idprov" id="idprov" class="form-control" value="">

          <label>No. Identidad: </label>
          <input type="text" name="idproveedor" id="idproveedor" class="form-control" value="" required="required" pattern="" title="">
        </div>
  </div>


    <div class="row">
        <div class="col-md-6">
            <label>Nombre:</label>
            
                <input type="text" name="nombre" id="nombre" class="form-control" value="" required="required" pattern="" title="">
            
        </div>
        <div class="col-md-6"> 
        <label>Dirección:</label>
            
            <input type="text" name="direccion" id="direccion" class="form-control" value="" required="required" pattern="" title="">
        
    </div>

    </div>    

    <div class="row">
  
        <div class="col-12"> 
        <label>Teléfono:</label>
            
            <input type="text" name="telefono" id="telefono" class="form-control" value="" required="required" pattern="" title="">
        
    </div>

    </div>    



    <div class="row">
        <div class="col-md-6">
        
            <label>Ciudad:</label>
            
                <input type="text" name="Ciudad" id="Ciudad" class="form-control" value="" required="required" pattern="" title="">
            
        </div>
        <div class="col-md-6"> 
        <label>Contacto:</label>
            
            <input type="text" name="contacto" id="contacto" class="form-control" value="" required="required" pattern="" title="">
        
    </div>

    </div> 


    <div class="row">
        <div class="col-md-8">
        
            <label>Nota:</label>
            
                <input type="text" name="nota" id="nota" class="form-control" value="" pattern="" title="">
            
        </div>
        
        <div class="col-md-4"> 
        <label>E-mail:</label>  
            <input type="text" name="email_contacto" id="email_contacto" class="form-control" value="" required="required" pattern="" title="">
        
    </div>
  

    </div> 


    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-door-closed"></i> Cancelar</button>
        <button type="button" onclick="limpiar();" class="btn btn-danger"> <i class="fas fa-eraser"></i> Limpiar</button>
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
<script type="text/javascript" src="js/proveedor.js"></script>
