<main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php  

            if ($resultado) {
                $mensaje = mostrarNotificacion(intval($resultado)); 

                if ($mensaje) { ?> 
                    <p class="alerta exito"><?= s($mensaje) ?></p>   
               <?php }
            } 
        ?>
        <a href="/propiedades/crear" class="boton-verde">Nueva Propiedad</a>
        <a href="/vendedores/crear" class="boton-amarillo">Nuevo(a) Vendedor</a>

        <h2>Propiedades</h2>


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
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?= $propiedad->id ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="propiedades/actualizar?id=<?= $propiedad->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h2>Vendedores</h2>
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
                        <form method="POST" class="w-100" action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?= $vendedor->id ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/vendedores/actualizar?id=<?= $vendedor->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</main>