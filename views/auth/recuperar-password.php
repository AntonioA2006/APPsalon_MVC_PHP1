<h1 class="nombre-pagina">Recuperar Password</h1>

<p class="descripcion-pagina">Coloca tu nuevo Password A Continuacion</p>

<?php 
include_once __DIR__ . '/../templates/alertas.php';
?>
<?php  if($error) return;?>
<form class="formulario" method="POST" >
    <div class="campo">
        <label for="password">password</label>
        <input type="password" id="password" name="password" placeholder="tu nuevo password">
    </div>
    <input type="submit" value="Guardar Tu Nuevo Password" class="boton">

</form>
<div class="acciones">
    <a href="/">Ya Tienes Cuenta? Inicia Sesion</a>
    <a href="/crear-cuenta">No Tienes Cuenta? CREA Una</a>
</div>