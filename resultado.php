<?php

// Función para evitar inyecciones
function Filtro($texto) {
  return htmlspecialchars(trim($texto), ENT_QUOTES | ENT_HTML5);
}

function Sexo($texto) {
    switch ($texto) {
        case 'm':
            $sexo = 'Masculino';
            break;
        case 'f':
            $sexo = 'Femenino';
            break;
    }
    return $sexo;
} 

function ValidarRut($numero) {
    return is_int($numero);
}

// Variables
$enviado = isset($_POST['enviado']) ? (int) $_POST['enviado'] : 0;
$rut = isset($_POST['rut']) ? Filtro($_POST['rut']) : '';
$nombre = isset($_POST['nombre']) ? Filtro($_POST['nombre']) : '';
$correo = isset($_POST['correo']) ? Filtro($_POST['correo']) : '';
$sexo = isset($_POST['sexo']) ? Filtro($_POST['sexo']) : '';
$direccion = isset($_POST['direccion']) ? Filtro($_POST['direccion']) : '';
$responsable = isset($_POST['responsable']) ? (int) $_POST['responsable'] : 0;
$ordenada = isset($_POST['ordenada']) ? (int) $_POST['ordenada'] : 0;
$respetuosa = isset($_POST['respetuosa']) ? (int) $_POST['respetuosa'] : 0;
$obediente = isset($_POST['obediente']) ? (int) $_POST['obediente'] : 0;
$tolerante = isset($_POST['tolerante']) ? (int) $_POST['tolerante'] : 0;
$acalde = isset($_POST['acalde']) ? Filtro($_POST['acalde']) : '';
$razon_alcalde = isset($_POST['razon_alcalde']) ? Filtro($_POST['razon_alcalde']) : '';
$consejal = isset($_POST['consejal']) ? Filtro($_POST['consejal']) : '';
$razon_consejal = isset($_POST['razon_consejal']) ? Filtro($_POST['razon_consejal']) : '';
$error = '';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Encuesta candidatos Valparaiso">
  <meta name="keywords" content="html, bootstrap, php, formulario, desarrollo, web">
  <meta name="author" content="Alfonso Javier Prado Sepúlveda">
  <title>Formulario enviado</title>
  <!-- CSS -->
  <!-- Bootstrap Core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- MetisMenu CSS -->
  <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="dist/css/sb-admin-2.css" rel="stylesheet">

  <!-- Morris Charts CSS -->
  <link href="vendor/morrisjs/morris.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
  <span style="padding-top: 10px;"></span>
<?php
// Mostrar contenido
    
if($enviado == 0) {
?>
<div class="alert alert-info">
  <i class="glyphicon glyphicon-info-sign"></i>
  <?php echo "No tiene permiso para abrir resultados." ?>
</div>
<a href="./" class="btn btn-warning">
  <i class="glyphicon glyphicon-chevron-left"></i>
  Volver
</a>
<?php 
} else {
    if (empty($rut)) {
        $error = $error . 'Por favor, ingrese su rut. <br />';
    } 
    if(empty($nombre)) {
        $error = $error . 'Por favor, ingrese su nombre. <br />';
    } 
    if(empty($correo)) {
        $error = $error . 'Por favor, ingrese su correo electrónico. <br />';
    } 
    if(empty($sexo)) {
        $error = $error . 'Por favor, ingrese su sexo. <br />';
    } 
    if(empty($direccion)) {
        $error =  $error . 'Por favor, ingrese su direccion. <br />';
    } 
    if(empty($acalde)) {
        $error = $error . 'Por favor, seleccione un alcalde. <br />';
    } 
    if(empty($razon_alcalde)) {
        $error = $error . 'Por favor, escriba la razón porque seleccionó al consejal. <br />';
    }
    if(empty($consejal)) {
        $error = $error . 'Por favor, seleccione un consejal. <br />';
    } 
    if(empty($razon_consejal)) {
        $error = $error . 'Por favor, escriba la razón porque seleccionó al consejal. <br />';
    } 

    // Vista de error
    if(!empty($error)) {
    ?>
    <div class="alert alert-info">
      <i class="glyphicon glyphicon-info-sign"></i><br />
      <?php echo $error; ?>
    </div>
    <a href="./" class="btn btn-warning">
      <i class="glyphicon glyphicon-chevron-left"></i>
      Volver
    </a>
    <?php
    }
    else {
    ?>
    <h3>¡Formulario enviado satisfactoriamente!</h3>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Datos enviados</h3>
    </div>
    <div class="panel-body">
      <p>Bienvenido(a) <b><?php echo $nombre; ?></b>,</p>
      <p>Tu rut es <b><?php echo $rut; ?></b></p>
      <p>Tu sexo es: <b><?php echo Sexo($sexo); ?></b></p>
      <p>Tu correo electrónico es <b><?php echo $correo; ?></b></p>
      <p>Tu dirección es <b><?php echo $direccion; ?></b></p>
      <p>Tu te consideras una persona: <br />
      <?php echo ($responsable == 1 ? 'Responsable <br />' : '');       echo ($ordenada == 1 ? 'Ordenada <br />' : '');
            echo ($respetuosa == 1 ? 'Respetuosa <br />' : '');
            echo ($obediente == 1 ? 'Obediente <br />' : '');
            echo ($tolerante == 1 ? 'Tolerante <br />' : '');
      ?> 
      </p>
      <p>Votaste para alcalde por el candidado <b><?php echo $acalde; ?></b> y la razón fue:</p>
      <blockquote><?php echo $razon_alcalde; ?></blockquote>
      <p>Votaste para consejal por el candidado <b><?php echo $consejal; ?></b> y la razón fue:</p>
      <blockquote><?php echo $razon_consejal; ?></blockquote>
    </div>
    <div class="panel-footer">
      <div class="text-right">
        <a href="./" class="btn btn-primary">
          <i class="glyphicon glyphicon-chevron-left"></i>
          Volver
        </a>
      </div>
    </div>
  </div>
    <?php
    }
}
?>
  <!-- Pie de página -->
  <footer>
    <div class="text-center">
      <i class="glyphicon glyphicon-leaf"></i>
      Desarrollado por Alfonso Prado
    </div>
  </footer>
</div>
   
<!-- jQuery -->
<script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="vendor/raphael/raphael.min.js"></script>
<script src="vendor/morrisjs/morris.min.js"></script>
<script src="data/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>
</body>
</html>