@extends ('admin.base')
    
    @section('content')
    
       <div class="card">
                  <div class="card-body">
                        <h2 class="card-title">Crear un planeta</h4>
                  
                    <form class="forms-sample"  action="{{ url('planeta') }}" method="post">
                    @csrf
      
                      <div class="form-group" style="  margin-top: 24px; margin-bottom: 24px !important;">
                      <label style="font-size:20px;" for="exampleInputName1">Nombre</label>
                        <input name="nombre" minlength="2" maxlength="50" style="font-size:15px !important; margin-top:4px" type="text" class="form-control" id="exampleInputName1" placeholder="Escribe el nombre del planeta" value="{{ old('nombre') }}" required>
                         @error('nombre')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                      </div>
                       <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleInputName1">Poblacion</label>
                        <input required name="poblacion" min=0 max=99999999999999999999 style="font-size:15px !important; margin-top:4px"type="number" class="form-control" id="exampleInputName1" placeholder="Escribe la poblacion del planeta" value="{{ old('poblacion') }}" >
                        @error('poblacion')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                      </div>
                      
                      <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleSelectGender">Region</label>
                        <select required name="region" class="form-control"  style="color:white; font-size:15px !important; margin-top:4px">
                           <option value="" @if(old('region') == '') selected @endif disabled>&nbsp;</option>
                          @foreach($regiones as $region)
                                        <option  @if(old('region') == $region) selected @endif >{{ $region }}</option>
                            @endforeach
                            @error('region')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                            @enderror
                        </select>
                      </div>
                       <div class="contenedorBotones">
                        <a  href="{{ url('planeta') }}" ><button type="submit" class="btn btn-success btn-icon-text"> <i class="mdi mdi-file-check btn-icon-prepend"></i> Crear planeta </button></a>  
                        <a  href="{{ url('planeta') }}" > <button type="button" class="btn btn-dark btn-icon-keyboard-return"><i class="mdi mdi-keyboard-tab btn-icon-append"></i> Cancelar </button></a>    
                    </div>
                    
                    </form>
                   
                    
                  </div>
                </div>
@endsection