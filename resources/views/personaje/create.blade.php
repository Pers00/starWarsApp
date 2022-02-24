@extends ('admin.base')
    
    @section('content')
    
       <div class="card">
                  <div class="card-body">
                        <h2 class="card-title">Crear un personaje</h4>
                  
                    <form class="forms-sample"  action="{{ url('personaje') }}" method="post" enctype="multipart/form-data">
                    @csrf
                      <div class="form-group" style="  margin-top: 24px; margin-bottom: 24px !important;">
                      <label style="font-size:20px;" for="exampleInputName1">Nombre</label>
                        <input required name="nombre" minlength="2" maxlength="50" style="font-size:15px !important; margin-top:4px" type="text" class="form-control" id="exampleInputName1" placeholder="Escribe el nombre del personaje" value="{{ old('nombre') }}">
                        @error('nombre')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                      </div>
                    
                    <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleSelectGender">Genero</label>
                         <select required name="genero" class="form-control"  style="color:white; font-size:15px !important; margin-top:4px">
                          <option selected disabled></option>
                          <option style="color:white">Masculino</option>
                          <option style="color:white">Femenino</option>
                          <option style="color:white">Desconocido</option>
                          <option style="color:white">No binario</option>
                        @error('genero')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                        </select>
                      </div>
                      
                    <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleInputName1">Altura</label>
                        <input required name="altura" step="0.01" min=0 max=99999999 style="font-size:15px !important; margin-top:4px"type="number" class="form-control" id="exampleInputName1" placeholder="Escribe la altura del personaje" value="{{ old('altura') }}" >
                        @error('altura')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                      </div>
                      
                    <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleInputName1">Peso</label>
                        <input required name="peso" step="0.1" min=0 max=999999999 style="font-size:15px !important; margin-top:4px"type="number" class="form-control" id="exampleInputName1" placeholder="Escribe el peso del personaje" value="{{ old('peso') }}" >
                        @error('peso')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                      </div>
                      
                      <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleSelectGender">Epoca</label>
                        <select required name="epoca" class="form-control"  style="color:white; font-size:15px !important; margin-top:4px">
                          <option selected disabled></option>
                          <option style="color:white">Era Pre-República</option>
                          <option style="color:white">Era de la Antigua Republica</option>
                          <option style="color:white">Era  del Alzamiento del Imperio</option>
                          <option style="color:white">Era de la Rebelión</option>
                          <option style="color:white">Era de la Nueva República</option>
                          <option style="color:white">Era de la Nueva Orden Jedi</option>
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
                                        <option  @if(old('especie') == $especie) selected @endif >{{ $especie->nombre }}</option>
                             @endforeach
                        </select>
                      </div>
                      
                   
                      
                      <div class="form-group" style="margin-bottom:24px!important;  margin-top: 24px; ">
                        <label style="font-size:20px;">Subir imagen</label>
                        <div class="input-group col-xs-12">
                        <input required style="margin-bottom:20px; margin-top:4px;" class="file" type="file" name="photo"  accept="image/*">
                        </div>
                      </div>
 
                      
                      
                      
                      
                       <div class="contenedorBotones">
                        <a  href="{{ url('personaje') }}" ><button type="submit" class="btn btn-success btn-icon-text"> <i class="mdi mdi-file-check btn-icon-prepend"></i> Crear personaje</button></a>  
                        <a  href="{{ url('personaje') }}" > <button type="button" class="btn btn-dark btn-icon-keyboard-return"><i class="mdi mdi-keyboard-tab btn-icon-append"></i> Cancelar </button></a>    
                    </div>
                    
                    </form>
                   
                    
                  </div>
                </div>
@endsection

@section('js')

<!--<script src="{{ url('assets/js/file-upload.js') }}"></script>-->

@endsection