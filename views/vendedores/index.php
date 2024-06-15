<main class="contenedor seccion">
    <h1>Vendedores</h1>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Télefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td><?= $vendedor->id ?></td>
                    <td><?= $vendedor->nombre . " " . $vendedor->apellido ?></td>
                    <td><img src="/imagenes/vendedores/<?= $vendedor->imagen ?>" class="imagen-tabla" alt="<?= $vendedor->titulo ?>"></td>
                    <td><?= $vendedor->telefono ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/admin/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?= $vendedor->id ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/admin/vendedores/actualizar?id=<?= $vendedor->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $links ?>
</main>
    