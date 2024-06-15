<main class="contenedor seccion contenido-centrado">
    <h1><?= $entrada->titulo ?></h1>


    <img loading="lazy" src="imagenes/entradas/<?= $entrada->imagen ?>" alt="imagen de la propiedad" width="500" height="300" />

    <p class="informacion-meta">Escrito el: <span><?= $entrada->fecha ?></span></p>

    <div class="resumen-propiedad">
        <p><?= $entrada->informacion ?></p>
    </div>
</main>