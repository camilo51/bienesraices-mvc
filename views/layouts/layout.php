<?php
if (!isset($_SESSION)) {
  session_start();
}

$auth = $_SESSION['login'] ?? null;

if (!isset($inicio)) {
  $inicio = false;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bienes Raices</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../../build/css/app.css" />
</head>

<body>


  <header class="header <?= $inicio ? 'inicio' : '' ?>">
    <div class="contenedor contenido-header">
      <div class="barra">
        <div class="barra-responsive">
          <a href="/">
            <img src="/build/img/logo.svg" alt="Logo de Bienes Raices" />
          </a>
          <div class="mobile-menu">
            <img src="/build/img/barras.svg" alt="Icono menu resposive">
          </div>
        </div>

        <div class="derecha">
          <div class="derecha-contenido">
            <div class="derecha-dark-mode">
              <img src="/build/img/dark-mode.svg" alt="dark mode" class="dark-mode-boton">
            </div>
            <?php include __DIR__ . '/navegacion.php' ?>
          </div>
        </div>
      </div>
      <!-- .barra -->
      <?php if ($inicio) { ?>
        <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
      <?php } ?>
    </div>
  </header>

  <?= $contenido ?>

  <footer class="footer seccion">
    <div class="contenedor contenedor-footer">
      <?php include __DIR__ . '/navegacion.php' ?>
    </div>
    <p class="copyright">Todos los derechos Reservados <?= date('Y') ?> &copy;</p>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="../../build/js/bundle.min.js"></script>
</body>

</html>