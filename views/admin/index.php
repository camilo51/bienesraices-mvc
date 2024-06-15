<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <?php
    $resultado = $_GET['resultado'] ?? null;
    if ($resultado) {
        $mensaje = mostrarNotificacion(intval($resultado));

        if ($mensaje) { ?>
            <p class="alerta exito"><?= s($mensaje) ?></p>
    <?php }
    } ?>
</main>