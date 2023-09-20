
var tabla;
function init(){

	listar();
    

}


function guardarFactura() {

    var formData = new FormData($("#formulario")[0]);

    restarProductos();
    // Obtener la fecha y hora actual del sistema
    var fechaActual = new Date();
    formData.append("fecha", fechaActual.toLocaleDateString());
    formData.append("hora", fechaActual.toLocaleTimeString());

    // Agregar los valores de los campos del formulario
    var cliente = $("#cliente").val();
    var comprobante = $("#comprobante").val();
    var serie = $("#serie").val();
    var descuentoAplicar = $("#descuentoAplicar").val();
    var impuestoAplicar = $("#impuestoAplicar").val();
    var tipo_pago = $("#tipo_pago").val();

    formData.append("cliente", cliente);
    formData.append("comprobante", comprobante);
    formData.append("serie", serie);
    formData.append("descuentoAplicar", descuentoAplicar);
    formData.append("impuestoAplicar", impuestoAplicar);
    formData.append("tipo_pago", tipo_pago);


    $.ajax({
        url: "../ajax/historial.php?opc=guardar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            alert(datos);
            tabla.ajax.reload();
        }
    });
    //alert("Factura guardada con éxito");
    //limpiar();
    //listar();
    $("#exampleModal").modal('hide');
}



function restarProductos() {
    // Obtener los datos de tblventa para construir ventaData
    var ventaData = [];
    $("#tblventa tbody tr").each(function () {
        var idProducto = $(this).find("td:eq(1)").text();
        var cantidadVendida = $(this).find("td:eq(2)").text();
        
        // Crear un objeto que representa un producto vendido
        var productoVendido = {
            idProducto: idProducto,
            cantidadVendida: cantidadVendida
        };
        
        // Agregar el producto vendido a ventaData
        ventaData.push(productoVendido);
    });

    // Realizar una solicitud AJAX para enviar ventaData al servidor
    $.ajax({
        type: "POST",
        url: "../ajax/venta.php?opc=restar",
        data: { ventaData: JSON.stringify(ventaData) }, // Convertir ventaData a JSON y enviarlo
        success: function (response) {
            // Manejar la respuesta del servidor si es necesario
            console.log(response);
        },
        error: function (xhr, status, error) {
            // Manejar errores de la petición
            console.error('Error en la petición AJAX:', error);
        }
    });
}


function devolverCantidadBaseDeDatos(idProducto, cantidad) {
    // Definir los datos que se enviarán al servidor
    var data = {
        idProducto: idProducto,
        cantidadEliminada: cantidad
    };

    // Realizar la petición AJAX
    $.ajax({
        url: '../ajax/venta.php?opc=devolver', // Cambia la URL a la que corresponda en tu servidor
        type: 'POST',
        data: data,
        dataType: 'json', // Puedes cambiar el tipo de datos según lo que esperas recibir
        success: function (response) {
            // Manejar la respuesta del servidor si es necesario
            if (response.success) {
                console.log('Cantidad devuelta con éxito');
            } else {
                console.error('Error al devolver cantidad en el servidor');
            }
        },
        error: function (xhr, status, error) {
            // Manejar errores de la petición
            console.error('Error en la petición AJAX:', error);
        }
    });
}



