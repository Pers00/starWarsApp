@extends ('admin.base')
    
    @section('content')
    
       <div class="card">
                  <div class="card-body">
                        <h2 class="card-title">Crear una especie</h4>
                  
                    <form class="forms-sample"  action="{{ url('especie') }}" method="post">
                    @csrf
                      <div class="form-group" style="  margin-top: 24px; margin-bottom: 24px !important;">
                      <label style="font-size:20px;" for="exampleInputName1">Nombre</label>
                        <input required name="nombre" minlength="2" maxlength="50" style="font-size:15px !important; margin-top:4px" type="text" class="form-control" id="exampleInputName1" placeholder="Escribe el nombre de la especie" value="{{ old('nombre') }}">
                        @error('nombre')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                      </div>
                      
                      <div class="form-group" style="  margin-top: 24px; margin-bottom: 24px !important;">
                      <label style="font-size:20px;" for="exampleInputName1">Idioma</label>
                        <input required name="idioma" minlength="2" maxlength="50" style="font-size:15px !important; margin-top:4px" type="text" class="form-control" id="exampleInputName1" placeholder="Escribe la poblacion de la especie" value="{{ old('idioma') }}">
                        @error('idioma')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                      </div>
                      
                      <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleSelectGender">Planeta</label>
                        <select  required name="planeta" class="form-control"  style="color:white; font-size:15px !important; margin-top:4px">
                            <option  value="" @if(old('planeta') == '') selected @endif disabled>&nbsp;</option>
                            @foreach($planetas as $planeta)
                                        <option  @if(old('planeta') == $planeta) selected @endif >{{ $planeta->nombre }}</option>
                             @endforeach
                        </select>
                      </div>
                       <div class="contenedorBotones">
                        <a  href="{{ url('especie') }}" ><button type="submit" class="btn btn-success btn-icon-text"> <i class="mdi mdi-file-check btn-icon-prepend"></i> Crear especie </button></a>  
                        <a  href="{{ url('especie') }}" > <button type="button" class="btn btn-dark btn-icon-keyboard-return"><i class="mdi mdi-keyboard-tab btn-icon-append"></i> Cancelar </button></a>    
                    </div>
                    
                    </form>
                   
                    
                  </div>
                </div>
@endsection