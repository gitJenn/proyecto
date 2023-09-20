
var tabla;
function init(){

	listar();

}
function activar(idprov){


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

		  $.post("../ajax/proveedor.php?opc=activar", {idprov : idprov}, function(e){
		//	alert(e);
			tabla.ajax.reload();
		});	

		}
	  })
	
}
function anular(idprov){

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

		  $.post("../ajax/proveedor.php?opc=anular", {idprov : idprov}, function(e){
		//	alert(e);
			tabla.ajax.reload();
		});	

		}
	  })

	
}
function mostrar(idprov){
	$("#exampleModalprov").modal('hide');

$.post("../ajax/proveedor.php?opc=mostrar",{idprov : idprov}, function(data, status)
	{
		data = JSON.parse(data);		
		
		//alert(data.idprov);

        $("#idproveedor").val(data.idproveedor);
        $("#nombre").val(data.nombre);
        $("#direccion").val(data.direccion);
 		$("#telefono").val(data.telefono);
        $("#Ciudad").val(data.Ciudad);
        $("#contacto").val(data.contacto);
        $("#nota").val(data.nota);
		$("#contacto_tel").val(data.contacto_tel);
        $("#email_contacto").val(data.email_contacto);
		$("#idprov").val(data.idprov);

 	//	$("#estante").val(data.estante);

 	})
}
function limpiar(){

    $("#idproveedor").val("");
    $("#nombre").val("");
    $("#direccion").val("");
     $("#telefono").val("");
    $("#Ciudad").val("");
    $("#contacto").val("");
    $("#nota").val("");
	$("#contacto_tel").val("");
    $("#email_contacto").val("");
	$("#idprov").val("");

}
function guardarRegistro(){
	
	
	//e.preventDefault(); //No se activará la acción predeterminada del evento	
	var formData = new FormData($("#formprov")[0]);
	$.ajax({
		url: "../ajax/proveedor.php?opc=guardaryeditar",
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
	$("#exampleModalprov").modal('hide');
}

/*tbllistado*/
function listar(){

	tabla=$('#tblprov').dataTable(
    {
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		       'copyHtml5','excelHtml5','csvHtml5','pdf'
		        ],
		"ajax":
				{
					url: '../ajax/proveedor.php?opc=listar',
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