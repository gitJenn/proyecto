
function init(){

    $("#login").val("");
    $("#clave").val("");
    
}

function insertarRegistro(nombre, login, cargo, email) {
    $.ajax({
        url: "../ajax/usuario.php?opc=insertarRegistro",
        type: "POST",
        data: {"nombre": nombre, "login": login, "cargo": cargo, "email": email},
        success: function(response)
        {
           
        }
    });
}
function verificar()
{
    var usu=login.value;
    var cla=clave.value;


    $.post("../ajax/usuario.php?opc=verificar",
        {"usu":usu,"clave":cla},
        function(data)
    {
        if (data=="si"){
        $(location).attr("href","resumen.php");
        var nombre = $("#nombre").val();
                      var login = $("#login").val();
                      var cargo = $("#cargo").val();
                      var email = $("#email").val();
                      var imagen = $("#imagen").val();
    
                      // Llamar a la función insertarRegistro con los valores obtenidos
                      insertarRegistro(nombre, login, cargo, email)}
        else{
        alert ("Usuario o contraseña incorrectos");
        }
        
    });

}

init();