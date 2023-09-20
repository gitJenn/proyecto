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
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Nueva Venta</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="formulario">
                  
                  <div class="card-body">
                    <div class="row">
                    <div class="form-group col-md-9">
                      <label for="cliente">Cliente: </label>
                      <input type="text" class="form-control" id="cliente" placeholder="Nombre del cliente">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="comprobante">Comprobante:</label>
                      <select class="form-control select2" style="width: 100%;" id="comprobante">
                        <option selected="selected" value="Factura">Factura</option>
                        <option value="Boleta">Boleta</option>
                      </select>
                    </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-4">
                      <label for="serio">Serie: </label>
                      <input type="text" class="form-control" id="serie" placeholder="No. Serie">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="serio">Aplicar Descuento: </label>
                      <input type="number" class="form-control" id="descuentoAplicar" placeholder="0" value="5">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="impuestoAplicar">Aplicar Impuesto: </label>
                      <input type="number" class="form-control" id="impuestoAplicar" placeholder="15" value="15">
                    </div>
                    </div>

                    <div class="row">
                    <div class="form-group col-md-4">
                      <label for="tipo_pago">Tipo de Pago: </label>
                      <select class="form-control select2" style="width: 100%;" id="tipo_pago">
                        <option selected="selected" value="Efectivo">Efectivo</option>
                        <option value="Tarjeta">Tarjeta</option>
                        <option value="Cheque">Cheque</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Deposito">Depósito</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="fecha">Fecha: </label>
                      <input type="date" class="form-control" id="fecha" readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="hora">Hora: </label>
                      <input type="time" class="form-control" id="hora" readonly>
                    </div>
                    
                    </div>

                    
                  </div>
                  </form>
                  <!-- /.card-body -->
                  <div class="card-footer">
                  
                
                <h3>Esta Venta</h3>
                <table id="tblventa" class="table table-striped dt-responsive">
                  <thead class="bg-primary">
                  <tr>
                    <th>Opción</th>
                    <th>Artículo</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                  <tr style="background-color: #f2f2f2;">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Subtotal: </td>
                    <td id="subtotal"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Descuento: </td>
                    <td id="descuento"></td>
                  </tr>
                  <tr style="background-color: #f2f2f2;">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Impuesto: </td>
                    <td id="impuesto"></td>
                  </tr>
                  <tr class="bg-secondary">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><h5><b>Total a Pagar: </b></h5></td>
                    <td id="total" style = "font-size: 18px;"></td>
                  </tr>
                </tfoot>
                    
                </table>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="guardarFactura();">Realizar Venta <i class="fa fa-address-book" aria-hidden="true"></i> </button>   
                <button type="button" class="btn btn-danger" onclick="limpiar();">Cancelar <i class="fa fa-trash" aria-hidden="true"></i> </button>
              </div>
              <!-- /.card -->
</div>
</div>





<div class="col-md-6">
        <div class="card card-secondary">
  <div class="card-header">

    <h3 class="card-title">Listado de Productos Disponibles</h3>
        </div>
        <div class="card-body">

      
                <table id="tbllistado" class="table table-bordered table-striped dt-responsive table-responsive">
                  <thead>
                  <tr>
                    <th>Opciones</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Stock</th>
                   
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
                    <th>Stock</th>
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
   
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });
</script>

<script>
  $(function () {
    $("#tblventa").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    });
   
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });
</script>

<script>
// Obtener la fecha y hora actuales
var fechaActual = new Date();
var horaActual = fechaActual.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

// Establecer los valores en los campos
document.getElementById("fecha").valueAsDate = fechaActual;
document.getElementById("hora").value = horaActual;
</script>

<!-- Large modal -->




<?php
 require 'footer.php';

?>
<script type="text/javascript" src="js/venta.js"></script>

