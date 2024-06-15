<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Titulo</label>
    <input type="text" placeholder="Titulo de la entrada" id="titulo" name="entrada[titulo]" value="<?= s($entrada->titulo) ?>" />
    
    <label for="imagen">Imagen</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="entrada[imagen]" />
    <?php if ($entrada->imagen) : ?>
        <img src="/imagenes/entradas/<?= $entrada->imagen ?>" class="imagen-small">
    <?php endif; ?>

    <label for="informacion">Informacion</label>
    <textarea name="entrada[informacion]" id="informacion" placeholder="Información de la entrada"><?= s($entrada->informacion) ?></textarea>


</fieldset>