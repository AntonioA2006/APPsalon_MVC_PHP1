
let paso = 1
const pasoInicial = 1;
const pasoFinal = 3;

//iniciamos el obgeto vacio
const cita = {
    id:'',
    nombre : '',
    fecha: '',
    hora:'',
    servicios:[]
}

//cuando inicie el dom va ejecutar la funcion

document.addEventListener('DOMContentLoaded', function(){
    
    iniciarApp();

});

function iniciarApp(){
    mostrarSeccion();//myuestra la seccion depeoendo del tab
    
    tabs(); //cambia la session cuando se precionen los tabs

    botonesPaginador();//agrega o quita los botones del pqaginador

    paginaSiguiente();

    paginaAnterior();

    consultarAPI();//CONSULTA LA api EN EL BACKEND

    idCliente();
    nombreCliente();
    seleccionarFecha();
    seleccionarHora();


    mostrarResumen();//muestra el resumen de la cita

}
function mostrarSeccion(){
    //ocultar la sewccion con la clase de mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if (seccionAnterior) { 
        seccionAnterior.classList.remove('mostrar');
    }

    //seleccionar la seccion con el paso
    const pasoSelector = `#paso-${paso}`;

    const seccion =   document.querySelector(pasoSelector)

    seccion.classList.add('mostrar');

    //quita la clase de actual al tab anterior

    const tabAnterior = document.querySelector('.actual');
    if (tabAnterior) {
        tabAnterior.classList.remove('actual');
    }

    //resalta el tab actual
    const tab = document.querySelector(`[data-paso = "${paso}"] `);
    tab.classList.add('actual');
}
//accceder a atributos custom de html con js
function tabs(){
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach( boton => {
        boton.addEventListener('click', function(e){
            paso = parseInt(e.target.dataset.paso);

            mostrarSeccion();

            botonesPaginador();
            
         
            
        });
    });
}
function botonesPaginador(){
         const paginaAnterior = document.querySelector('#anterior');
         const paginaSiguiente = document.querySelector('#siguiente');

         if(paso === 1){
            paginaAnterior.classList.add('ocultar');
            paginaSiguiente.classList.remove('ocultar');
        }else if(paso === 3){
             paginaAnterior.classList.remove('ocultar');
             paginaSiguiente.classList.add('ocultar');

             mostrarResumen();
         }else{
            paginaAnterior.classList.remove('ocultar');
            paginaSiguiente.classList.remove('ocultar');
         }
         mostrarSeccion();
}
function paginaAnterior(){
    const paginaAnterior =  document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function(){
        if (paso <= pasoInicial) return;

        paso--;

        botonesPaginador();

    });
}

function paginaSiguiente(){
    const paginasiguiente =  document.querySelector('#siguiente');
    paginasiguiente.addEventListener('click', function(){
        if (paso >= pasoFinal) return;

        paso++;

        botonesPaginador();

    });

}

async function consultarAPI(){

    try {
        const url = '/api/servicios';
        const resultado = await fetch(url);//espera con el await
        const servicios = await resultado.json();

        mostrarServicios(servicios);
    } catch (error) {
        console.log(error);
    }

}
function mostrarServicios(servicios){
    servicios.forEach(servicio =>{
        const {id, nombre, precio} = servicio;

        const NombreServicio  = document.createElement('P');
        NombreServicio.classList.add('nombre-servicio');
        NombreServicio.textContent = nombre;

        const PrecioServicio = document.createElement('P');
        PrecioServicio.classList.add('precio-servicio');
        PrecioServicio.textContent = `$${precio}`;

        const ServicioDiv = document.createElement('DIV');
        ServicioDiv.classList.add('servicio');
        ServicioDiv.dataset.idServicio = id;
        ServicioDiv.onclick = function(){
            seleccionarServicio(servicio);
        }

        ServicioDiv.appendChild(NombreServicio);
        ServicioDiv.appendChild(PrecioServicio);


        document.querySelector('#servicios').appendChild(ServicioDiv);
    });
}

