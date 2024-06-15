
<main class="contenedor seccion">
    <h1>Propiedades</h1>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td><?= $propiedad->id ?></td>
                    <td><?= $propiedad->titulo ?></td>
                    <td><img src="/imagenes/propiedades/<?= $propiedad->imagen ?>" class="imagen-tabla" alt="<?= $propiedad->titulo ?>"></td>
                    <td>$<?= $propiedad->precio ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/admin/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?= $propiedad->id ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/admin/propiedades/actualizar?id=<?= $propiedad->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $links ?>
</main>