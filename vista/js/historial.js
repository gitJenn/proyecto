
var tabla;
function init(){

	listar();

}
function activar(idhistorial){


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

		  $.post("../ajax/historial.php?opc=activar", {idhistorial : idhistorial}, function(e){
		//	alert(e);
			tabla.ajax.reload();
		});	

		}
	  })
	
}
function anular(idhistorial){

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

		  $.post("../ajax/historial.php?opc=anular", {idhistorial : idhistorial}, function(e){
		//	alert(e);
			tabla.ajax.reload();
		});	

		}
	  })

	
}

/*tbllistado*/
function listar(){

	tabla=$('#tblhistorial').dataTable(
    {
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		       'copyHtml5','excelHtml5','csvHtml5','pdf'
		        ],
		"ajax":
				{
					url: '../ajax/historial.php?opc=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
        "paging": false,
		
	    "order": [[ 6, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
	

}


init();