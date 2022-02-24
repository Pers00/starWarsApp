@extends ('admin.base')
    
    @section('content')
    
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
                
   
               
             <div class="card">
                  <div class="card-body">
                <div class="contenedorConMensajes">
                    <h2 class="card-title">Mostrar usuario</h2>
                      @if (Session::has('message'))
                    <div class="alert alert-{{ session()->get('type') }}"  role="alert">
                  {{ session()->get('message') }}
                    </div>
                    @endif
                </div>  
        
               
                    <div class="table-responsive">
                      <table class="table" >
                         <tr class="topShow" >
                          <td>#id</td>
                          <td>Nombre</td>
                          <td>Email</td>
                          <td>Verificado</td>
                          <td>Rol</td>
                       
                          <td>Nº Planetas</td>
                          <td>Nº Especies</td>
                          <td>Nº Personajes</td>
                         </tr>
                        </thead>
                        <tbody >
                      
                        <tr class="show">
                            <td>{{ $usuario->id }}</td>
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
                          
                             <td><i class="mdi mdi-content-duplicate"></i> - {{ count($planetas) }}</td>
                             <td><i class="mdi mdi-content-duplicate"></i> - {{ count($especies) }}</td>
                             <td><i class="mdi mdi-content-duplicate"></i> - {{ count($personajes) }}</td>
                            
                        </tr>
                        
                   
                        </tbody>
                      </table>
                    </div>
                
                <div class="contenedorBotones" style="margin-top:24px;">
                  @if(auth()->user()->rol == 'Admin')
                  <div>
                       <a  href="{{ url('usuario/'. $usuario->id. '/edit' ) }}"><button type="button" class="btn btn-warning btn-icon-text">
                            <i class="mdi mdi-reload btn-icon-prepend"></i> Editar </button></a>
                          
                            @if(auth()->user()->id != $usuario->id)
                              <a style="color:lightblue; text-decoration:none"href="javascript: void(0);" data-name="{{ $usuario->name }}" data-url="{{ url('usuario/' . $usuario->id) }}" data-toggle="modal" data-target="#modalDelete"> <button style="margin-left:14px;"type="button" class="btn btn-danger btn-icon-text">
                                    <i class="mdi mdi-alert btn-icon-prepend"></i> Eliminar </button> </a>
                                  @else
                              
                                    <button style="margin-left:14px;"type="button"disabled class="btn btn-danger btn-icon-text">
                                     <i class="mdi mdi-lock"></i> Root </button>
                                  @endif
                          
                  </div>                    
                  @endif
                     
           
     <a  href="{{url('usuario')}}" > <button type="button" class="btn btn-dark btn-icon-keyboard-return"><i class="mdi mdi-keyboard-tab btn-icon-append"></i> Volver </button></a>    
                 
                   
                   </div> 
                  </div>
                
                </div>

    @endsection
   
     
    
   @section('js')
    <!-- nuevo 4  conectarJs-->
        <script src="{{ url('assets/jsNew/deleteElement.js') }}"></script>
        <script src="{{ url('assets/jsNew/bootstrap.bundle.min.js') }}"></script>
        
    <!-- fin nuevo 4 -->
    @endsection
    