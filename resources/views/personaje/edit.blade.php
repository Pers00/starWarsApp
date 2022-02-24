@extends ('admin.base')
    
    @section('content')
    
       <div class="card">
                  <div class="card-body">
                         <div class="contenedorConMensajes"> 
                        <h2 class="card-title">Editar este personaje</h2>
                          @if (Session::has('message'))
                            <div class="alert alert-{{ session()->get('type') }}"  role="alert">
                          {{ session()->get('message') }}
                            </div>
                            @endif
                            </div>
                  
                    <form class="forms-sample" style="margin-top:0px;" action="{{ url('personaje/'. $personaje->id) }}" method="post"  enctype="multipart/form-data">
                    @csrf
                      @method('put')
                       <div class="form-group" style="  margin-top: 24px; margin-bottom: 24px !important;">
                      <label style="font-size:20px;" for="exampleInputName1">Nombre</label>
                        <input value="{{ old('nombre', $personaje->nombre) }}" required name="nombre" minlength="2" maxlength="50" style="font-size:15px !important; margin-top:4px" type="text" class="form-control" id="exampleInputName1" placeholder="Escribe el nombre del personaje" value="{{ old('nombre') }}">
                        @error('nombre')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                      </div>
                    
                    <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleSelectGender">Genero</label>
                         <select required name="genero" class="form-control"  style="color:white; font-size:15px !important; margin-top:4px">
                            <option  value="" @if(old('genero') == '') selected @endif disabled>&nbsp;</option>
                            @foreach($generos as $genero)
                                <option  @if(old('genero',$personaje->genero) == $genero) selected @endif >{{ $genero }}</option>
                             @endforeach
                             @error('genero')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                        </select>
                      </div>
                      
                    <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleInputName1">Altura</label>
                        <input value="{{ old('altura', $personaje->altura) }}" required name="altura" step="0.01" min=0 max=99999999 style="font-size:15px !important; margin-top:4px"type="number" class="form-control" id="exampleInputName1" placeholder="Escribe la altura del personaje" value="{{ old('altura') }}" >
                        @error('altura')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                      </div>
                      
                    <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleInputName1">Peso</label>
                        <input value="{{ old('peso', $personaje->peso) }}" required name="peso" step="0.1" min=0 max=999999999 style="font-size:15px !important; margin-top:4px"type="number" class="form-control" id="exampleInputName1" placeholder="Escribe el peso del personaje" value="{{ old('peso') }}" >
                        @error('peso')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                      </div>
                      
                      <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleSelectGender">Epoca</label>
                        <select required name="epoca" class="form-control"  style="color:white; font-size:15px !important; margin-top:4px">
                           <option  value="" @if(old('epoca') == '') selected @endif disabled>&nbsp;</option>
                            @foreach($epocas as $epoca)
                                        <option  @if(old('epoca',  $personaje->epoca) == $epoca) selected @endif >{{ $epoca }}</option>
                             @endforeach
                             @error('epoca')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                        </select>
                      </div>
                      
                      <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleSelectGender">Especie</label>
                        <select  required name="especie" class="form-control"  style="color:white; font-size:15px !important; margin-top:4px">
                            <option  value="" @if(old('especie') == '') selected @endif disabled>&nbsp;</option>
                            @foreach($especies as $especie)
                                        <option  @if(old('especie',  $personaje->idespecie) == $especie->id) selected @endif >{{ $especie->nombre }}</option>
                             @endforeach
                        </select>
                      </div>
                      
                      <div class="form-group"  style=" margin-top: 24px!important;">
                        <label style="font-size:20px;" for="exampleSelectGender">Imagen</label>
                        
                      </div>
                       <div class="contenedorImagen3">
                    @foreach ($personajesImagen as $personajeImagen)
                           @if($personajeImagen->idpersonaje == $personaje->id)
                           <img src="{{ asset('storage/'. $idusuario .'/imagenPersonajes/'. $personaje->id . '/' . $personajeImagen->nombreArchivo) }}"></img>
                           @endif
                           @endforeach
                            <div class="contenedorEditar">
                                
                              
                            <div class="form-group" style=" ">
                                <label style="font-size:20px;">Subir imagen</label>
                                <div class="input-group col-xs-12">
                                <input  style="margin-bottom:20px; margin-top:4px;" class="file" type="file" name="photo"  accept="image/*">
                                </div>
                              </div>
                            </div>
                
                    </div>
                    
              
                   <div class="contenedorBotones" style="margin-top:28px;">
                             <button type="submit" class="btn btn-warning btn-icon-text">
                            <i class="mdi mdi-reload btn-icon-prepend"></i> Editar </button>
                        <a  href="{{ url('personaje/'. $personaje->id) }}" > <button type="button" class="btn btn-dark btn-icon-keyboard-return"><i class="mdi mdi-keyboard-tab btn-icon-append"></i> Cancelar </button></a>    
                    </div>
                    
                </div>
                      
                    
                    </form>
                   
                    
                  </div>
                  
                
@endsection