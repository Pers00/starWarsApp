@extends ('admin.base')
@section('content')
           <div class="card">
                  <div class="card-body">
                         <div class="contenedorConMensajes"> 
                        <h2 class="card-title">Editar tu perfil</h2>
                          @if (Session::has('message'))
                            <div class="alert alert-{{ session()->get('type') }}"  role="alert">
                          {{ session()->get('message') }}
                            </div>
                            @endif
                            </div>
                  
                      @error('generico')
                                    <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                 
                    <form style="margin-top:0px;"class="forms-sample"  id="useredit" action="{{ route('user.userupdate') }}" method="post" style="margin-top:-20px;">
                      @csrf 
                      @method('put')
      
                      <div class="form-group" style="  margin-top: 24px; margin-bottom: 24px !important;">
                      <label style="font-size:20px;" for="exampleInputName1">Nombre </label>
                        <input name="name" minlength="2" value="{{ $user->name }}" maxlength="50" style="font-size:15px !important; margin-top:4px" type="text" class="form-control" id="exampleInputName1" >
                          @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                      </div>
                      <div class="form-group" style="  margin-top: 24px; margin-bottom: 24px !important;">
                      <label style="font-size:20px;" for="exampleInputName2">Correo electronico</label>
                        <input name="email" value="{{ $user->email }}" minlength="2" maxlength="50" style="font-size:15px !important; margin-top:4px" type="email" class="form-control" id="exampleInputName2" placeholder="Escribe el nombre del planeta">
                         @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                          @enderror
                        
                      </div>
                      <div class="form-group" style="  margin-top: 24px; margin-bottom: 24px !important;">
                      <label style="font-size:20px;" for="exampleInputName3">Contraseña anterior</label>
                        <input name="oldpassword" minlength="2" maxlength="50" style="font-size:15px !important; margin-top:4px" type="password" class="form-control" id="oldpassword" placeholder="Escribe tu contraseña actual">
                        
                            @error('oldpassword')
                                    <div class="alert alert-danger" style="padding-top:20px padding-bottom:20px; margin:auto auto !important; margin-top:16px !important" role="alert">
                                        {{ $message }}
                                    </div>
                            @enderror
                      </div>
                      <div class="form-group" style="  margin-top: 24px; margin-bottom: 24px !important;">
                      <label style="font-size:20px;" for="exampleInputName4">Contraseña nueva</label>
                        <input name="password" minlength="2" maxlength="50" style="font-size:15px !important; margin-top:4px" type="password" class="form-control" id="password" placeholder="Escribe una nueva contraseña">
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        
                      </div>
                       <div class="form-group" style="  margin-top: 24px; margin-bottom: 24px !important;">
                        <label style="font-size:20px;" for="exampleInputName5">Confirmar contraseña</label>
                        <input name="password" minlength="2" maxlength="50" style="font-size:15px !important; margin-top:4px"type="password" class="form-control" id="password-confirm" placeholder="Repite la contraseña nueva">
                        
                        
                      </div>
                     
                       <div class="contenedorBotones">
                        <button  type="submit" id="userupdatebtn" class="btn btn-warning btn-icon-text"><i class="mdi mdi-reload btn-icon-prepend"></i> Editar </button>
                        <a  href="{{ url()->previous() }}" > <button id="userupdatebtn"type="button" class="btn btn-dark btn-icon-keyboard-return"><i class="mdi mdi-keyboard-tab btn-icon-append"></i> Cancelar </button></a>    
                    </div>
                    
                    </form>
                   
                    
                  </div>
                </div>

@endsection      

    @section('js')
    
        <script src="{{ url('assets/useredit.js') }}"></script>
       
    @endsection


