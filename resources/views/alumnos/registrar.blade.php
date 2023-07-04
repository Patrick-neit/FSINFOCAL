{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Ventas Registrar')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-sidebar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-contacts.css')}}">
  <style>
        .custom-table th:nth-child(1),
        .custom-table td:nth-child(1) {
          width: 60%; /* Tamaño personalizado para la primera columna */
          padding: 8px;
        }

        .custom-table th:nth-child(2),
        .custom-table td:nth-child(2) {
          width: 20%; /* Tamaño personalizado para la segunda columna */
          padding: 8px;
        }

        .custom-table th:nth-child(3),
        .custom-table td:nth-child(3) {
          width: 20%; /* Tamaño personalizado para la tercera columna */
          padding: 8px;
        }

        .black-text{
          color: black !important
        }

        .componente-filtrador{
            margin-top: 5px !important;
            margin-bottom: 2px !important;
            padding: 5px 5px 10px 10px !important;
        }

        .margin-abajo{
            margin-bottom: 1px !important;
            padding-bottom: 1px !important;
        }

        .seleccionable{
            cursor: pointer;
        }

        .disabled-select{
            cursor: not-allowed !important;
        }

        .desabilitar{
            pointer-events: none !important;
            cursor: not-allowed !important;
        }

  </style>
@endsection
{{-- page content --}}
@section('content')

<div class="section">
    <div class="card">
      <div class="card-content">
        <h6 class="caption"><strong> Realizar transacción</strong> </h6>
      </div>
    </div>

    <div class="row">
        <form class="col s12" id="formValidate" onsubmit="return false" >
            <div id="tap-target" class="card card-tabs">

                <div class="card-content margin-abajo">
                    <strong class="black-text">Buscar estudiante: </strong>
                    <div class="row ">

                        <div class="input-field col s4">
                            <input id="carnet" type="text" class="validate" placeholder="Ingresar carnet" oninput="detectarEscritura(event)">
                            <label for="carnet" class="black-text">Carnet</label>
                        </div>
                        <div class="input-field col s4">
                          <input id="nombres" type="text" class="validate" placeholder="Ingresar nombres" oninput="detectarEscritura(event)">
                          <label for="nombres" class="black-text">Nombres</label>
                        </div>
                        <div class="input-field col s4" >
                          <input id="apellidos" type="text" class="validate"  placeholder="Ingresar apellidos" oninput="detectarEscritura(event)">
                          <label for="apellidos" class="black-text">Apellidos</label>
                        </div>

                    </div>
                </div>

                <div class="card-content margin componente-filtrador hide"  id="filtrador">
                    <ul class="collection" id="listaEstudiantes" >
                    </ul>
                </div>

                <div class="card-content -mb-2">
                    <strong>Seleccionar datos academicos: </strong>
                    <div class="row">
                        <div class="input-field col s3">
                            <select class="black-text  " id="periodos-v"  onchange="periodoCargado()"  >
                                  <option value="" selected disabled class="black-text"  >Selecciona un periodo</option>
                                  <option value="8" class="black-text" >Periodo VER</option>
                                  <option value="1" class="black-text" >Periodo I</option>
                                  <option value="2" class="black-text" >Periodo II</option>
                                  <option value="3" class="black-text" >Periodo III</option>
                                  <option value="4" class="black-text" >Periodo IV</option>
                                  <option value="5" class="black-text" >Periodo V</option>
                                  <option value="6" class="black-text" >Periodo VI</option>
                                  <option value="7" class="black-text" >Periodo INV</option>
                            </select>
                            <label class="black-text">Periodo</label>
                        </div>
                        <div class="input-field col s3"></div>
                        <div class="input-field col s3 bg-danger">
                          <select class=""  id="turnos"  onchange="turnoCargado()" >
                              <option value="" disabled  selected>Selecciona un turno</option>
                              <option value="1">Mañana</option>
                              <option value="2">Tarde</option>
                              <option value="3">Noche</option>
                          </select>
                          <label class="black-text">Turnos</label>
                        </div>
                        <div class="input-field col s3 bg-danger">
                            <select class=""  id="materiasOfertadas" onchange="cargarArticulo()" >
                                <option value=""  disabled selected>Selecciona una materia</option>
                                <option value="8">Programacion Web</option>
                                <option value="1">Informatica 11</option>
                            </select>
                            <label class="black-text">Materias Ofertadas</label>
                        </div>
                    </div>
                </div>

                <div class="card-content">
                  <div class="row">

                      <div class="input-field col s12">
                        <strong>Detalles</strong>
                        <table class="Highlight responsive-table custom-table">
                          <thead class="blue white-text">
                            <tr>
                              <th class="s6">Articulo</th>
                              <th class="s3" >Precio</th>
                              <th class="s3"></th>
                            </tr>
                          </thead>
                          <tbody class="black-text" id="contenidoAcademico" >
                                <tr class="center-align"><td class="center-align" colspan="3">Sin articulos</td></tr>
                          </tbody>
                        </table>
                      </div>

                      <div class="input-field col s12">
                          <div class="row">
                               <div class="input-field col s3  ">
                                  <select class=""  id="metodoPagos" required>
                                      <option value="" disabled selected>Selecciona una opcion</option>
                                      <option value="1">Pago Efectivo</option>
                                      <option value="2">Saldo a favor</option>
                                  </select>
                                  <label class="black-text">Metodo de pago</label>
                              </div>
                              <div class="input-field col s3">
                                  <input id="montoTotal" type="text" class="validate" placeholder="0.00" disabled >
                                  <label for="montoTotal" class="black-text">Totales</label>
                              </div>
                              <div class="input-field col s3">
                                <input id="montoIngresado" type="number" oninput="controlarTotal(event)" class="validate" placeholder="0.00" required>
                                <label for="montoIngresado" class="black-text">Monto Ingresado</label>
                              </div>
                              <div class="input-field col s3">
                                <input id="montoDevuelto" type="text" class="validate" placeholder="0.00" disabled>
                                <label for="montoDevuelto" class="black-text">Monto Devuelto</label>
                              </div>
                          </div>
                      </div>

                      <div class="input-field col s12 center-align">
                          <button class="btn waves-effect waves-light " type="submit" onclick="realizarTransaccion()"   >
                                Realizar Transferencia
                          </button>
                      </div>

                  </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/css-grid.js')}}"></script>

