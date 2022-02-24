@extends ('admin.base')
    
    @section('content')
    
       <div class="card">
                  <div class="card-body">
                         <div class="contenedorConMensajes"> 
                        <h2 class="card-title">Editar esta especie</h2>
                          @if (Session::has('message'))
                            <div class="alert alert-{{ session()->get('type') }}"  role="alert">
                          {{ session()->get('message') }}
                            </div>
                            @endif
                            </div>
                  
                    <form class="forms-sample" style="margin-top:0px;" action="{{ url('especie/'. $especie->id) }}" method="post">
                    @csrf
                      @method('put')
                      <div class="form-group" style="  margin-top: 24px; margin-bottom: 24px !important;">
                      <label style="font-size:20px;" for="exampleInputName1">Nombre</label>
                        <input required name="nombre" minlength="2" maxlength="50" style="font-size:15px !important; margin-top:4px" type="text" class="form-control" id="exampleInputName1" value="{{ old('nombre', $especie->nombre) }}">
                        @error('nombre')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                      </div>
                      <div class="form-group" style="  margin-top: 24px; margin-bottom: 24px !important;">
                       <label style="font-size:20px;" for="exampleInputName1">Idioma</label>
                        <input required name="idioma" minlength="2" maxlength="50" style="font-size:15px !important; margin-top:4px" type="text" class="form-control" id="exampleInputName1" value="{{ old('idioma', $especie->idioma) }}">
                        @error('idioma')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                      </div>
                       
                      <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleSelectGender">Planeta de origen</label>
                        <select required name="planeta" class="form-control"  style="color:white; font-size:15px !important; margin-top:4px">
                            <option value="" @if(old('planeta',$especie->idplaneta) == '') selected @endif disabled>&nbsp;</option>
                            @foreach($planetas as $planeta)
                                        <option  @if(old('planeta', $especie->planeta ) == $planeta) selected @endif >{{ $planeta->nombre }}</option>
                             @endforeach
                        </select>
                      </div>
                       <div class="contenedorBotones">
                             <button type="submit" class="btn btn-warning btn-icon-text">
                            <i class="mdi mdi-reload btn-icon-prepend"></i> Editar </button>
                        <a  href="{{ url('especie/'. $especie->id) }}" > <button type="button" class="btn btn-dark btn-icon-keyboard-return"><i class="mdi mdi-keyboard-tab btn-icon-append"></i> Cancelar </button></a>    
                    </div>
                    
                    </form>
                   
                    
                  </div>
                 </div>
                
                
@endsection