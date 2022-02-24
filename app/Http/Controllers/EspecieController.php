<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Planeta;
use App\Models\Personaje;
use App\Models\PersonajeImagen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Http\Requests\EspecieCreateRequest;
use App\Http\Requests\EspecieEditRequest;

class EspecieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    
    public function index(Request $request)
    {

        $idusuario=auth()->user()->id;
        $especies=Especie::where('idusuario', $idusuario)->get();
        
        
        $data['especies'] = $especies;
         
         $planetasCount=Planeta::where('idusuario', $idusuario)->get();
         
        $planeta = [];
        
       
        $planeta=Planeta::all();
        $data['planetas']=$planeta;
        $data['planetasCount'] = $planetasCount;
        return view('especie.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idusuario=auth()->user()->id;
        $planetas = Planeta::where('idusuario', $idusuario)->get();
        
        return view('especie.create',['planetas' => $planetas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EspecieCreateRequest $request)
    {
        //
        
        $planetaNombre =$request->input('planeta');
        $planetaObtenido =Planeta::where('nombre', $planetaNombre)->get()->first();
        
        $especie = new Especie($request->all());
        
        try {
            $data['message']= 'La especie ' . $especie->nombre . ' ha sido creado correctamente de la base de datos';
            $data['type']= 'success';
            $idusuario=auth()->user()->id;
            $especie->idusuario=$idusuario;
            $especie->idplaneta=$planetaObtenido->id;
            $especie->save();//insert, update
            
        } catch(Exception $e) {
            $data['message']= 'La especie ' . $especie->nombre . ' no se ha podido crear de manera correcta';
            $data['type']= 'danger';
            return back()->withInput()->with($data);
        }
        
        return redirect('especie')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $especie =Especie::where('id', $id)->get()->first();
        $planetas =Planeta::where('id', $especie->idplaneta)->get();      
        $personajes =Personaje::where('idespecie', $especie->id)->get();      
     
        
     
        
        return view('especie.show', ['especie' => $especie, 'planetas'=>$planetas, 'personajes' => $personajes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = [];
        $especie =Especie::where('id', $id)->get()->first();
        $idusuario=auth()->user()->id;
        $planetas = Planeta::where('idusuario', $idusuario)->get();
        return view('especie.edit', ['planetas'=>$planetas, 'especie'=>$especie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function update(EspecieEditRequest $request, $id)
    {
        //
        
        $planetaNombre =$request->input('planeta');
        $planetaObtenido =Planeta::where('nombre', $planetaNombre)->get()->first();
       
          
        $especie =Especie::where('id', $id)->get()->first();
        $data = [];
   
        try {
            $especie->idplaneta=$planetaObtenido->id;
            $especie->update($request->all());
             $data['message'] = 'La especie ' . $especie->nombre . ' se ha podido editar correctamente.';
            $data['type'] = 'success';
           
        } catch(Exception $e) {
            
             $data['message'] = 'La especie ' . $especie->nombre . ' no se ha podido editar, pruebe de nuevo.';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
      
        return redirect('especie')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
          $data = [];
         $especie =Especie::where('id', $id)->get()->first();
         $personajes =Personaje::where('idespecie', $id)->get();
              $user=auth()->user();
        $data['message'] = 'La especie ' . $especie->nombre . ' ha sido borrado correctamente  (por tanto, los personajes asociados tambien).';
        $data['type'] = 'success';
        try {
            foreach($personajes as $personaje){
                $personajeImagen= PersonajeImagen::where('idpersonaje', $personaje->id)->get()->first();           
                    
                    Storage::delete('public/'. $user->id .'/imagenPersonajes/'. $personaje->id . '/' . $personajeImagen->nombreArchivo) ;
                    Storage::deleteDirectory('public/'. $user->id .'/imagenPersonajes/'. $personaje->id);
                    
                $personajeImagen->delete();
                $personaje->delete();
            }
            $especie->delete();
        } catch(Exception $e) {
            $data['message'] = 'La especie '. $especie->nombre . ' no ha podido ser borrado, pruebe de nuevo.';
            $data['type'] = 'danger';
        }
        return redirect('especie')->with($data);
    }
    
    function flush(){ // 
      
         // Borrar los datos de la tabla entera
        
        // user::query()->delete();
        $data['message']= 'Has borrado todas las especies correctamente de la BD (y por tanto, tambien los personajes) . ';
        $data['type']= 'success';
        $user=auth()->user();
        try{
         $personajes= Personaje::where('idusuario', $user->id)->get();
                foreach($personajes as $personaje){
                     $personajeImagen= PersonajeImagen::where('idpersonaje', $personaje->id)->get()->first();           
                    Storage::delete('public/'. $user->id .'/imagenPersonajes/'. $personaje->id . '/' . $personajeImagen->nombreArchivo) ;
                    Storage::deleteDirectory('public/'. $user->id .'/imagenPersonajes/'. $personaje->id);
                        
                    $personajeImagen->delete();
                    $personaje->delete();
                }
            $especies= Especie::where('idusuario', $user->id)->get();
                
                foreach($especies as $especie){
                    
                    $especie->delete();
                }
        
        return redirect('especie')->with($data);
        
         } catch(\Exception $e) {
              $data['message']= 'No se ha podido eliminar todos las especies de la BD.';
            $data['type']= 'danger';
            return back()->with($data);
       
        }
     }
}
