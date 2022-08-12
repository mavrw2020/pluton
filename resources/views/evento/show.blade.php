{{-- En esta rutina se crea el modal para el ingreso 
	de la minuta. --}}

@extends('adminlte::page')

@section('title', 'ver evento')

@section('plugin','fullcalendar', true)

@section('content_header')
@stop

@section('content')

<body>
    <p></p>
	{{-- <div class="row justify-content-end">
   		 <a href="{{ route('notificacion.index') }}" class="btn btn-success"><-- Volver</a>
    </div>	 --}}
   <p></p>


	<div class="container" style="font-family:arial;">
		<p></p>
		<div class="card">
			<div class="card-header bg-info" style="font-family: arial; font-size: 18px;">
				Información de Minuta
			</div>
			<div class="card-body text-center">

				<div class="table-responsive">
					<table class="table table-striped table-borderles table-sm">
				  		<thead class="thead-light">
						    <tr>
						      <th scope="col">Lugar</th>
						      <th scope="col">Fecha</th>
						      <th scope="col">Objetivo</th>
						      
							</tr>
						</thead>
						<tbody>
						  	<tr>
						  		@foreach($eventos as $evento)
						  			<td>{{$evento->lugar}}</td>
							  		<td>{{date('d-m-Y', strtotime($evento->fecha))}}</td>		
							  		<td>{{$evento->objetivo}}</td>
							  		
							  	@endforeach
						  	</tr>
						</tbody>
					</table>
				</div><!--cierro la tabla-->
			</div><!--cierro el card body-->
		</div><!-- cierro el card -->

		<p></p>
		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header bg-danger" style="font-family: arial; font-size: 18px;">
						Asuntos Primarios
					</div>
					<div class="card-body">
						@foreach($eventos as $evento)
							{{$evento->asuntosTratados}}
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="card">
					<div class="card-header bg-warning" style="font-family: arial; font-size: 18px;">
						Asuntos Secundarios
					</div>
					<div class="card-body">
						@foreach($eventos as $evento)
							{{$evento->asuntosSecundarios}}
						@endforeach
					</div>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-header bg-info"  style="font-family: arial; font-size: 18px;">
				Asistentes
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-borderless table-sm">
						  <caption>List of users</caption>
						  <thead class="thead-light">
						    <tr>
						      <th scope="col">Nombre</th>
						      <th scope="col">Puesto</th>
						    </tr>
						  </thead>
						  <tbody>
						  	@foreach($asistentes as $asistente)
						    	<tr>
									<td>{{$asistente->nombre}}</td>
									<td>{{$asistente->puesto}}</td>
								</tr>
							@endforeach
						  </tbody>
						</table>
					</div> 
				
			</div>
		</div>

		<div class="card">
			<div class="card-header bg-info"  style="font-family: arial; font-size: 18px;">
				Compromisos
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-borderless table-sm">
						  <caption>List of users</caption>
						  <thead class="thead-light">
						    <tr>
						      <th scope="col">Nombre</th>
						      <th scope="col">Puesto</th>
						      <th scope="col">Fecha de Presetacion</th>
						    </tr>
						  </thead>
						  <tbody>
						  	@foreach($compromisos as $compromiso)
						    	<tr>
									<td>{{$compromiso->responsable}}</td>
									<td>{{$compromiso->tarea}}</td>
									<td>{{date('d-m-Y', strtotime($compromiso->fechaEntrega))}}</td>
								</tr>
							@endforeach
						  </tbody>
						</table>
					</div> 
					
				
			</div>
		</div>

		<div class="card">
			<div class="card-header bg-success" style="font-family: arial; font-size: 18px;">
				Observaciones
			</div>
			<div class="card-body">
				@foreach($eventos as $evento)
						{{$evento->observaciones}}
					@endforeach
			</div>
		</div>
						
		<div class="card">
			<div class="card-header bg-info" style="font-family: arial; font-size: 18px;">
				Se ha notificado a
			</div>
			<div class="card-body">
				@foreach($notificados as $notificado)
						<p>{{$notificado->destinatario}}</p>
				@endforeach
			</div>
			<div class="card-footer bg-dark" >
				Fecha de Proxima Reunion: @foreach($eventos as $evento)
												{{date('d-m-Y', strtotime($evento->fechaProximaReunion)) }}
										  @endforeach
			
				  
			</div>
		</div>
			<p></p>
			<!--Boton de Volver-->
		       	{{-- <div class="row justify-content-center">
           			 <a href="{{ route('notificacion.index') }}" class="btn btn-success"><-- Volver</a>
        		</div>		 --}}
        	<p></p>
		

		
</body>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
