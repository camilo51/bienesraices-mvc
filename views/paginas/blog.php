<main class="contenedor seccion contenido-centrado">
    <h1>Nuestro Blog</h1>

    <?php foreach ($entradas as $entrada) : ?>
        <article class="entrada-blog">
            <div class="imagen">
                <img loading="lazy" src="imagenes/entradas/<?= $entrada->imagen ?>" alt="Texto de entrada blog" width="500" height="300" />
            </div>
            <div class="texto-entrada">
                <a href="/entrada?id=<?= $entrada->id ?>">
                    <h4><?= $entrada->titulo ?></h4>
                    <p class="informacion-meta">Escrito el <span><?= $entrada->fecha ?></span></p>

                    <p>
                        <?= $entrada->informacion ?>
                    </p>
                </a>
            </div>
        </article>
    <?php endforeach ?>

</main>