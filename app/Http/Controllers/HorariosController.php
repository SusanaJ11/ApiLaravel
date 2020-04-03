<?php


namespace App\Http\Controllers;

use App\horario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Transformers\HorariossTransformers;
use App\Http\Controllers\ApiController;

class HorariosController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horarios = horario::all();
     return $horarios;
        return $this->showAll($horarios);
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
        $reglas = [
            'hora_h' => 'required',
            'color' => 'required'
        ];

        
        $this->validate($request, $reglas);

/*
        
*/
       $horarios = horario::create($horarios);

        return $this->showOne($horarios, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $horarios = horario::findOrfail($id);
        
        return $this->showOne($horarios);
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
        $horarios = horario::findOrfail($id);
        $reglas = [        
            
        ];

  $this->validate($request, $reglas);

            if ($request->has('hora_h')){
                $horarios->hora_m =$request->hora_h;
            }
 
            if ($request->has('color')){
                $horarios->color =$request->color;
            }
            
        
        if (!$horarios->isDirty()){
            return response()->json(['error'=>'Se debe especificar al menos un valor diferente para actualizar','code' => 422],422); }

        $horarios->save();
        return response()->json(['data'=> $horarios,200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $horarios = horario::findOrfail($id);
        $horarios->delete();
        
        return $this->showOne($horarios);
    }
}

