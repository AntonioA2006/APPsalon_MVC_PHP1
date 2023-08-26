<h1 class="nombre-pagina">crear cuenta</h1>
<p class="descripcion-pagina">Llena El Siguiente Formulario</p>

<?php include_once __DIR__ . "/../templates/alertas.php" ; ?>

<form class="formulario" action="/crear-cuenta" method="POST">

    <div class="campo">
        <label for="nombre">Nombre </label>
    <input type="text" id="nombre" name="nombre" placeholder="tu nombre" value="<?php echo s($usuario->nombre) ?>">
    </div>
    
    <div class="campo">
        <label for="apellido">apellido </label>
        <input type="text" id="apellido" name="apellido" placeholder="tu apellido" value="<?php echo s($usuario->apellido) ?>">
    </div>
    
    <div class="campo">
        <label for="telefono">telefono </label>
        <input type="tel" id="telefono" name="telefono" placeholder="tu telefono" value="<?php echo s($usuario->telefono) ?>">
    </div>

    <div class="campo">
        <label for="email">E-Mail </label>
        <input type="email" id="email" name="email" placeholder="tu email" value="<?php echo s($usuario->email) ?>">
    </div>
    
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="tu password">
    </div>

    <input type="submit" value="crear cuenta" class="boton">
</form>
<div class="acciones">

<a href="/">ya tiene una cuenta?? Inicia Sesion</a>
<a href="/olvide">Olvidaste tu Password?? Recuperalo</a>

</div>