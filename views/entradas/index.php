<main class="contenedor seccion">

    <h1>Entradas</h1>


    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entradas as $entrada) : ?>
                <tr>
                    <td><?= $entrada->id ?></td>
                    <td><?= $entrada->titulo ?></td>
                    <td><img src="/imagenes/entradas/<?= $entrada->imagen ?>" class="imagen-tabla" alt="<?= $entrada->titulo ?>"></td>
                    <td>
                        <form method="POST" class="w-100" action="/admin/entradas/eliminar">
                            <input type="hidden" name="id" value="<?= $entrada->id ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/admin/entradas/actualizar?id=<?= $entrada->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $links ?>
</main>