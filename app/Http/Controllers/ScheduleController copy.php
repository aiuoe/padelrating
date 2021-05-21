<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // // $disponibilidad_array = json_encode($data['turn']);
        // $serializedArr = 'Hola Mundo';
        
         logger($data);
         logger($data['user_id']);
         logger($data['start']);
         logger($data['end']);
         logger($data['hour']);

         $schedule = Schedule::create([
             'user_id' => $data['user_id'],
             'start' => $data['start'],
             'end' => $data['end'],
             'hour' => $data['hour'],
         ]);

        // $horarios = new Schedule;
        // $horarios->fecha = $data['fecha'];
        // $horarios->dia = $data['dia'];
        // $horarios->created_at = Carbon::now();
        // $horarios->updated_at = Carbon::now();
        // $horarios->save();

        // $notification = 'Hora Guardada';
	    // return back()->with(compact('notification'));

        // Schedule::updateOrCreate(
        //     [
        //         'user_id' => $data['usuario_id'],
        //         'fecha' => $data['fecha']
        //     ], 
        //     [
        //         'dia'            =>  $data['dia'],
        //         'disponibilidad' =>  (string)json_encode($data['turn'])
        //     ]
        // );

        // $notification = 'Hora Guardada';
	    // return back()->with(compact('notification'));
        
        if ($schedule) {

            // Store Data in DATABASE from HERE 

            return response()->json(['success'=>'Added new records.']);
            
        }

        return response()->json(['error'=> 'Added new records.']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
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
    public function destroy(Schedule $schedule)
    {
        //
    }

}
