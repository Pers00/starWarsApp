<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;
use App\Models\Especie;
use App\Models\Personaje;
use App\Models\Planeta;
use Illuminate\Support\Facades\Hash;
use App\Models\PersonajeImagen;
use Illuminate\Support\Facades\Storage;
use Carbon;
use App\Http\Requests\ComunidadCreateRequest;
use App\Http\Requests\ComunidadEditRequest;
use App\Http\Requests\UsuarioEditRequest;

class UsuarioController extends Controller
{
    public function __construct() {
        $this->middleware('verified',['only' => ['userupdate', 'useredit']] );
        $this->middleware('userAdmin', ['except' => ['userupdate', 'useredit']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    $data = ['usuarios' => User::all(),
    'planetas' => Planeta::all(), 
    'personajes' => Personaje::all(), 
    'especies' => Especie::all() ];
    
        return view ('comunidad.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
  
          return view('comunidad.create', ['roles' => ['Admin', 'Jedi', 'Padawan']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComunidadCreateRequest $request)
    {
      
         // creamos usuario, haseamos, y notificacion de email
        $user = new User ($request->all());
        $user->password = Hash::make($request->input('password'));
  
        try{
            $user->save();
            $data=[];
            $data['message']= 'El usuario ' . $user->name . ' ha sido creado correctamente de la base de datos';
            $data['type']= 'success';
    
        }catch (\Exception $e){
        $data=[];
        $data['message']= 'El usuario ' . $user->name . ' no se ha podido crear de manera correcta';
        $data['type']= 'danger';
        return back()->withInput()->with($data);   
        }
         return redirect('usuario')->with($data);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data=[];
      
        $user =User::where('id', $id)->get()->first();
        $planetas=Planeta::where('idusuario', $id)->get();
        $personajes=Personaje::where('idusuario', $id)->get();
        $especies=Especie::where('idusuario', $id)->get();
        
        $data =['usuario'=> $user,
        'planetas' => $planetas,
        'personajes' => $personajes,
        'especies' => $especies,
        ];
        
        return view ('comunidad.show', $data);
        
        

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
        $user =User::where('id', $id)->get()->first();
  
          return view('comunidad.edit', ['roles' => ['Admin', 'Jedi', 'Padawan'], 'usuario'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ComunidadEditRequest $request, $id)
    {
        //
        
        $user =User::where('id', $id)->get()->first();
          if ($request->password == null){
        
            $dataInfo = $request->except(['password']);
        }else{
            $dataInfo = $request->all();
            $dataInfo['password'] = Hash::make($request->input('password'));
        }
        $data=[];
        $data['message']= 'El usuario ' . $user->name . ' ha sido editado correctamente de la base de datos';
        $data['type']= 'success';
      
        try{
         
            $user->update($dataInfo); 
            
        } catch (\Exception $e) {
            $data['message']= 'El usuario ' . $user->name . ' no se ha podido editar de manera correcta';
            $data['type']= 'danger';
            return back()->withInput()->with($data);  
        }
        return redirect('usuario')->with($data);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function destroy($id)
    {

        $user =User::where('id', $id)->get()->first();
 
        $data=[];
        $data['message']= 'El usuario ' . $user->name . ' ha sido eliminado correctamente de la base de datos';
        $data['type']= 'success';
        //$id=0;
        try{
           $personajes= Personaje::where('idusuario', $user->id)->get();
              
                foreach($personajes as $personaje){
                    $personajeImagen= PersonajeImagen::where('idpersonaje', $personaje->id)->get()->first();           
                    Storage::delete('public/'. $user->id .'/imagenPersonajes/'. $personaje->id . '/' . $personajeImagen->nombreArchivo) ;
                    Storage::deleteDirectory('public/'. $user->id .'/imagenPersonajes/'. $personaje->id);
                    Storage::deleteDirectory('public/'. $user->id .'/imagenPersonajes' );
                    Storage::deleteDirectory('public/'. $user->id );
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
            // Actualizar todas las IDS a 0
          //  user::where('iddepartamento', $user->id)->update(['iddepartamento'=>$id]);
           
            $user->delete();    
            
        }catch (\Exception $e){
            $data['message']= 'El usuario ' . $user->name . ' no se ha podido eliminar de la base de datos';
            $data['type']= 'danger';
        }
        
        
        return redirect('usuario')->with($data);
    }
    
     public function useredit()
    {
        return view('auth.usuario.useredit',['user'=>auth()->user()]);
    }    
    
     public function userupdate(UsuarioEditRequest $request)
    {
        // si estan vacias, se meten en el else if

        if($request->password !=null && $request->oldpassword != null){
            //  comprobamos si son iguales la oldcontraseña con la contraseña de nuestra cuenta
             $r = Hash::check($request->oldpassword, auth()->user()->password);
            if($r) {
                // metodo para guardar el usuario (cambiando la contraseña, por eso true)
                $result = $this -> userSave($request, true);
            }else {
               //  error
            //   dd('estoy aqui');
               return back()->withErrors(['oldpassword' => 'La clave de acceso anterior no es correcta']);
            }
            // cambiar todo salvo clave (dejas los dos campos vacios)
        }elseif($request->password==null && $request->oldpassword == null){
            $result = $this->userSave($request, false);
        }else {
        return back()->withInput()->withErrors(['generico' => 'Se han de introducir las claves de acceso o no']);
        }
        // si todo se ha hecho bien 
        if($result){
            $data = ['message' => 'Has editado tu usuario correctamente', 'type'=>'success'];
              $data['type']= 'success';
        // si ha sido false
        } else{
            $data = ['message' => 'No se ha podido editar tu usuario, intentelo de nuevo', 'type'=>'danger'];
          $data['type']= 'danger';
        }
        return redirect('usuarioEdit')->with($data);
    }
    
     private function userSave(Request $request, $isNewPassword){
        $result = true;
        $user = auth()->user();
        // guardamos el nombrea
        $user -> name = $request->input('name'); // $request->name
        if($user->email != $request->input('email')){ // comprobamos que el email es distinto
            $user->email = $request->input('email'); //si es distinto, lo cambiamos
            //anular la fecha de verificacion
            $user->email_verified_at = null; // ponemos que ese correo no esta verificado
            
        }
        if($isNewPassword){
            $user->password = Hash::make($request->input('password'));
        }
        try{
            $user->save();
            // enviar directamente la notificacion, sin pasar por una pagina y un boton
            $user->sendEmailVerificationNotification();
            
        }catch(\Exception $e){
            $result = false;
        }
        return $result;
    }
    
     function flush(){ // 
      
         // Borrar los datos de la tabla entera
        
        // user::query()->delete();
        $data['message']= 'Has borrado todos los usuarios correctamente de la Star Wars App';
        $data['type']= 'success';
        try{
        $users = User::where('rol', '<>', 'admin')->get();
        
        foreach($users as $user){
            
            $personajes= Personaje::where('idusuario', $user->id)->get();
                foreach($personajes as $personaje){
                    $personajeImagen= PersonajeImagen::where('idpersonaje', $personaje->id)->get()->first();           
                    Storage::delete('public/'. $user->id .'/imagenPersonajes/'. $personaje->id . '/' . $personajeImagen->nombreArchivo) ;
                    Storage::deleteDirectory('public/'. $user->id .'/imagenPersonajes/'. $personaje->id);
                    Storage::deleteDirectory('public/'. $user->id .'/imagenPersonajes' );
                    Storage::deleteDirectory('public/'. $user->id );
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
        $user->delete();            
         }
        return redirect('usuario')->with($data);
         } catch(\Exception $e) {
             dd($e);
              $data['message']= 'No se ha podido eliminar todos los usuarios de la Star Wars App';
            $data['type']= 'danger';
            return back()->with($data);
       
        }
     }
         
}
