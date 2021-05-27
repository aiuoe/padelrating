<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Schedule $schedule)
    {
        
        $id = $request->all();
        logger($id);

        $schedule = Schedule::where('user_id', '=', Auth::user()->id )->get();

        return response()->json($schedule);
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
        $data = $request->all();

        logger($data);
        // logger($data['user_id']);
        // logger($data['start']);
        // logger($data['end']);
        $hora_completa = Carbon::parse($data['start'])->addMinutes($data['minutes_start'])->addHour();
        logger($hora_completa);

        $hora =  Carbon::parse($data['end'])->addMinutes($data['minutes_start'])
                                            ->addMinutes($data['minutes_start'])
                                            ->addMinutes($data['minutes_start']);

        $schedule_count = Schedule::where([
            ['user_id', '=', $data['user_id']],
            ['start', '=', $data['start']],
        ])->count();

        logger(`Registros: {$schedule_count}`);

        if( $schedule_count == 0 ){
            $schedule = Schedule::create([
                'user_id'       => $data['user_id'],
                'start'         => $data['start'],
                'end'           => $hora ,
                'day'           => $data['day']
            ]);

            return response()->json(['success'=>'Registro Agregado']);
        }else{
            return response()->json(['error'=> 'Deberias Eliminar']);
        }

       
      

        

       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule , Request $request)
    {

        $data = $request->all();
        logger($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , Schedule $schedule)
    {
        $data = $request->all();
        $consulta = Schedule::find($data['id']);
        $consulta->delete();
        return response()->json(['success'=>'Registro Eliminado']);
        logger($data);
        logger($consulta);
    }
    

}
