<?php
    use App\Propiedad;

    
    if ($_SERVER['SCRIPT_NAME'] === '/anuncios.php') {
        $propiedades = Propiedad::all('DESC');
    }else{
        $propiedades = Propiedad::get(3, 'DESC');
    }

?>

<div class="contenedor-anuncios">
    <?php foreach ($propiedades as $propiedad) : ?>
        <div class="anuncio">

            <img loading="lazy" src="imagenes/propiedades/<?= $propiedad->imagen; ?>" alt="Imagen" width="500" height="300">

            <div class="contenido-anuncio">
                <h3 title="<?= $propiedad->titulo; ?>"><?= $propiedad->titulo; ?></h3>
                <p><?= $propiedad->descripcion; ?></p>
                <p class="precio">$<?= $propiedad->precio; ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                        <p><?= $propiedad->wc; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                        <p><?= $propiedad->estacionamiento; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                        <p><?= $propiedad->habitaciones; ?></p>
                    </li>
                </ul>
                <a href="anuncio.php?id=<?= $propiedad->id; ?>" class="boton-amarillo-block">Ver Propiedad</a>
            </div> <!--  .contenido-anuncio -->
        </div> <!-- .anuncio -->
    <?php endforeach; ?>
</div> <!-- .conetenedor-anuncios -->
