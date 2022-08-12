{{-- Esta rutina muestra el listado de las minutas recibidas --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

<style>
.container{
    font-family: Arial, Helvetica, sans-serif;
}
.leido{
    font-weight: none;
}

.noLeido{
    font-weight: bold;
}
td.alta{
    border-left: 10px solid red !important;
}

td.media{
    border-left: 10px solid #ff8000 !important;   
}

td.baja{
    border-left: 10px solid green !important;   
}


</style>
@stop

@section('content')
   <div class="container">
       <div class="card text-white bg-success mb-5">
         <h4 class="card-header">Listado de minutas</h4>   
       </div>

       <p></p> 
            
        <div class="table-responsive">
            <table class="table table-sm" id="tblNotificacion">
                  <thead>
                    <tr>
                        <th scope="col">Titulo</th>
                        <th scope="col">Destinatario/s</th>
                        {{-- <th scope="col">Creado por</th> --}}
                        {{-- <th scope="col">Acciones</th> --}}

                    </tr>
                  </thead>
                  <tbody>
                    
                        @foreach ($notificaciones as $notificacion)
                            
                            {{-- pregunta si el destinatario es el usuario actual --}}
                            @if($notificacion->destinatario == auth()->user()->name)

                                @if ( $notificacion->prioridad == "2")
                                
                                <!---------------- PRIORIDAD ALTA ----------------------------->

                                    @if( $notificacion->leido == 1) <!-- lei lanotificacion -->
                                        
                                         <tr>
                                            <td class="bg-light"><a href="{{ url("notificacion/". $notificacion->id)}}" class="btn btn-sm leido">{{$notificacion->titulo}}</a>
                                            </td>

                                            <td>{{ $notificacion->destinatario}}</td>
                                            {{-- <td>{{ $notificacion->creadoPor}}</td> --}}
                                            {{-- <td><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-trash"> Eliminar</button></td> --}}

                                         </tr>


                                    
                                            @elseif($notificacion->leido == 0) <!-- no lei la notificacion -->
                                           
                                            <tr class=noLeido>
                                                <td class="alta"><a href="{{ url("notificacion/". $notificacion->id)}}" class="btn btn-sm noLeido">{{$notificacion->titulo}}</a>
                                                </td>
                                                
                                                <td> {{ $notificacion->destinatario}}</td>

                                                {{-- <td> {{ $notificacion->creadoPor}}</td> --}} --}}
                                       
                                            </tr>
                                    @endif

                                <!------------------- PRIORIDAD MEDIA --------------------->
                                
                                @elseif($notificacion->prioridad == "1")

                                    @if( $notificacion->leido == 1) <!-- lei lanotificacion -->
                                         <tr>

                                            <td class="bg-light"><a href="{{ url("notificacion/". $notificacion->id)}}" class="btn btn-sm btn-light leido">{{$notificacion->titulo}}</a>
                                            </td>
                                            <td class="bg-light">{{ $notificacion->destinatario}}</td>
                                            
                                            {{-- <td class="bg-light">{{ $notificacion->creadoPor}}</td> --}}
                                         
                                         </tr>
                                        
                                        <!-- no lei la notificacion -->
                                        @elseif($notificacion->leido == 0) 
                                         <tr class="noLeido">                                 
                                            <td class="media">

                                                <!-- llama al show del controlador notificacion-->
                                               <a href="{{ url("notificacion/". $notificacion->id)}}" class="btn btn-sm noLeido">{{$notificacion->titulo}}</a>
                                            </td>
                                            
                                            <td>{{ $notificacion->destinatario}}</td>
                                            
                                            {{-- <td>{{ $notificacion->creadoPor}}</td> --}}

                                            
                                        </tr>
                                    @endif

                                <!---------------- PRIORIDAD BAJA --------------------->
                                
                                @elseif($notificacion->prioridad==  "0")  

                                    @if( $notificacion->leido == 1) <!-- lei lanotificacion -->
                                     <tr>

                                        <td><a href="{{ url("evento/".$notificacion->id) }}" class="btn btn-light btn-sm leido">{{$notificacion->titulo}}</a>
                                        </td>
                                        
                                        <td>{{ $notificacion->destinatario}}</td>
                                        
                                        {{-- <td>{{ $notificacion->creadoPor}}</td> --}}
                                        

                                     </tr>
                                
                                        @elseif($notificacion->leido == 0) <!-- no lei la notificacion -->

                                         <tr class="noLeido">

                                            <td class="baja"><a href="{{ url("notificacion/". $notificacion->id)}}" class="btn btn-sm noLeido">{{$notificacion->titulo}}</a>
                                            </td>
                                        
                                            <td>{{ $notificacion->destinatario}}</td>
                                        
                                            {{-- <td>{{ $notificacion->creadoPor}}</td> --}}
                                        
                                        </tr>

                                    @endif
                                @endif <!-- fin de if de prioridad-->
                            @elseif($notificacion->destinatario !=auth()->user()->name)
                            <tr>

                                <td><a href="{{ url("evento/".$notificacion->id) }}" class="btn btn-light btn-sm leido">{{$notificacion->titulo}}</a>
                                </td>
                                
                                <td>{{ $notificacion->destinatario}}</td>
                                
                                {{-- <td>{{ $notificacion->creadoPor}}</td> --}}
                                

                             </tr>
                            @endif <!-- fin de if de revision de destinatario -->
                        @endforeach
                  </tbody>
                </table>
            </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tblNotificacion').DataTable();
        });
    </script>
@stop



