@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugin','fullcalendar', true)

@section('content_header')
@stop

@section('content')

<body>

<p></p>

<!-- Button trigger modal -->
<div class="container">
    <div class="form-group">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#evento">Nueva Minuta
        </button>
    </div>
</div>

<p></p>

<!-- llama al calendario-->
<div class="container">
    <div id="calendar"></div>
</div>

<!-- FORMULARIO DE MINUTA -->
<form id="formEvento" action="{{ url ('/evento') }}" method="POST" >
    @csrf

<!-- Modal -->
<div class="modal fade" id="evento" tabindex="-1" role="dialog" aria-labelledby="evento" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">NUEVO EVENTO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                    <!------------------------ INFORMACION DE LA REUNION -------------------->
                    <label id="titulo"  name="titulo">Minuta de Reunion</label>       

                    <div class="form-group">
                       <label for=""></label>
                       <input type="text" class="form-control" name="txtLugar" id="txtLugar" aria-describedby="helpId" placeholder="Lugar">
                    </div>
                    <div class="form-group">
                       <label for=""></label>
                       @inject('carbon', 'carbon\carbon') <!-- carga la libreria de fechas -->
                       <input type="date" class="form-control" name="txtFecha" id="txtFecha" aria-describedby="helpId" placeholder="Fecha">
                    </div>
                    <div class="form-group">
                       <label for=""></label>
                       <input type="text" class="form-control" name="txtObjetivo" id="txtObjetivo" aria-describedby="helpId" placeholder="Objetivo">                       
                    </div>
                    
                    <hr>
                    
                    <!------------------ ASISTENCIAS A REUNION ------------------------>

                    <label id="titulo">Asistentes</label>

                    <input type="button" class="btn btn-success btn-sm" id="btnAsistencia" value="Agregar Miembro"/>
                    <p></p>

                    <div class="table-responsive">
                        <table class="table table-striped table-sm " id="tblAsistencia">
                            <thead >
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Puesto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="asistente[nombre][]" id="txtNombreAs"  placeholder="Nombre">
                                    </td>   
                                    <td>
                                        <input type="text" class="form-control" name="asistente[puesto][]" id="txtPuestoAs"  placeholder="Puesto">
                                    </td>
                                </tr>                     
                            </tbody>
                        </table>
                    </div>

                    <hr>
                    
                    <!------------------------------ ASUNTOS TRATADOS --------------------->

                    <label id="titulo">Asuntos Primarios</label>
                    <div class="form-group mb-3">
                        <textarea id="txtAsuntoTratado" name="txtAsuntoTratado" rows="5" class="form-control"></textarea>
                    </div>
                    
                    
                    <label id="titulo">Asuntos Secundarios</label>
                    <div class="form-group mb-3">
                        <textarea id="txtAsuntoSecundario" name="txtAsuntoSecundario" rows="5" class="form-control"></textarea>
                    </div>

                    <!-------------------------------------COMPROMISOS------------------------------------>
                   
                    <label id="titulo">Compromiso</label>
                    <p> </p>
                    <button type="button" class="btn btn-success btn-sm"  id="btnCompromiso">Agregar Compromiso</button>
                    <p> </p>

                    <div class="table-responsive">
                       <table class="table table-striped table-sm" id="tblCompromiso">
                           <thead>
                               <tr>
                                   <th scope="col">Tarea</th>
                                   <th scope="col">Responsable</th>
                                   <th scope="col">Fecha Entrega</th>
                               </tr>
                           </thead>
                           <tbody>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="compromiso[tarea][]" id="txtTarea"  placeholder="Tarea">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="compromiso[responsable][]" id="txtResponsable"  placeholder="Responsable">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="compromiso[fechaEntrega][]" id="txtFechaEntrega"  placeholder="Fecha de Entrega">
                                    </td>
                        
                                </tr>
                           </tbody>
                       </table>
                    </div>

                    <label id="Observaciones">Observaciones</label>
                    <div class="form-group mb-3">
                        <textarea id="txtObservaciones" name="txtObservaciones" rows="5" class="form-control"></textarea>
                    </div>

                    <!---------------------------------- DATOS NOTIFICACION ---------------------------->
                    <div class="form-group">
                       <label for="">Fecha de Proxima Reunion</label>
                       <input type="date" class="form-control" name="txtFechaProximaReunion" id="txtFechaProximaReunion" aria-describedby="helpId" placeholder="Fecha de Proxima Reunion">
                    </div>
                    <p>
                    <input type="button" class="btn btn-success btn-sm" name="btnDestinatario" id="btnDestinatario" value="Agregar Destinatario"/>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm" id="tblDestinatario">
                           <thead>
                               <tr>
                                    <th scope="col">Enviar Minuta A:</th>
                                    <th scope="col">Prioridad</th>
                               </tr>
                           </thead>
                           <tbody>
                                <tr>
                                    <td>
                                        <select class="custom-select form-select" name="minuta[integrante][]" id="txtUsuario">
                                            <option values="">Destinatario...</option>
                                            @foreach($usuarios as $usuario)
                                                <option value="{{ $usuario->name }}" >{{ $usuario->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                       
                                    <td>
                                        <select class="custom-select form-control" name="minuta[prioridad][]" id="selPrioridad">
                                            <option value="99" selected>Importacia...</option>
                                            <option value="0">Baja</option>
                                            <option value="1">Media</option>
                                            <option value="2">Alta</option>
                                        </select>
                                    </td>   
                                </tr>
                           </tbody>
                        </table>

                        <label>Minuta Creada Por</label>
                        <input type="text" id="txtCreadoPor"name="txtCreadoPor" class="form-control" value="{{ auth()->user()->name }}">
                    </div>
        
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>

</form>
</body>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

<script>

var i=0;

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',

        locale: "es",

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        
        //Muestra los eventos segun el
        eventSources: [
         {
             url: 'verEvento', // use the `url` property
         }
         ],

        // Toma de la variable evento el id del evento
        //y carga la pagina evento.show enviando el id
        eventClick: function(info){
            var evento = info.event;
            var id = evento.id;
            window.location = "notificacion/"+id;
        }      
       
    });         
  
    calendar.render();
});

</script>

<script>

$(function(){
    $("#btnAsistencia").click(function(){

		//Clona la primer fila de la tabla
        var clonarfilaAsistencia= $("#tblAsistencia").find("tbody tr:first").clone();		 
        
        //Limpia la fila clonada
        clonarfilaAsistencia.find('input').val('');
        
        //Agrega la fila al final de la tabla
		$("#tblAsistencia tbody").append(clonarfilaAsistencia);      
        
	});
    
    $("#btnCompromiso").click(function(){

        //Clona la primer fila de la tabla
        var clonarfilaCompromiso= $("#tblCompromiso").find("tbody tr:first").clone();		 

        //Limpia la fila clonada
        clonarfilaCompromiso.find('input').val('');

        //Agrega la fila al final de la tabla
        $("#tblCompromiso tbody").append(clonarfilaCompromiso);      

    });

    $("#btnDestinatario").click(function(){

        //Clona la primer fila de la tabla
        var clonarfilaCompromiso= $("#tblDestinatario").find("tbody tr:first").clone();        

        //Limpia la fila clonada
        clonarfilaCompromiso.find('input').val('');

        //Agrega la fila al final de la tabla
        $("#tblDestinatario tbody").append(clonarfilaCompromiso);      

    });


});
</script>

@stop