@extends ('admin.base')
    
    @section('content')
    
       <div class="card">
                  <div class="card-body">
                         <div class="contenedorConMensajes"> 
                        <h2 class="card-title">Editar este planeta</h2>
                          @if (Session::has('message'))
                            <div class="alert alert-{{ session()->get('type') }}"  role="alert">
                          {{ session()->get('message') }}
                            </div>
                            @endif
                            </div>
                  
                    <form class="forms-sample" style="margin-top:0px;" action="{{ url('planeta/'. $planeta->id) }}" method="post">
                    @csrf
                      @method('put')
                      <div class="form-group" style="  margin-top: 24px; margin-bottom: 24px !important;">
                      <label style="font-size:20px;" for="exampleInputName1">Nombre</label>
                        <input required name="nombre" minlength="2" maxlength="50" style="font-size:15px !important; margin-top:4px" type="text" class="form-control" id="exampleInputName1" value="{{ old('nombre', $planeta->nombre) }}">
                        @error('nombre')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                      </div>
                       <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleInputName1">Poblacion</label>
                        <input required name="poblacion" min=0 max=99999999999999999999 style="font-size:15px !important; margin-top:4px"type="number" class="form-control" id="exampleInputName1" value="{{ old('poblacion', $planeta->poblacion) }}">
                        @error('poblacion')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                      </div>
                      <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleSelectGender">Region</label>
                        <select  required name="region" class="form-control"  style="color:white; font-size:15px !important; margin-top:4px">
                          <option value="" @if(old('region') == '') selected @endif disabled>&nbsp;</option>
                          @foreach($regiones as $region)
                                        <option  @if(old('region', $planeta->region ) == $region) selected @endif >{{ $region }}</option>
                             @endforeach
                        @error('region')
                                    <div class="alert alert-danger }}" style="width:40%;margin-top:10px;"  role="alert">
                                       {{ $message }}
                                    </div>
                        @enderror
                        </select>
                      </div>
                       <div class="contenedorBotones">
                             <button type="submit" class="btn btn-warning btn-icon-text">
                            <i class="mdi mdi-reload btn-icon-prepend"></i> Editar </button>
                        <a  href="{{ url('planeta/'. $planeta->id) }}" > <button type="button" class="btn btn-dark btn-icon-keyboard-return"><i class="mdi mdi-keyboard-tab btn-icon-append"></i> Cancelar </button></a>    
                    </div>
                    
                    </form>
                   
                    
                  </div>
                </div>
@endsection