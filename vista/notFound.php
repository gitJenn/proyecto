<?php
 require 'head.php';

?>


<div class="content-wrapper" style="min-height: 2838.44px;">

<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1>404 Error Page</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Inicio</a></li>
<li class="breadcrumb-item active">404 Error Page</li>
</ol>
</div>
</div>
</div>
</section>

<section class="content">
<div class="error-page">
<h2 class="headline text-warning"> 404</h2>
<div class="error-content">
<h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Página no encontrada.</h3>
<p>
No pudimos encontrar la página a la que intentabas acceder.
Mientras tanto, podrias <a href="resumen.php">regresar a inicio</a> o buscar una página especícfica.
</p>
<form class="search-form">
<div class="input-group">
<input type="text" name="search" class="form-control" placeholder="Search">
<div class="input-group-append">
<button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
</button>
</div>
</div>

</form>
</div>

</div>

</section>

</div>

<?php
 require 'footer.php';

?>
