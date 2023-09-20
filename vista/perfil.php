<?php
 require 'head.php';
 
 if (strlen(session_id()) < 1) 
   session_start();
 
?>

<div class="content-wrapper" style="min-height: 2646.44px;">

<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1>Usuario Actual</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Inicio</a></li>
<li class="breadcrumb-item active">Perfil de Usuario</li>
</ol>
</div>
</div>
</div>
</section>

<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-6">

<div class="card card-primary card-outline">
<div class="card-body box-profile">
<div class="text-center">
<a href="../files/usuarios/<?php echo $_SESSION["imagen"]; ?>"><img class="profile-user-img img-fluid img-circle" src="../files/usuarios/<?php echo $_SESSION["imagen"]; ?>" alt="User profile picture"></a>
</div>
<h3 class="profile-username text-center"><?php echo $_SESSION["nousuario"]; ?></h3>
<p class="text-muted text-center"><?php echo $_SESSION["cargousuario"]; ?></p>
<ul class="list-group list-group-unbordered mb-3">
<li class="list-group-item">
<b>Años Laborando</b> <a class="float-right">4</a>
</li>
<li class="list-group-item">
<b>Salario</b> <a class="float-right">20,000 lps.</a>
</li>
<li class="list-group-item">
<b>Correo Electrónico</b> <a class="float-right"><?php echo $_SESSION["emailusuario"]; ?></a>
</li>
</ul>
<a href="https://mail.google.com/mail/u/0/?hl=es#inbox?compose=new" class="btn btn-primary btn-block" target="_blank"><b>Contactar</b></a>
</div>

</div>

</div>
    <div class="col-md-6">
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Acerca de <?php echo $_SESSION["nousuario"]; ?></h3>
</div>

<div class="card-body">
<strong><i class="fas fa-book mr-1"></i> Educación</strong>
<p class="text-muted">
Licenciatura en Administración de Empresas de la Universidad Nacional Autónoma de Honduras
</p>
<hr>
<strong><i class="fas fa-map-marker-alt mr-1"></i> Ubicación</strong>
<p class="text-muted">La Ceiba, Atlántida, Honduras</p>
<hr>
<strong><i class="fas fa-pencil-alt mr-1"></i> Habilidades</strong>
<p class="text-muted">
<span class="tag tag-danger">Gestión de inventario</span>
<span class="tag tag-success">Atención al cliente</span>
<span class="tag tag-info">Liderazgo</span>
<span class="tag tag-warning">Ventas</span>
<span class="tag tag-primary">Contabilidad</span>
</p>
<hr>
<strong><i class="far fa-file-alt mr-1"></i> Notas</strong>
<p class="text-muted">Me gusta trabajar con mi equipo y satisfacer las necesidades
    de nuestros clientes.</p>
</div>

</div>

</div>

</section>

</div>

<?php
 require 'footer.php';

?>
