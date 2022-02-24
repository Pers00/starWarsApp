@extends ('admin.base')
    
    @section('content')
        @if(auth()->user()->rol == 'Admin')
        <div class="modal" id="modalDelete" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Confimar eliminar usuario</h5>
                <!--<ion-icon name="close-outline" data-bs-dismiss="modal" aria-label="Close"></ion-icon> -->
              </div>
              <div class="modal-body">
                <p>¿Confirmas eliminar este usuario: "<span id="deleteItem">xxx</span>" ?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelBtn" data-dismiss="modal">Cancelar</button>
                <form id="modalDeleteResourceForm" action="" method="post">
                    @method('delete')
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Eliminar usuario"/>
                </form>
              </div>
            </div>
          </div>
        </div>
                
                
      
       <!-- Delete todos los productos ventana modal-->
            <div class="modal" id="modalDelete1" tabindex="-1">
            	<div class="modal-dialog">
            		<div class="modal-content">
            			<div class="modal-header">
            				<h3 class="modal-title">Confirmas borrar todos los usuarios</h3>
            			</div>
            			<div class="modal-body">
            				<p>¿Estas seguro de que quieres eliminar todos los usuarios?</p>
            			</div>
            			<div class="modal-footer">
            				<button type="button" class="btn btn-secondary cancelBtn" data-dismiss="modal">Cancelar</button>
            				<form id="modalDeleteResourceForm1" action="" method="post">
            					@method('delete')
            					@csrf
            					<input type="submit" class="btn btn-danger cursor" value="Eliminar todos los usuarios"/>
            				</form>
            			</div>
            		</div>
            	</div>
            </div>
                
       
     
 
                <div class="card" style="margin-bottom:30px; " >
                  <div class="card-body" style="padding-bottom:6px !important;">
                    <h3 class="card-title">Datos de la comunidad</h3>
                    <form class="form-sample" >
                      <p class="card-description" style="margin-top:12px;margin-bottom:20px!important;"> Registro de los datos actualizados de Star Wars App ( visualizacion solo para el administrador )  </p>
                      
                      <div class="row" style="align-items:center !important; margin-left:-74px;" >
                        <div class="col-md-3">
                          <div class="form-group row" >
                            <label class="col-sm-6 col-form-label" style="text-align:right;">Cantidad usuarios </label>
                              <div class="col-sm-6">
                              <input style="background-color:black"disabled value="{{ count($usuarios) }}"type="text" class="form-control">
                            </div>
                          </div>
                        </div>
                            <div class="col-md-3">
                          <div class="form-group row" >
                            <label class="col-sm-6 col-form-label" style="text-align:right;">Cantidad personajes </label>
                              <div class="col-sm-6">
                              <input style="background-color:black"disabled value="{{ count($personajes) }}"type="text" class="form-control">
                            </div>
                          </div>
                        </div>
                         <div class="col-md-3">
                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label" style="text-align:right;">Cantidad especies </label>
                            <div class="col-sm-6">
                              <input style="background-color:black"disabled value="{{ count($especies) }}"type="text" class="form-control">
                            </div>
                          </div>
                        </div>
                         <div class="col-md-3">
                          <div class="form-group row" style="text-align:left !important;">
                            <label class="col-sm-6 col-form-label" style="text-align:right;">Cantidad planetas </label>
                            <div class="col-sm-6">
                              <input style="background-color:black; margin-right:210px !important;"disabled value="{{ count($planetas) }}"type="text" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                      
             
                      
                  
                    
                   
                    </form>
                  
                  </div>
                </div>
                 
               @endif 
              
        
             <div class="card">
                  <div class="card-body">
                 <div class="contenedorConMensajes">
                    <h2 class="card-title">Comunidad</h2>
                      @if (Session::has('message'))
                    <div class="alert alert-{{ session()->get('type') }}"  role="alert">
                  {{ session()->get('message') }}
                    </div>
                     @endif
                </div>   
              
           
                  
                    
                      <table class="table" >
                         <tr class="top">
                          <td>Nº</td>
                          <td>Nombre</td>
                          <td>Email</td>
                          <td>Verificado</td>
                          <td>Rol</td>
                          <td>Mostrar</td>
                          @if(auth()->user()->rol == 'Admin')<td>Eliminar</td>@endif
                         </tr>
                     
                        <tbody >
                          @foreach($usuarios as $usuario)
                        <tr class="tr">
                            <td >{{ $loop->iteration }}</td>
                    
                            <td>{{ $usuario->name }}</td>
                            <td><i class="mdi mdi-email" style="margin-right:6px;"></i>{{ $usuario->email }}</td>
                            <td>@if ($usuario->email_verified_at=='')
                              <i class="mdi mdi-close-circle-outline"></i>
                              No
                                @else
                                <i class="mdi mdi-check-circle"></i>
                               Si
                                @endif
        
                            </td>
                            <td>{{ $usuario->rol }}</td>
                             <td><a style="color:lightblue; text-decoration:none" href="{{ url('usuario/'. $usuario->id ) }}">Mostrar</a></td>
                            @if(auth()->user()->rol == 'Admin')
                            <td>
                            
                                @if(auth()->user()->id != $usuario->id)
                                 <a style="color:lightblue; text-decoration:none"href="javascript: void(0);" data-name="{{ $usuario->name }}" data-url="{{ url('usuario/' . $usuario->id) }}" data-toggle="modal" data-target="#modalDelete">Eliminar </a>
                                  @else
                                  <i class="mdi mdi-lock"></i>
                                  Root
                                  @endif
                            </td>
                            @endif
                        </tr>
                        
                        @endforeach
                        </tbody>
                      </table>
                    
                   @if(auth()->user()->rol == 'Admin')
                <div class="contenedorBotones" style="margin-top:24px;">
                       <a  href="{{ url('usuario/create') }}" ><button type="button" class="btn btn-success btn-icon-text"> <i class="mdi mdi-file-check btn-icon-prepend"></i> Crear usuario </button></a>                
                   @if(count($usuarios) > 1)
                       <a href="javascript: void(0);" data-url="{{ url('usuario/flush/all') }}" data-toggle="modal" data-target="#modalDelete1"> <button type="button" class="btn btn-danger btn-icon-text">
                        <i class="mdi mdi-alert btn-icon-prepend"></i> Eliminar todos los usuarios </button></a>
                     @endif
                     
                   </div>
                  @endif
                  </div>
                
                </div>
                
           
                
                
               

    @endsection
   
     
    
   @section('js')
  
        <script src="{{ url('assets/jsNew/deleteElement.js') }}"></script>
        <script src="{{ url('assets/jsNew/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('assets/jsNew/deleteAll.js') }}"></script>

    @endsection
    