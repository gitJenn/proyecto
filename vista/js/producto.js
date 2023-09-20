
var tabla;
function init(){

	listar();
    $.post("../ajax/producto.php?opc=selecate", function(r){
        $("#catesele").html(r);
        $("#catesele").selectpicker('refresh');
    });
	
    $.post("../ajax/producto.php?opc=seleprove", function(r){
        $("#provsele").html(r);
        $("#provsele").selectpicker('refresh');
    });

}
function activar(id){


	Swal.fire({
		title: '¿Esta seguro de activar el registro?',
		text: "No se podrá revertir el estado",
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Sí, activar!'
	  }).then((result) => {
		if (result.isConfirmed) {
		  Swal.fire(
			'',
			'El registro fue activado',
			'success'
		  )

		  $.post("../ajax/producto.php?opc=activar", {id : id}, function(e){
		//	alert(e);
			tabla.ajax.reload();
		});	

		}
	  })
	
}
function anular(id){

	Swal.fire({
		title: '¿Esta seguro de anular?',
		text: "No se podra revertir el estado",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Sí, anular!'
	  }).then((result) => {
		if (result.isConfirmed) {
		  Swal.fire(
			'Deleted!',
			'El producto fue anulado',
			'success'
		  )

		  $.post("../ajax/producto.php?opc=anular", {id : id}, function(e){
		//	alert(e);
			tabla.ajax.reload();
		});	

		}
	  })

	
}

function verReporte(){
	//alert("Correcto");
    window.open('../reportes/rptcategorias.php', '_blank');	
}





function mostrar(id){
	$("#exampleModalProd").modal('hide');

$.post("../ajax/producto.php?opc=mostrar",{id : id}, function(data, status)
	{
		data = JSON.parse(data);		
		
		//alert(data.categoria);

		$("#codigo").val(data.codigo);
		$("#descripcion").val(data.descripcion);
 		$("#cantidad").val(data.cantidad);
		$("#precio").val(data.precio);
		$("#impuesto_id").val(data.impuesto_id);
		$("#catesele").val(data.producto_categoria_id);
		$("#provsele").val(data.proveedor_id);
 		$("#id").val(data.id);
 	//	$("#estante").val(data.estante);

	document.getElementById("codigo").setAttribute("disabled", "disabled");

 	})
}
function limpiar(){

		$("#nombre").val("");
		$("#descripcion").val("");
 		$("#idcategoria").val("");
 		$("#estante").val("");

}
function guardarRegistro(){
	
	
	//e.preventDefault(); //No se activará la acción predeterminada del evento	
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/producto.php?opc=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	         alert(datos);	          	          
	          tabla.ajax.reload();
	    }

	});

	limpiar();
	listar();
	$("#exampleModalProd").modal('hide');
}

/*tbllistado*/
function listar(){

	tabla=$('#tblprod').dataTable(
    {
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		       'copyHtml5','excelHtml5','csvHtml5','pdf'
		        ],
		"ajax":
				{
					url: '../ajax/producto.php?opc=listar',
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