<?php

namespace App\Http\Controllers;

use App\Models\Planeta;
use App\Models\Especie;
use App\Models\Personaje;
use App\Models\PersonajeImagen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\PlanetaCreateRequest;
use App\Http\Requests\PlanetaEditRequest;

class PlanetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      private function getAllAttributes($model) {
        $columns = $model->getFillable();
        $attributes = $model->getAttributes();
        $add = array_merge(array_flip($columns), $attributes);
        $add['id'] = 0;
        return $add;
    }

    private function getRecordsPerPageArray($array) {
        $result = [];
        $rpps = $this->getRpps();
        foreach($rpps as $rpp => $value) {
            $result['rpps'][] = array_merge($array, ['rpp' =>  $rpp]);
        }
        return $result;
    }

    private function getOrderArrays($array) {
        $data = [];
        $orders = ['asc', 'desc'];
        $sorts = $this->getAllAttributes(new Planeta());
        foreach($orders as $order){
            foreach($sorts as $sortindex => $sort){
                $data['order' . $sortindex . $order] = array_merge(['sort' => $sortindex, 'order' => $order], $array);
            }
        }
        return $data;
    }

    private function getRpps() {
        return [2 => 1, 5 => 1, 10 => 1, 20 => 1];
    }

    private function verifyOrder($order) {
        if($order == null) {
            return $order;
        } elseif($order == 'desc'){
            return $order;
        }
        return 'asc';
    }

    private function verifyRpp($rpp) {
        $rpps = $this->getRpps();
        if(isset($rpps[$rpp])) {
            return $rpp;
        }
        return 10;
    }

    private function verifySort($sort) {
        /*$sorts = ['id' => 1, 'name' => 1, 'category' => 1, 'artist' => 1, 'budget' => 1];*/
        $sorts = $this->getAllAttributes(new Planeta());
        if(isset($sorts[$sort])) {
            return $sort;
        }
        return null;
    }
    
    public function index(Request $request)
    {
        
         $data=[];
        $appendData = [];
        $filterData = [];
        $rppData = [];
        $sortData = [];
        $searchData = [];
        
        $page = $request->input('page');
        $filter = $request->input('filter');
        $sort = $this->verifySort($request->input('sort'));
        $order = $this->verifyOrder($request->input('order'));
        $rpp = $this->verifyRpp($request->input('rpp'));
        $search = $request->input('search');

        if($sort != null && $order != null) {
            $sortData = ['sort' => $sort, 'order' => $order];
        }

        if($rpp != 10) {
            $rppData['rpp'] = $rpp;
        }
        
        if($search != null) {
           $searchData['search'] = $search;
        }

        $appendData = array_merge($appendData, $rppData);
        $appendData = array_merge($appendData, $sortData);
        $appendData = array_merge($appendData, $searchData);

        $data = array_merge($data, $this->getOrderArrays(array_merge($rppData, $searchData)));
        $data = array_merge($data, $this->getRecordsPerPageArray($appendData));
        $data['rpp'] = $rpp;

        
        $planeta = new Planeta();
        
      
        
        if($search != null){
            $planeta = $planeta->where('nombre', 'like', '%'. $search . '%')
            ->orWhere('id', 'like', '%'. $search . '%')
            ->orWhere('poblacion', 'like', '%'. $search . '%')
            ->orWhere('region', 'like', '%'. $search . '%');
            
    
            // ->orWhere('category', 'like', '%'. $search . '%'); poner search con especie
        }
        if($sort != null && $planeta != null){
            $planeta = $planeta->orderBy($sort, $order);
        }
       

              
        $idusuario=auth()->user()->id;
        $planeta = $planeta->where('idusuario', $idusuario);
        
        $planeta = $planeta->orderBy('id', 'asc')->paginate($rpp)->appends($appendData);
        
        $data['appendData'] = $appendData;
        $data['rutaSearch'] = route('planeta.index');
        
        $data['planetas'] = $planeta;
        
        
  
        return view('planeta.index', $data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $regiones=[
                "Nucleo profundo",
                "Mundos del Núcleo",
                "Colonias",
                "Territorios del Borde Interior",
                "Territorios del Borde Medio",
                "Territorios del Borde Exterior",
                "Regiones Desconocidas",
                ];
        return view('planeta.create', ['regiones' => $regiones]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanetaCreateRequest $request)
    {
        //
      
        $planeta = new Planeta($request->all());
          
        try {
            $data['message']= 'El planeta ' . $planeta->nombre . ' ha sido creado correctamente en la base de datos';
            $data['type']= 'success';
            $idusuario=auth()->user()->id;
            $planeta->idusuario=$idusuario;
            $planeta->save();//insert, update
        } catch(Exception $e) {
            $data['message']= 'El planeta ' . $planeta->nombre . ' no se ha podido crear de manera correcta';
            $data['type']= 'danger';
            return back()->withInput()->with($data);
        }
     
        return redirect('planeta')->with($data);
    

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Planeta  $planeta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
        $planeta =Planeta::where('id', $id)->get()->first();
        $especie =Especie::where('idplaneta', $id)->get();
        
        return view('planeta.show', ['planeta' => $planeta, 'especies' => $especie]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Planeta  $planeta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = [];
        $planeta =Planeta::where('id', $id)->get()->first();
        $regiones=[
                "Nucleo profundo",
                "Mundos del Núcleo",
                "Colonias",
                "Territorios del Borde Interior",
                "Territorios del Borde Medio",
                "Territorios del Borde Exterior",
                "Regiones Desconocidas",
                ];
        return view('planeta.edit', ['regiones' => $regiones, 'planeta'=>$planeta]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planeta  $planeta
     * @return \Illuminate\Http\Response
     */
    public function update(PlanetaEditRequest $request, $id)
    {
        //
        $planeta =Planeta::where('id', $id)->get()->first();
        $data = [];
     
        try {
            $result = $planeta->update($request->all());
               $data['message'] = 'El planeta ' . $planeta->nombre . ' se ha podido editar correctamente.';
        $data['type'] = 'success';
            //$place->fill($request->all());
            //$result = $place->save();
        } catch(Exception $e) {
            
             $data['message'] = 'El planeta ' . $planeta->nombre . ' no se ha podido editar, pruebe de nuevo.';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
      
        return redirect('planeta')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planeta  $planeta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = [];
         $planeta =Planeta::where('id', $id)->get()->first();
         $especies =Especie::where('idplaneta', $id)->get(); // array
          $user=auth()->user();
         
        $data['message'] = 'El planeta ' . $planeta->nombre . ' ha sido borrado correctamente (por tanto, las especies y personajes asociados tambien).';
        $data['type'] = 'success';
        
        try {
            
            foreach($especies as $especie){
                 $personajes =Personaje::where('idespecie', $especie->id)->get();
                 foreach($personajes as $personaje){
                    $personajeImagen= PersonajeImagen::where('idpersonaje', $personaje->id)->get()->first();           
                    Storage::delete('public/'. $user->id .'/imagenPersonajes/'. $personaje->id . '/' . $personajeImagen->nombreArchivo) ;
                    Storage::deleteDirectory('public/'. $user->id .'/imagenPersonajes/'. $personaje->id);
                        
                    $personajeImagen->delete();
                     $personaje->delete(); 
                 }
                 $especie->delete();  
            }
            $planeta->delete();
            
        } catch(Exception $e) {
            $data['message'] = 'El planeta ' . $planeta->nombre . ' no ha podido ser borrado, pruebe de nuevo.';
            $data['type'] = 'danger';
        }
        return redirect('planeta')->with($data);
    }
    
     function flush(){ // 
      
         // Borrar los datos de la tabla entera
        
        // user::query()->delete();
        $data['message']= 'Has borrado todos los planetas correctamente de la BD ( y por tanto, tambien las especies y personajes ).';
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
            $planetas= Planeta::where('idusuario', $user->id)->get();
                foreach($planetas as $planeta){
                    $planeta->delete();
                }
        
        
        return redirect('planeta')->with($data);
        
         } catch(\Exception $e) {
             
              $data['message']= 'No se ha podido eliminar todos los planetas de la BD.';
            $data['type']= 'danger';
            return back()->with($data);
       
        }
     }
}
