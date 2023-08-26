<h1 class="nombre-pagina">Crear Nuevo Cita</h1>
<p  class="descripcion-pagina">Elige Tus Servicios A Continuacion</p>
<?php 
include_once __DIR__ . '/../templates/barra.php';
?>
<div id="app">
    <nav class="tabs">
    <button class="actual" type="button" data-paso = "1">Servicios</button>
    <button type="button" data-paso = "2">Informacion Cita</button>
    <button type="button" data-paso = "3">Resumen</button>

    </nav>

    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige Los Servicios Para Mejorar Tu Estilo</p>
        <div id="servicios" class="listado-servicios">

         </div>

    </div>
 <div id="paso-2" class="seccion">

         <h2>Tus Datos Y Citas</h2>
    <p class="text-center">Coloca Tus Datos y Fecha De Tu Cita</p>

    <form class="formulario">

    <div class="campo">
        <label for="nombre">Nombre</label>
        <input id="nombre" type="text" name="nombre" placeholder="Tu Nombre" value="<?php echo $nombre ?>" disabled>
    </div>
    <div class="campo">
        <label for="Fecha">Fecha</label>
        <input id="fecha" type="date" name="Fecha"  min="<?php echo date('Y-m-d') ?>" >
    </div>
    <div class="campo">
        <label for="hora">hora</label>
        <input id="hora" type="time" name="hora">
    </div>
    <input type="hidden" id="id" value="<?php echo $id; ?>">


    </form>

</div>
    <div id="paso-3" class="seccion contenido-resumen">
    <h2>Resumen</h2>
        <p class="text-center">Verifica Que La Informacion Sea Correcta</p>


     </div>

     <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button>

        <button id="siguiente" class="boton">Siguiente &raquo;</button>
     </div>
  
     </div>

     <?php 
     $script = " 
     <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
     <script src = 'build/js/app.js'></script>
     
     
     
     ";
     ?>