<script>
    var carnet = document.getElementById('carnet');
    var nombres = document.getElementById('nombres');
    var apellidos = document.getElementById('apellidos');

    var componenteLista =  document.getElementById('listaEstudiantes');
    var componenteFiltrador = document.getElementById('filtrador');
    var componenteTabla = document.getElementById('contenidoAcademico');

    var periodos =  document.getElementById('periodos-v');
    var turnos = document.getElementById('turnos');
    var materiasOfertadas = document.getElementById('materiasOfertadas');
    var metodosPagos =  document.getElementById('metodoPagos');
    var montoTotal = document.getElementById('montoTotal');
    var montoIngresado = document.getElementById('montoIngresado');
    var montoDevuelto = document.getElementById('montoDevuelto');

    var lista_articulos_seleccionados = [];

    const personas =
    [
        {
            carnet: "00001",
            nombres: "Juan",
            apellidos: "Pérez"
        },
        {
            carnet: "00002",
            nombres: "María",
            apellidos: "González"
        },
        {
            carnet: "00003",
            nombres: "Pedro",
            apellidos: "López"
        },
        {
            carnet: "00004",
            nombres: "Ana",
            apellidos: "Martínez"
        },
        {
            carnet: "00005",
            nombres: "Luis",
            apellidos: "Hernández"
        },
        {
            carnet: "00006",
            nombres: "Carla",
            apellidos: "Ramírez"
        },
        {
            carnet: "00007",
            nombres: "Andrés",
            apellidos: "Torres"
        },
        {
            carnet: "00008",
            nombres: "Sofía",
            apellidos: "Cruz"
        },
        {
            carnet: "00009",
            nombres: "Eduardo",
            apellidos: "Sánchez"
        },
        {
            carnet: "00010",
            nombres: "Valeria",
            apellidos: "Gómez"
        },
        {
            carnet: "00011",
            nombres: "Gabriel",
            apellidos: "Vargas"
        },
        {
            carnet: "00012",
            nombres: "Marcela",
            apellidos: "Lara"
        },
        {
            carnet: "00013",
            nombres: "Ricardo",
            apellidos: "Ortega"
        },
        {
            carnet: "00014",
            nombres: "Fernanda",
            apellidos: "Díaz"
        },
        {
            carnet: "00015",
            nombres: "Hugo",
            apellidos: "Cortés"
        },
        {
            carnet: "00016",
            nombres: "Daniela",
            apellidos: "Ríos"
        },
        {
            carnet: "00017",
            nombres: "Diego",
            apellidos: "Mendoza"
        },
        {
            carnet: "00018",
            nombres: "Carolina",
            apellidos: "Herrera"
        },
        {
            carnet: "00019",
            nombres: "Roberto",
            apellidos: "Castillo"
        },
        {
            carnet: "00020",
            nombres: "Laura",
            apellidos: "Rodríguez"
        }
    ];

    function detectarEscritura(e){
        let resultado = buscarEstudiantes(carnet.value, nombres.value, apellidos.value)
        eliminarClase(componenteFiltrador,'hide')
        renderizarListaEstudiantes(resultado)
    }

    function buscarEstudiantes( carnet, nombres , apellidos ){
        const valorBusqueda = nombres;
        const valorBusqueda2 = apellidos;
        const valorBusqueda3 = carnet;
        const regex = new RegExp(valorBusqueda, "i");
        const regex2 = new RegExp(valorBusqueda2, "i");
        const regex3 = new RegExp(valorBusqueda3);
        const resultado = personas.filter((persona) => {
            const coincideNombre = regex.test(persona.nombres);
            const coincideApellidos = regex2.test(persona.apellidos);
            const coincideCarnet = regex3.test(persona.carnet);
            return coincideNombre &&  coincideApellidos && coincideCarnet;
        });
        return resultado
    }

