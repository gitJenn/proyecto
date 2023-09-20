
var tabla;
function init(){

	listar();

	$.post("../ajax/usuario.php?opc=permisos&id=",function(r){
		$("#permisos").html(r);
});


}
function activar(idusuario){


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

		  $.post("../ajax/usuario.php?opc=activar", {idusuario : idusuario}, function(e){
		//	alert(e);
			tabla.ajax.reload();
		});	

		}
	  })
	
}
function anular(idusuario){

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

		  $.post("../ajax/usuario.php?opc=anular", {idusuario : idusuario}, function(e){
		//	alert(e);
			tabla.ajax.reload();
		});	

		}
	  })

	
}


function updateFileName(input) {
	var label = document.getElementById("imagenLabel");
	var imagen = document.getElementById("imagenmuestra");

	if (input.files.length > 0) {
	  label.textContent = input.files[0].name;
	  imagen.src = URL.createObjectURL(input.files[0]);
	  imagen.style.display = "block";
	  imagen.style.width = "200px";
	  imagen.style.height = "200px";
	  imagen.style.marginRight = "auto";
	  imagen.style.marginLeft = "auto";
	  imagen.className = "profile-user-img img-fluid img-circle";
	
	} else {
	  label.textContent = "Elegir Archivo";
	}
  }


function mostrar(idusuario){
	$("#exampleModal").modal('hide');

$.post("../ajax/usuario.php?opc=mostrar",{idusuario : idusuario}, function(data, status)
	{
		data = JSON.parse(data);		
		
		//alert(data.categoria);

		$("#nombre").val(data.nombre);
		$("#email").val(data.email);
		$("#cargo").val(data.cargo);
		$("#login").val(data.login);
		$("#clave").val(data.clave);
		$("#imagenmuestra").val(data.imagen);
 		$("#idusuario").val(data.idusuario);
 	//	$("#estante").val(data.estante);

 	})
}
function limpiar(){

	var input = document.getElementById("imagen");
	var label = document.getElementById("imagenLabel");
	var imagen = document.getElementById("imagenmuestra");
	
	input.value = "";
	label.textContent = "Elegir Archivo";
	imagen.src = "https://th.bing.com/th/id/R.0945a9d7844fdc9d894a58381e089df6?rik=Kx0dGKSL%2fuZo2Q&riu=http%3a%2f%2fahrarfars.com%2fImages%2ficon-signin.png&ehk=yIs9XL9IxPWLTFirqDaUlfY15xOaS3bG5hhNVAy7IRE%3d&risl=&pid=ImgRaw&r=0";
	imagen.className = "";

}
function guardarRegistro(){
	
	//e.preventDefault(); //No se activará la acción predeterminada del evento	
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/usuario.php?opc=guardaryeditar",
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
					url: '../ajax/usuario.php?opc=listar',
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