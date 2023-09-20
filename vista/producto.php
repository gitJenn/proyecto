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
  <h5>Opciones de Productos</h5>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"> Agregar producto <i class="fa fa-cart-plus" aria-hidden="true"></i> </button>
        <button type="button" onclick="verReporte();" class="btn btn-primary">Ver reporte <i class="fa fa-print" aria-hidden="true"></i></button>
      </div>
    </div>
  </div>


        <div class="col-lg-12">
          <div class="card card-secondary card-outline">
        <div class="card-body">
        <h1>Listado de Productos</h1>
      
                <table id="tblprod" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr>
                    <th>Opciones</th>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Existencia</th>
                    <th>Venta</th>
                    <th>Impuesto</th>
                    <th>Categoria</th>
                    <th>Proveedor</th>
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
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Existencia</th>
                    <th>Venta</th>
                    <th>Impuesto</th>
                    <th>Categoria</th>
                    <th>Proveedor</th>
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
    $("#tblprod").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tblprod_wrapper .col-md-6:eq(0)');
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

<div class="modal fade bd-example-modal-lg" id="exampleModalProd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
        <h5 class="modal-title">Registro de Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
    <form id="formulario" name="formulario">

    <div class="row">
        <div class="col-md-6">
        
        <input type="hidden" name="id" id="id" class="form-control" value="">
      <label>Codigo:</label></i>        
           
            
          <input type="text" name="codigo" id="codigo" class="form-control" value="" required="required" pattern="" title="">
            
        </div>
        <div class="col-md-6"> 
        <label>Descripcion:</label>
            
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="" required="required" pattern="" title="">
        
    </div>
    </div>  

    <div class="row">
        <div class="col-md-4">
        
        <label>Cantidad:</label></i>        
           
            
        <input type="number" name="cantidad" id="cantidad" class="form-control" value="" required="required" pattern="" title="">
            
        </div>
        <div class="col-md-4">
        
        <label>Precio Unitario (L):</label></i>        
           
            
        <input type="number" name="precio" id="precio" class="form-control" value="" required="required" pattern="" title="">
            
        </div>
        <div class="col-md-4"> 
        <label>Impuesto (0,15,18):</label>
            
            <input type="number" name="impuesto_id" id="impuesto_id" class="form-control" value="" required="required" pattern="" title="">
        
    </div>
    </div>  


    <!--select -->
    <div class="row">
        <div class="col-md-6">
        
<label>Categoria:</label></i>        
           
<select id="catesele" name="catesele" class="form-control select2bs4" style="width: 100%;"  data-live-search="true">     
</select>           
        </div>
        
        <div class="col-md-6"> 
        <label>Proveedor:</label>
        <select id="provsele" name="provsele" class="form-control select2bs4" style="width: 100%;">  
        
        </select>     
            
    </div>
    </div>
    
<!-- final select -->


    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-ban"></i> Cancelar</button>
        <input type="reset" class="btn btn-danger" value="Limpiar">
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
<script type="text/javascript" src="js/producto.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});

</script>
