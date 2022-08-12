<?php
$usuario = auth()->user()->name;

$verEvento = DB::table('eventos')
            ->select('notificacions.destinatario as dest','id_evento as id','prioridad', 'leido', 'fechaProximaReunion as start','fechaProximaReunion as end','titulo as title','color')
            ->join('notificacions','id_evento','=','eventos.id')
            ->where('notificacions.destinatario','=', $usuario )
            ->get();
return response()->json($verEvento);

?>