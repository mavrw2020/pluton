<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Evento;
use App\Models\Asistente;
use App\Models\Compromiso;
use App\Models\Notificacion;


class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $usuarios = User::all();
        $notis = Notificacion::all();
        return view('evento.index', compact('usuarios','notis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // -------------------> Se guardan los datos en la tabla eventos <----------------
        $evento = new Evento;

        $evento->lugar = $request->input('txtLugar');
        $fecha = date('Y-m-d',$request->input('txtFecha'));      
        $evento->fecha = $fecha;
        $evento->objetivo               = $request->input('txtObjetivo');
        $evento->asuntosTratados        = $request->input('txtAsuntoTratado');
        $evento->asuntosSecundarios     = $request->input('txtAsuntoSecundario');
        $evento->observaciones          = $request->input('txtObservaciones');
        $evento->fechaProximaReunion    = $request->input('txtFechaProximaReunion');
        $evento->creadoPor              = $request->input('txtCreadoPor');
        $evento->save();

        //tomamos el ultimo Id de agregado
        $ultimoEvento = Evento::latest('id')->first();
        $idUltimoEvento = $ultimoEvento->id;

    
        //----------------> guardo los Asistentes <--------------

        $item = $request->asistente;

        for($i=0; $i<count($item["nombre"]); $i++)
        {
            $asistente = new Asistente;
    
            $asistente->nombre      = $item["nombre"][$i];
            $asistente->puesto      = $item["puesto"][$i];
            $asistente->id_evento   = $idUltimoEvento;
            $asistente->save(); 
        }

 
        //-----------------> guardo los Compromisos <---------------

        $itemCompromiso = $request->compromiso;

        for ($x=0; $x < count($itemCompromiso["tarea"]); $x++)
        {
            $compromiso = new Compromiso;
            $compromiso->tarea          = $itemCompromiso["tarea"][$x];
            $compromiso->responsable    = $itemCompromiso["responsable"][$x];
            $compromiso->fechaEntrega   = $itemCompromiso["fechaEntrega"][$x];
            $compromiso->id_evento      = $idUltimoEvento;
            $compromiso->save();
        }

        //---------------> guardo Notificacion <--------------------

        $itemDestinatario = $request->minuta;

        //a cada destinatario le pone el color al evento segun la prioridad
        for($y=0; $y < count($itemDestinatario["integrante"]); $y++)
        {
             //segun la prioridad configuro el color
            if ($itemDestinatario["prioridad"][$y]== 0)
            {
               $color = "#008000";
            }

            if ($itemDestinatario["prioridad"][$y] == 1)
            {
                $color = "#ff8000";
            }

            if ($itemDestinatario["prioridad"][$y] == 2)
            {
                $color = "#ff0000";
            }
            
            $notifica = new Notificacion;
            $notifica->destinatario = $itemDestinatario["integrante"][$y];
            $notifica->prioridad    = $itemDestinatario["prioridad"][$y];
            $notifica->titulo       = $request->input('txtObjetivo'); //tomo del ruquest el objetivo que hace de titulo
            $notifica->leido        = 0;
            $notifica->color        = $color;
            $notifica->id_evento    = $idUltimoEvento;
            $notifica->save();
        }
             
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      // echo $id;
        $eventos = DB::table('eventos')
                    ->select('lugar', 'fecha', 'objetivo', 'asuntosTratados','asuntosSecundarios', 'observaciones', 'fechaProximaReunion')
                    ->where('id','=',$id)
                    ->get();

        $asistentes = DB::table('asistentes')
                        ->select('nombre', 'puesto')
                        ->join('eventos','eventos.id','=','asistentes.id_evento')
                        ->where('asistentes.id_evento','=',$id)
                        ->get();
        
        $compromisos = DB::table('compromisos')
                        ->select('tarea','responsable','fechaEntrega')
                        ->join('eventos','eventos.id','=','compromisos.id_evento')
                        ->where('compromisos.id_evento','=',$id)
                        ->get();

        $notificados = DB::table('notificacions')
                        ->select('destinatario')
                        ->join('users','users.name','=','notificacions.destinatario')
                        ->where('notificacions.id_evento','=',$id)
                        ->get();




        return view('evento.show', compact('eventos','asistentes','compromisos','notificados'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
