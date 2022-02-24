<?php

namespace App\Http\Controllers;

use App\Models\Personaje;
use App\Models\Especie;
use App\Models\PersonajeImagen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Http\Requests\PersonajeCreateRequest;
use App\Http\Requests\PersonajeEditRequest;

class PersonajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [];
        $planeta = [];
        $idusuario=auth()->user()->id;
        $personajes=Personaje::where('idusuario', $idusuario)->get();
        $data['personajes'] = $personajes;
        $data['idusuario']= auth()->user()->id;
        
        $especiesCount=Especie::where('idusuario', $idusuario)->get();
        $especie=Especie::all();
     
        $data['especies']=$especie;
        $data['especiesCount']=$especiesCount;
        
        $data['personajesImagen']=PersonajeImagen::all();

        return view('personaje.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
          
          $idusuario=auth()->user()->id;
        $especies = Especie::where('idusuario', $idusuario)->get();
            
        
        return view('personaje.create',['especies' => $especies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonajeCreateRequest $request)
    {
        //
       
        $especieNombre =$request->input('especie');
        $especieObtenida =Especie::where('nombre', $especieNombre)->get()->first();
        
       $personaje = new Personaje($request->all());
       
         
        try {
            $idusuario=auth()->user()->id;
            $personaje->idusuario=$idusuario;
            $personaje->idespecie=$especieObtenida->id;
            $personaje->save();//insert, update
            
            $data['message']= 'El personaje ' . $personaje->nombre . ' ha sido creado correctamente de la base de datos';
            $data['type']= 'success';

             
            if($request->hasFile('photo') && $request->file('photo')->isValid()) {
                 $archivo = $request->file('photo');
       
                $nombre = $archivo->getClientOriginalName();
                $type = $archivo->getMimeType();
                $dataImage=[];
                $dataImage['idpersonaje']= $personaje->id;
                
            
                $dataImage['nombreArchivo']= $nombre;
                $dataImage['mimetype']= $type;
                 
                 
                $personajeImagen = new PersonajeImagen($dataImage);
             
                $personajeImagen->save();
                
                
                $user=auth()->user();
                
                $data['nombre']=$nombre;
                $archivo->storeAs('public/'. $user->id .'/imagenPersonajes/'. $personaje->id , $nombre);
                
                
                
            }
        } catch(Exception $e) {
            $data['message']= 'El personaje ' . $personaje->nombre . ' no se ha podido crear de manera correcta';
            $data['type']= 'danger';
            return back()->withInput()->with($data);
        }
        
        return redirect('personaje')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personaje  $personaje
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $personaje =Personaje::where('id', $id)->get()->first();
        $especie=Especie::all(); 
        $idusuario= auth()->user()->id;
        $personajesImagen=PersonajeImagen::all();
        return view('personaje.show', ['personaje' => $personaje, 'especies'=>$especie, 'idusuario'=>$idusuario,'personajesImagen' => $personajesImagen]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personaje  $personaje
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
          
        $personaje =Personaje::where('id', $id)->get()->first();
        $idusuario=auth()->user()->id;
        $especies = Especie::where('idusuario', $idusuario)->get();
         $epocas=[
                "Era Pre-República",
                "Era de la Antigua Republica",
                "Era del Alzamiento del Imperio",
                "Era de la Rebelión",
                "Era de la Nueva República",
                "Era de la Nueva Orden Jedi",
                ];
        $generos=[
                "Masculino",
                "Femenino",
                "Desconocido",
                "No binario",
                ];
        
        $personajesImagen=PersonajeImagen::all();
        return view('personaje.edit', ['especies'=>$especies, 'personaje'=>$personaje, 'generos'=>$generos, 'epocas'=> $epocas, 'idusuario'=>$idusuario, 'personajesImagen' => $personajesImagen ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personaje  $personaje
     * @return \Illuminate\Http\Response
     */
    public function update(PersonajeEditRequest $request, $id)
    {
        //
        $especieNombre =$request->input('especie');
        $especieObtenido =Especie::where('nombre', $especieNombre)->get()->first();
       
          
        $personaje =Personaje::where('id', $id)->get()->first();
        $data = [];
   
        try {
            $personaje->idespecie=$especieObtenido->id;
          
             $data['message'] = 'El personaje ' . $personaje->nombre . ' se ha podido editar correctamente.';
            $data['type'] = 'success';
              
             if($request->hasFile('photo') && $request->file('photo')->isValid()) {
                
                $archivo = $request->file('photo');
                $nombre = $archivo->getClientOriginalName();
                $type = $archivo->getMimeType();
                $dataImage=[];
                $dataImage['idpersonaje']= $personaje->id;
                $dataImage['nombreArchivo']= $nombre;
                $dataImage['mimetype']= $type;
                      

                
                $idusuario=auth()->user()->id;
                $personajeImagen1= PersonajeImagen::where('idpersonaje', $personaje->id)->get()->first();  
                
                Storage::delete('public/'. $idusuario .'/imagenPersonajes/'. $personaje->id , $personajeImagen1->nombreArchivo) ; 
                Storage::deleteDirectory('public/'. $idusuario .'/imagenPersonajes/'. $personaje->id);
                $personajeImagen1->delete();
                
                
                $personajeImagen = new PersonajeImagen($dataImage);
                $personajeImagen->save();
                $archivo->storeAs('public/'. $idusuario .'/imagenPersonajes/'. $personaje->id , $nombre);

              }
            $personaje->update($request->all());
            
           
        } catch(Exception $e) {
            
             $data['message'] = 'El personaje ' . $personaje->nombre . ' no se ha podido editar, pruebe de nuevo.';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        $input = 'photo';
        
       
        return redirect('personaje')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personaje  $personaje
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = [];
        $personaje =Personaje::where('id', $id)->get()->first();
        $user=auth()->user();
        $data['message'] = 'El personaje ' . $personaje->nombre . ' ha sido borrado correctamente.';
        $data['type'] = 'success';
        try {
            
            $personajeImagen= PersonajeImagen::where('idpersonaje', $personaje->id)->get()->first();           
            Storage::delete('public/'. $user->id .'/imagenPersonajes/'. $personaje->id . '/' . $personajeImagen->nombreArchivo) ;
            Storage::deleteDirectory('public/'. $user->id .'/imagenPersonajes/'. $personaje->id);
                
            $personajeImagen->delete();
            $personaje->delete();
        } catch(Exception $e) {
            $data['message'] = 'El personaje '. $personaje->id . ' no ha podido ser borrado, pruebe de nuevo.';
            $data['type'] = 'danger';
        }
        return redirect('personaje')->with($data);
    }
    
     function flush(){ // 
      
         // Borrar los datos de la tabla entera
        
        // user::query()->delete();
        $data['message']= 'Has borrado todos los personajes correctamente de la BD.';
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
        return redirect('personaje')->with($data);
        
         } catch(\Exception $e) {
              $data['message']= 'No se ha podido eliminar todos los personajes de la BD.';
            $data['type']= 'danger';
            return back()->with($data);
       
        }
     }
}
