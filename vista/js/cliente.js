
var tabla;
function init(){

	listar();

	


}
function activar(idcategoria){


	Swal.fire({
		title: 'Esta seguro de activar el registro?',
		text: "No se podra revertir el estado",
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

		  $.post("../ajax/cliente.php?opc=activar", {idcategoria : idcategoria}, function(e){
		//	alert(e);
			tabla.ajax.reload();
		});	

		}
	  })
	
}
function anular(idcategoria){

	Swal.fire({
		title: 'Esta seguro de anular?',
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
			'El registro fue anulado',
			'success'
		  )

		  $.post("../ajax/cliente.php?opc=anular", {idcategoria : idcategoria}, function(e){
		//	alert(e);
			tabla.ajax.reload();
		});	

		}
	  })

	
}
function mostrar(idcategoria){
	$("#exampleModal").modal('hide');

$.post("../ajax/cliente.php?opc=mostrar",{idcategoria : idcategoria}, function(data, status)
	{
		data = JSON.parse(data);		
		
		//alert(data.categoria);

		$("#categoria").val(data.categoria);
		$("#descripcion").val(data.descripcion);
 		$("#idcategoria").val(data.idcategoria);
 	//	$("#estante").val(data.estante);

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
		url: "../ajax/cliente.php?opc=guardaryeditar",
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
	$("#exampleModal").modal('hide');
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
					url: '../ajax/cliente.php?opc=listar',
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