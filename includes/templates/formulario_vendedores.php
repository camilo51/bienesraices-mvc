<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre</label>
    <input type="text" placeholder="Nombre Vendedor(a)" id="nombre" name="vendedor[nombre]" value="<?= s($vendedor->nombre) ?>" />

    <label for="apellido">Apellido</label>
    <input type="text" placeholder="Apellido  Vendedor(a)" id="precio" name="vendedor[apellido]" value="<?= s($vendedor->apellido) ?>" />

    <label for="imagen">Imagen</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="vendedor[imagen]"/>

    <?php if($vendedor->imagen): ?>
        <img src="/imagenes/vendedores/<?= $vendedor->imagen ?>" class="imagen-small">
    <?php endif; ?>
</fieldset>

<fieldset>
    <legend>Información Extra</legend>
    <label for="telefono">Teléfono</label>
    <input type="tel" placeholder="Teléfono Vendedor(a)" id="telefono" name="vendedor[telefono]" value="<?= s($vendedor->telefono) ?>" />
</fieldset>