<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Título</label>
    <input type="text" placeholder="Título Propiedad" id="titulo" name="propiedad[titulo]" value="<?= s($propiedad->titulo) ?>" />

    <label for="precio">Precio</label>
    <input type="number" placeholder="Precio Propiedad" id="precio" name="propiedad[precio]" value="<?= s($propiedad->precio) ?>" />

    <label for="imagen">Imagen</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]"/>

    <?php if($propiedad->imagen): ?>
        <img src="/imagenes/propiedades/<?= $propiedad->imagen ?>" class="imagen-small">
    <?php endif; ?>

    <label for="descripcion">Descripción</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?= s($propiedad->descripcion) ?></textarea>
</fieldset>    

<fieldset>
    <legend>Información de la Propiedad</legend>

    <label for="habitaciones">Habitaciones</label>
    <input type="number" placeholder="Ej: 3" id="habitaciones" min="1" max="9" name="propiedad[habitaciones]" value="<?= s($propiedad->habitaciones) ?>" />

    <label for="wc">Baños</label>
    <input type="number" placeholder="Ej: 2" id="wc" min="1" max="9" name="propiedad[wc]" value="<?= s($propiedad->wc) ?>" />

    <label for="estacionamiento">Estacionamiento</label>
    <input type="number" placeholder="Ej: 1" id="estacionamiento" min="1" max="9" name="propiedad[estacionamiento]" value="<?= s($propiedad->estacionamiento) ?>" />
</fieldset>
<fieldset>
    <legend>Vendedor</legend>
    <label for="vendedor">Vendedor</label>
    <select name="propiedad[vendedorId]" id="vendedor">
        <option value="" disabled selected>-- Seleccione --</option>

        <?php foreach($vendedores as $vendedor): ?>
            <option <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected' : '' ?> value="<?= s($vendedor->id) ?>"><?= s($vendedor->nombre) . " " . s($vendedor->apellido) ?></option>
        <?php endforeach; ?>
    </select>
</fieldset>