</script>
<script>

    document.addEventListener('DOMContentLoaded', function() {

        periodos.disabled = true;
        turnos.disabled = true;
        materiasOfertadas.disabled = true;
        metodosPagos.disabled = true;
        var instance = M.FormSelect.getInstance(periodos);
        var instance_2 = M.FormSelect.getInstance(turnos);
        var instance_3 = M.FormSelect.getInstance(materiasOfertadas);
        var instance_4 = M.FormSelect.getInstance(metodosPagos);
        /*         instance.destroy();
        instance_2.destroy();
        instance_3.destroy(); */
    });

</script>
<script>

    function eliminarClase(elemento,clase){
        elemento.classList.remove(clase);
    }

    function agregarClase(elemento,clase){
        elemento.classList.add(clase);
    }

    function habilitarControl(elemento){
        elemento.disabled = false;
        M.FormSelect.init(elemento);
    }

    function desabilitarControl(elemento){
        elemento.disabled = false;
        M.FormSelect.init(elemento);
    }

    function seleccionarObjeto(carnetParametro){
        let resultado = personas.find(persona => persona.carnet == carnetParametro);
        carnet.value = resultado.carnet.toString()
        nombres.value = resultado.nombres.toString()
        apellidos.value = resultado.apellidos.toString()
        agregarClase(componenteFiltrador,'hide')
        habilitarControl(periodos)

        cargarPeriodos()
    }

    function cargarPeriodos(){
        // fetch pàra obtener periodos o meses de la base de datos y cargarlo al select de periodos
    }

    function periodoCargado(){
        let idPeriodo = periodos.value
        // fetch pàra obtener los turnos de la base de datos y cargarlos al select de  turnos
        habilitarControl(turnos)
    }

    function turnoCargado(){
        let idTurno = turnos.value
        // fetch para obtener las materias en el turno seleccionado y cargarlo en el select de materias ofertadas
        habilitarControl(materiasOfertadas)
    }

    var aux = 0;
    function cargarArticulo(){
        // cargar la opcion seleccionada en la tabla
        lista_articulos_seleccionados.push({
            id:aux,
            articulo :'Ejemplo - '+aux,
            precio :  Math.floor(Math.random() * 100) + 1 ,
        })
        aux+=1
        // renderizar nueva lista
        renderizarTabla(lista_articulos_seleccionados)
        calcularTotales(lista_articulos_seleccionados)
    }

    function eliminarElemento(idArticulo){
        var indice = lista_articulos_seleccionados.findIndex(function(articulo) {
            return articulo.id == idArticulo;
        });
        if (indice !== -1) {
            lista_articulos_seleccionados.splice(indice, 1);
            renderizarTabla(lista_articulos_seleccionados)
            calcularTotales(lista_articulos_seleccionados)
        }
    }

    function calcularTotales(listaArticulos){
        var total = listaArticulos.reduce(function(acumulador, producto) {
            return acumulador + producto.precio;
        }, 0);
        habilitarControl(metodosPagos)
        montoTotal.value = total;
    }

    function controlarTotal(e){
        let total = Number(montoTotal.value);
        let ingresado = Number(montoIngresado.value)
        montoDevuelto.value = ( ingresado-total )+' bs.'
    }

</script>
<script>

    function renderizarListaEstudiantes(listaEstudiantes){
        let contenido = '';
        if( listaEstudiantes.length > 0  && (carnet.value.length>0 || nombres.value.length > 0 || apellidos.value.length>0) ){
            listaEstudiantes.forEach(element => {
                contenido+='<li class="collection-item seleccionable hover" onClick="seleccionarObjeto('+element.carnet.toString()+')" ><i class="material-icons">check</i>'+element.carnet +'  -  '+ element.nombres +'  '+ element.apellidos +'</li>';
            });
            componenteLista.innerHTML= contenido
        }else{
            componenteLista.innerHTML = '<li class="collection-item center-align">Sin resultados</li>';
        }
    }

    function renderizarTabla(listaArticulos){
        let contenido = '';
        if( listaArticulos.length > 0  )
        {
            listaArticulos.forEach(element => {
                contenido+='<tr>'+
                            '<td>'+element.articulo+'</td>'+
                            '<td>'+element.precio+' bs.</td>'+
                            '<td>'+
                                '<a class="btn red waves-effect waves-light border-round " onClick="eliminarElemento('+element.id+')" >'+
                                '<i class="material-icons left">delete</i>'+
                                '</a>'+
                            '</td>'+
                            '</tr>';
            });
            componenteTabla.innerHTML= contenido
        }else{
            componenteTabla.innerHTML = '<tr class="center-align"><td class="center-align" colspan="3">Sin articulos</td></tr>';
        }
    }

    function realizarTransaccion(){
        //event.preventDefault();
        let total = Number(montoTotal.value);
        let ingresado = Number(montoIngresado.value)
        if( total != ingresado){
            M.toast({html: 'X  El monto ingresado es menor al total.... Intente nuevamente!', classes: 'rounded red waves-light '});
        }else{
            M.toast({html: '!Transaccion realizada correctaemnte!', classes: 'rounded green waves-light '});
        }
        return false;
    }

</script>
@endsection
