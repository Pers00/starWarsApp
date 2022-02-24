@extends ('admin.base')
    
    @section('content')
    
        <div class="modal" id="modalDelete" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Confimar eliminar personaje</h5>
                <!--<ion-icon name="close-outline" data-bs-dismiss="modal" aria-label="Close"></ion-icon> -->
              </div>
              <div class="modal-body">
                <p>¿Confirmas eliminar este personaje: "<span id="deleteItem">xxx</span>" ?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelBtn" data-dismiss="modal">Cancelar</button>
                <form id="modalDeleteResourceForm" action="" method="post">
                    @method('delete')
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Eliminar personaje"/>
                </form>
              </div>
            </div>
          </div>
        </div>
                
   
               
             <div class="card">
                  <div class="card-body">
                <div class="contenedorConMensajes">
                    <h2 class="card-title">Mostrar personaje " {{ $personaje->nombre }} "</h2>
                      @if (Session::has('message'))
                    <div class="alert alert-{{ session()->get('type') }}"  role="alert">
                  {{ session()->get('message') }}
                    </div>
                    @endif
                </div>  
        
                    <div class="table-responsive">
                      <table class="table" >
                         <tr class="topShow" >
                            <td> Nombre </td>
                            <td> Genero </td>
                            <td> Altura </td>
                            <td> Peso </td>
                             <td> Epoca </td>
                             <td> Especie </td>
                         </tr>
                        </thead>
                        <tbody >
                      
                        <tr class="show">
                            <td>  {{ $personaje->nombre }}</td>
                            <td><i class="mdi mdi-account-outline" style="margin-right:6px;"></i> {{ $personaje->genero }}</td>
                            <td><i class="mdi mdi-table-row-height" style="margin-right:6px;"></i>- {{ $personaje->altura }}</td>
                            <td><i class="mdi mdi-format-line-weight" style="margin-right:6px;"></i>- {{ $personaje->peso }}</td>
                            <td><i class=" mdi mdi-map-marker" style="margin-right:6px;"></i>{{ $personaje->epoca }}</td>
                            <td><i class="mdi mdi-account-multiple-plus" style="margin-right:6px;"></i>
                                 @foreach ($especies as $especie)
                               @if($especie->id == $personaje->idespecie)
                                <a style=" margin-left:10px; margin-right:10px; color:lightblue; text-decoration:none" href="{{ url('especie/'. $especie->id) }}"> {{ $especie->nombre}} </a> 
                                @endif
                                @endforeach
                            </td>
                        </tr>
                        
                   
                        </tbody>
                      </table>
                    </div>
                
                <div class="contenedorBotones" style="margin-top:24px;">
                 
                  <div>
                       <a  href="{{ url('personaje/'. $personaje->id. '/edit' ) }}"><button type="button" class="btn btn-warning btn-icon-text">
                            <i class="mdi mdi-reload btn-icon-prepend"></i> Editar </button></a>
                          
                        <a style="color:lightblue; text-decoration:none"href="javascript: void(0);" data-name="{{ $personaje->nombre }}" data-url="{{ url('personaje/' . $personaje->id) }}" data-toggle="modal" data-target="#modalDelete"> <button style="margin-left:14px;"type="button" class="btn btn-danger btn-icon-text">
                                    <i class="mdi mdi-alert btn-icon-prepend"></i> Eliminar </button> </a>
                               
                              
                            
                          
                  </div>                    
               
                     
           
     <a  href="{{url('especie')}}" > <button type="button" class="btn btn-dark btn-icon-keyboard-return"><i class="mdi mdi-keyboard-tab btn-icon-append"></i> Volver </button></a>    
                 
                   
                   </div> 
                  </div>
                
                </div>
                   <div class="col-3 grid-margin" style="margin-top:32px; padding:0!important">
            <div class="card">
                  <div class="contenedorImagen">
                    @foreach ($personajesImagen as $personajeImagen)
                           @if($personajeImagen->idpersonaje == $personaje->id)
                           <img src="{{ asset('storage/'. $idusuario .'/imagenPersonajes/'. $personaje->id . '/' . $personajeImagen->nombreArchivo) }}"></img>
                           @endif
                             @endforeach
                    </div>
                    <span style="margin-top:24px; margin-bottom:22px; text-align:center; font-size:30px;">{{ $personaje->nombre }}</span>
                   
                </div>
            </div>

    @endsection
   
     
    
   @section('js')
    <!-- nuevo 4  conectarJs-->
        <script src="{{ url('assets/jsNew/deleteElement.js') }}"></script>
        <script src="{{ url('assets/jsNew/bootstrap.bundle.min.js') }}"></script>
        
    <!-- fin nuevo 4 -->
    @endsection
    