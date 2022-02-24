@extends ('admin.base')
    
    @section('content')
    
       <div class="card">
                  <div class="card-body">
                           <div class="contenedorConMensajes"> 
                        <h2 class="card-title">Crear un usuario</h2>
                          @if (Session::has('message'))
                            <div class="alert alert-{{ session()->get('type') }}"  role="alert">
                          {{ session()->get('message') }}
                            </div>
                            @endif
                            </div>
                    <form style="" class="forms-sample" method="post" action="{{ route('usuario.store') }}">
                     @csrf 
               
                      <div class="form-group" style="  margin-top: 24px; margin-bottom: 24px !important;">
                      <label style="font-size:20px;" for="exampleInputName1">Nombre</label>
                        <input name="name"  required autocomplete="name" autofocus minlength="2" maxlength="50" style="font-size:15px !important; margin-top:4px" type="text" class="form-control" id="exampleInputName1" value="{{ old('name') }}" placeholder="Nombre del usuario a crear" >
                        @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                      </div>
                       <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleInputName1">Email</label>
                        <input name="email" style="font-size:15px !important; margin-top:4px"type="email" min-length="6" maxlength="50"class="form-control" id="exampleInputName1"value="{{ old('email') }}"  placeholder="Correo electronico del usuario a crear">
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                      </div>
                       <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleInputName1">Contraseña</label>
                        <input name="password" min-length="6" maxlength="50"value="{{ old('password') }}"  style="font-size:15px !important; margin-top:4px"type="password" class="form-control" id="exampleInputName1" placeholder="Contraseña para el usuario que vamos a crear">
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                      </div>
               
                      
                      <div class="form-group"  style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleSelectGender">Rol</label>
                        <select  name="rol" class="form-control"  style="color:white; font-size:15px !important; margin-top:4px">
                            <option value=""  @if(old('rol')=="") selected @endif disabled>&nbsp</option>
                             @foreach($roles as $rol)
                                        <option value="{{ $rol }}" @if(old('rol') == $rol) selected @endif >{{ $rol }}</option>
                             @endforeach
                        </select>
                        @error('rol')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      
               
                            
                            
                       <div class="contenedorBotones" style="margin-top:30px;">
                           <button type="submit" class="btn btn-success btn-icon-text"> <i class="mdi mdi-file-check btn-icon-prepend"></i> Crear </button>
                        
                        <a  href="{{ url('usuario/') }}" > <button type="button" class="btn btn-dark btn-icon-keyboard-return"><i class="mdi mdi-keyboard-tab btn-icon-append"></i> Cancelar </button></a>    
                    </div>
                    
                    </form>
                   
                    
                  </div>
                </div>
@endsection