function mostrar(idProducto, precio, descripcion, cantidadDisponible) {
    // Obtener la cantidad ingresada por el usuario
    idProducto = parseInt(idProducto);
	
  
        var cantidad = parseInt(prompt("Ingrese la cantidad a vender de " + descripcion + "\n(disponible: " + cantidadDisponible + "): "));
        if (isNaN(cantidad) || cantidad <= 0) {
            alert("Cantidad no válida. Ingrese un número válido mayor que cero.");
            return;
        }
        if (cantidad > cantidadDisponible) {
            alert("No hay suficiente cantidad disponible para " + descripcion);
            return;
        }


	precio = parseFloat(precio);

    $.ajax({
        type: "POST",
        url: "../ajax/venta.php?opc=mostrar",
        data: { idProducto: idProducto, cantidadVendida: cantidad, precio: precio, descripcion: descripcion }, // Actualiza aquí la variable a cantidad
        success: function (data) {
            // Resto del código...
        },
        error: function (xhr, status, error) {
            // Manejo de errores...
        }
    });

	
    // Calcular subtotal, impuesto y total
    var subtotal = precio * cantidad;
	subtotal = subtotal.toFixed(2);
	var impuesto;

	if (document.getElementById("impuestoAplicar").value == "") {
		impuesto = subtotal * 0.15;
	}
	else {
		impuesto = document.getElementById("impuestoAplicar").value;
	}
  
	var descuento = document.getElementById("descuentoAplicar").value;
	// Supongamos que el impuesto es del 15%
    var total = subtotal + impuesto;

    // Agregar el producto a tblventa
    var fila = `
        <tr>
            <td><button onclick="eliminarFila(this);" class="btn btn-danger">Eliminar</button></td>
            <td>${idProducto}</td>
            <td>${cantidad}</td>
            <td>${precio}</td>
            <td>${subtotal}</td>
        </tr>
    `;

    $("#tblventa tbody").append(fila);

    // Actualizar los totales en la fila de totales
    actualizarTotales();

    // Restar la cantidad vendida de la base de datos (debes implementar esta parte)
    restarCantidadBaseDeDatos(idProducto, cantidad);
}





function actualizarTotales() {
    // Calcular los totales y mostrarlos en la fila de totales en tblventa
    var subtotalTotal = 0;
    var impuestoTotal = 0;
    var descuentoTotal = 0;

    $("#tblventa tbody tr").each(function () {
        var cantidad = parseInt($(this).find("td:eq(2)").text());
        var precio = parseFloat($(this).find("td:eq(3)").text());
        var subtotal = cantidad * precio;
        
        // Obtener los valores predeterminados de descuento e impuesto
        var descuentoPredeterminado = parseFloat($("#descuentoAplicar").val()) || 0;
        var impuestoPredeterminado = parseFloat($("#impuestoAplicar").val()) || 0;
        
        var impuesto = subtotal * (impuestoPredeterminado / 100);
        var descuento = subtotal * (descuentoPredeterminado / 100);

        subtotalTotal += subtotal;
        impuestoTotal += impuesto;
        descuentoTotal += descuento;
    });

    var totalTotal = (subtotalTotal + impuestoTotal - descuentoTotal).toFixed(2);

    $("#subtotal").text(subtotalTotal.toFixed(2));
    $("#descuento").text(descuentoTotal.toFixed(2));
    $("#impuesto").text(impuestoTotal.toFixed(2));
    $("#total").text(totalTotal);
}


function eliminarFila(botonEliminar) {
    var fila = $(botonEliminar).closest("tr");
    var cantidad = parseInt(fila.find("td:eq(2)").text());
    var descripcion = fila.find("td:eq(1)").text();
    var confirmacion = confirm("¿Desea eliminar " + cantidad + " unidades de " + descripcion + "?");

    if (confirmacion) {
        // Devolver la cantidad eliminada a la base de datos (debes implementar esta parte)
        //devolverCantidadBaseDeDatos(idProducto, cantidad);

        // Eliminar la fila de la tabla
        fila.remove();

        // Actualizar los totales
        actualizarTotales();
    }
}

function limpiar() {
    // Limpiar el formulario
    document.getElementById("formulario").reset();

    // Limpiar la tabla tblventa
    $("#tblventa tbody").empty();

    // Restablecer los totales
    $("#subtotal").text("0.00");
    $("#descuento").text("0.00");
    $("#impuesto").text("0.00");
    $("#total").text("0.00");

    // Restablecer los campos de descuento e impuesto a sus valores predeterminados
    $("#descuentoAplicar").val("5");
    $("#impuestoAplicar").val("15");

	var fechaActual = new Date();
var horaActual = fechaActual.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

// Establecer los valores en los campos
document.getElementById("fecha").valueAsDate = fechaActual;
document.getElementById("hora").value = horaActual;
}


/*tbllistado*/
function listar(){

	tabla=$('#tbllistado').dataTable(
    {
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		       'copyHtml5','excelHtml5','csvHtml5','pdf'
		        ],
		"ajax":
				{
					url: '../ajax/venta.php?opc=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
        "paging": false,
		
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
	

}


init();