<h1 class=nombre-pagina >login</h1>
<p class="descripcion-pagina"> Inicia Sesion Con Tus Datos </p>
<?php include_once __DIR__ . "/../templates/alertas.php" ; ?>

<form class="formulario" method="POST" action="/" >
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="tu email" name="email">
    </div>
    <div class="campo">

    <label for="password">password</label>
    <input type="password" id="password" placeholder="tu password" name="password">

    </div>
    <input type="submit" class="boton" value="Iniciar Sesion">


</form>
<div class="acciones">

<a href="/crear-cuenta">Aun No Tienes Cuenta?? Crea Una</a>
<a href="/olvide">Olvidaste tu Password?? Recuperalo</a>

</div>