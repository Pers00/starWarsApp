@extends ('admin.base')
    
    @section('content')
    
        <div class="modal" id="modalDelete" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Confimar eliminar especie</h5>
                <!--<ion-icon name="close-outline" data-bs-dismiss="modal" aria-label="Close"></ion-icon> -->
              </div>
              <div class="modal-body">
                <p>¿Confirmas eliminar esta especie: "<span id="deleteItem">xxx</span>" ?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelBtn" data-dismiss="modal">Cancelar</button>
                <form id="modalDeleteResourceForm" action="" method="post">
                    @method('delete')
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Eliminar especie"/>
                </form>
              </div>
            </div>
          </div>
        </div>
                
   
               
             <div class="card">
                  <div class="card-body">
                <div class="contenedorConMensajes">
                    <h2 class="card-title">Mostrar especie " {{ $especie->nombre }} "</h2>
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
                            <td> Idioma </td>
                            <td> Planeta de origen </td>
                            <td> Nº personajes</td>
                             <td>Personajes </td>
                         </tr>
                        </thead>
                        <tbody >
                      
                        <tr class="show">
                            <td>  {{ $especie->nombre }}</td>
                            <td>{{ $especie->idioma }}</td>
                            <td><i style="margin-right:6px;"class="mdi mdi-earth"></i>
                                 @foreach ($planetas as $planeta)
                               @if($planeta->id == $especie->idplaneta)
                                <a style=" margin-right:10px; color:lightblue; text-decoration:none" href="{{ url('planeta/'. $planeta->id) }}"> {{  $planeta->nombre }} </a>
                                @endif
                                @endforeach
                            </td>
                            <td><i class="mdi mdi-content-duplicate"></i> - {{ count($personajes) }}</td>
                            <td>
                            @if(count($personajes) > 0)
                            <i class="mdi mdi-account-search" style="margin-right:6px;"></i>
                             
                            @foreach($personajes as $personaje)
                            
                              |<a style=" margin-left:10px; margin-right:10px; color:lightblue; text-decoration:none" href="{{ url('personaje/'. $personaje->id) }}"> {{ $personaje->nombre}} </a> 
                             
                            @endforeach
                            @else
                             <i class="mdi mdi-close-circle-outline" style="margin-right:6px;"></i>No personajes
                            @endif
                            </td>
                            
                        </tr>
                        
                   
                        </tbody>
                      </table>
                    </div>
                
                <div class="contenedorBotones" style="margin-top:24px;">
                 
                  <div>
                       <a  href="{{ url('especie/'. $especie->id. '/edit' ) }}"><button type="button" class="btn btn-warning btn-icon-text">
                            <i class="mdi mdi-reload btn-icon-prepend"></i> Editar </button></a>
                          
                        <a style="color:lightblue; text-decoration:none"href="javascript: void(0);" data-name="{{ $especie->nombre }}" data-url="{{ url('especie/' . $especie->id) }}" data-toggle="modal" data-target="#modalDelete"> <button style="margin-left:14px;"type="button" class="btn btn-danger btn-icon-text">
                                    <i class="mdi mdi-alert btn-icon-prepend"></i> Eliminar </button> </a>
                               
                              
                            
                          
                  </div>                    
               
                     
           
     <a  href="{{url('especie')}}" > <button type="button" class="btn btn-dark btn-icon-keyboard-return"><i class="mdi mdi-keyboard-tab btn-icon-append"></i> Volver </button></a>    
                 
                   
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
    