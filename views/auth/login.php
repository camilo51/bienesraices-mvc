<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/login">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email" name="email" />

            <label for="password">Password</label>
            <input type="password" placeholder="Tu Password" id="password" name="password" />
        </fieldset>
        <input type="submit" value="Iniciar Sesión" class="boton-verde">
    </form>
</main>