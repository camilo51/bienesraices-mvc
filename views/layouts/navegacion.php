<nav class="navegacion">
    <a href="/nosotros">Nosotros</a>
    <a href="/propiedades">Propiedades</a>
    <a href="/blog">Blog</a>
    <a href="/contacto">Contacto</a>
    <?php if (!$auth) : ?>
        <a href="/login">Iniciar Sesión</a>
    <?php endif; ?>

    <?php if ($auth) : ?>
        <a href="/admin">Admin</a>
        <a href="/logout">Cerrar Sesión</a>
    <?php endif; ?>
</nav>