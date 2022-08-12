<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Notificacion;
use App\Models\Evento;
use App\Http\Controllers\EventoController;


class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notificaciones = Notificacion::all();
        
        // return $notificaciones;
        return view('notificacion.index', compact('notificaciones'));

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario =  auth()->user()->name;

        $actualiza = DB::update(
            'update notificacions set leido = 1 where id = ?',[$id],'and destinatario = ?',[$usuario]
        );

        return redirect()->route('evento.show', $id);
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
        return $request;
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

    /**
     * Busca los eventos segun el usuario que envia datos
     * para mostrarlos en el calendario, se devuelven en formato json 
     * como info en la funcion click del calendario
     **/
    public function verEvento()
    {
        
        $usuario = auth()->user()->name;

        $verEvento = DB::table('eventos')
                    ->select('notificacions.destinatario as dest','id_evento as id','prioridad', 'leido', 'fechaProximaReunion as start','fechaProximaReunion as end','titulo as title','color')
                    ->join('notificacions','id_evento','=','eventos.id')
                    ->where('notificacions.destinatario','=', $usuario )
                    ->get();
        return response()->json($verEvento);
        
        
    }
}
