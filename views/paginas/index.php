<main class="contenedor seccion">
    <h1>Más sobre nosotros</h1>
    <?php include 'iconos.php' ?>
</main>

<section class="seccion contenedor">
    <h2>Casas y Depas en Venta</h2>

    <?php include 'listado.php'; ?>

    <div class="alinear-derecha">
        <a href="/propiedades" class="boton-verde">Ver Todas</a>
    </div>
</section>
<section class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
    <a href="/contacto" class="boton-amarillo">Contactanos</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro Blog</h3>
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
    </section>
    <section class="testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonial">
            <blockquote>
                El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
            </blockquote>
            <p>- Cristian Pereira</p>
        </div>
    </section>
</div>