function seleccionarServicio(servicio){
    const {id} = servicio
    const {servicios} = cita;
    const divServicio = document.querySelector(`[data-id-servicio = "${id}"]`);
    //comrpobar si un sefivicioo fue agregado

    if (servicios.some( agregado => agregado.id === id )) {
        //eliminarlo
        cita.servicios = servicios.filter( agregado => agregado.id !== id );
        divServicio.classList.remove('seleccionado');
    }else{
        //agregarlo
        cita.servicios = [...servicios , servicio];
        divServicio.classList.add('seleccionado');

    }
}
function idCliente(){
    cita.id = document.querySelector('#id').value;

}
function nombreCliente(){
    cita.nombre = document.querySelector('#nombre').value;
}
function seleccionarFecha(){
        const inputFecha = document.querySelector('#fecha');
        inputFecha.addEventListener('input', function(e){
            
            const Dia = new Date(e.target.value).getUTCDay();

            if ([6,0].includes(Dia)) {
                e.target.value = '';
                mostrarAlerta('no abrimos fines de semana', 'error', '.formulario');
            }else{
                cita.fecha = e.target.value;
            }

     });
}
function seleccionarHora(){
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function(e){

        const horaCita = e.target.value;
        const hora  = horaCita.split(":")[0];
        
        if (hora < 10 || hora>18) {
            e.target.value = '';
            mostrarAlerta('Hora No Valida', 'error', '.formulario');
        }else{
            cita.hora = e.target.value;
            console.log(cita);
        }

    });    
}
function mostrarAlerta(mensaje, tipo, elemento, desaparece = true){
    //previene que se ejecute mas de na alerta
        const alertaPrevia = document.querySelector('.alerta');
        if (alertaPrevia){
            alertaPrevia.remove();
        }
        //SCRIPTING para crear la alerta  
        const alertas = document.createElement('DIV');
        alertas.textContent = mensaje;
        alertas.classList.add('alerta');
        alertas.classList.add(tipo);

        const referencia = document.querySelector(elemento);
        referencia.appendChild(alertas);
        //reomever la alerta despues de 3s
        if (desaparece) {
            setTimeout(() => {
                alertas.remove();
            }, 3000);
            
        }
     
}

function mostrarResumen(){
        const resumen = document.querySelector('.contenido-resumen');

       // limpiar el contenido de resumen 

       while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild)
       }


        if (Object.values(cita).includes('') || cita.servicios.length === 0) {

            mostrarAlerta('falta datos de fecha, hora', 'error', '.contenido-resumen', false);
         return;   
        }

        //formatear el DIV de resumen
        const {nombre, fecha, hora, servicios} = cita;

        //heading para servicios
        const headingServicios = document.createElement('H3');
        headingServicios.textContent = 'Resumen de Servicios';
        resumen.appendChild(headingServicios);


        //iterando los servicios
        servicios.forEach(servicio => {
            const {id, precio, nombre} = servicio;

            const contenedorServicio = document.createElement('DIV');
            contenedorServicio.classList.add('contenedor-servicios');

            const textoServicio = document.createElement('P');
            textoServicio.textContent = nombre;

            const precioServicio = document.createElement('P');
            precioServicio.innerHTML = `<span>Precio:</span> $${precio}`;

            contenedorServicio.appendChild(textoServicio);
            contenedorServicio.appendChild(precioServicio);

            resumen.appendChild(contenedorServicio);


        });
        //heading para cita
        const headingCita = document.createElement('H3');
        headingCita.textContent = 'Resumen de Cita';
        resumen.appendChild(headingCita);
        
        const nombreCliente = document.createElement('P');
        nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;
        
        //formatear la fcha en espanol
        const fechaObj =  new Date(fecha);
        const mes = fechaObj.getMonth();
        const dia = fechaObj.getDate() + 2;
        const year = fechaObj.getFullYear();

        const fechaUTC = new Date(Date.UTC(year, mes, dia));
        const opciones = {weekday: 'long', year: 'numeric', month: 'long', day:'numeric'};
        const fechaFormateada = fechaUTC.toLocaleDateString('es-Mx',opciones );
        

        const fechaCita = document.createElement('P');
        fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;
        
        const horaCita = document.createElement('P');
        horaCita.innerHTML = `<span>Hora:</span> ${hora} Horas`;

        //boton
        const botonReservar = document.createElement('BUTTON');
        botonReservar.classList.add('boton');
        botonReservar.textContent = 'ReservarCita';
        botonReservar.onclick = reservarCita;

        resumen.appendChild(nombreCliente);
        resumen.appendChild(fechaCita);
        resumen.appendChild(horaCita);

        resumen.appendChild(botonReservar);
}
async function reservarCita(){
    const {nombre, fecha, hora, servicios, id } = cita;

    const idServicios = servicios.map(servicio => servicio.id);
   // console.log(idServicios);


    const datos = new FormData();
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('usuarioId', id);
    datos.append('servicios', idServicios);

    //peticion hacia la API
    try {
        
    const url = '/api/citas';

    const respuesta = await fetch(url, {
        method: 'POST', 
        body: datos

    });
    
    const resultado = await respuesta.json();
    console.log(resultado.resultado);
    if (resultado.resultado) {
        Swal.fire({
            icon: 'success',
            title: 'Cita Creada',
            text: 'tu cita fue creada correctamente',
            button: 'OK'
          }).then( () => {
            setTimeout(() => {      
                window.location.reload();
            }, 3000);
          });
    }  
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo Un Error Al guardar la cita...'
          }) 
    }


  //  console.log([...datos]); inpexionar el form dataxdd
}