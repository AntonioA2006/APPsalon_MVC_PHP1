<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Restablece Tu Password Utilizando Tu E-Mail</p>
<?php 
include_once __DIR__ . '/../templates/alertas.php';
?>

<form class="formulario" action="/olvide" method="POST">
    <div class="campo">
        <label for="email">email</label>
        <input type="email" name="email" id="email" placeholder="tu email">
    </div>


<input class="boton" type="submit" value="recupera tu password">
</form> 
<div class="acciones">

    <a href="/">Ya tienes una cuenta?? Inicia Sesion</a>
    <a href="/crear-cuenta">Aun No Tienes Cuenta?? Crea Una</a>

</div>