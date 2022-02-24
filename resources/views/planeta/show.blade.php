@extends ('admin.base')
    
    @section('content')
    
        <div class="modal" id="modalDelete" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Confimar eliminar planeta</h5>
                <!--<ion-icon name="close-outline" data-bs-dismiss="modal" aria-label="Close"></ion-icon> -->
              </div>
              <div class="modal-body">
                <p>¿Confirmas eliminar este planeta: "<span id="deleteItem">xxx</span>" ?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelBtn" data-dismiss="modal">Cancelar</button>
                <form id="modalDeleteResourceForm" action="" method="post">
                    @method('delete')
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Eliminar planeta"/>
                </form>
              </div>
            </div>
          </div>
        </div>
                
   
               
             <div class="card">
                  <div class="card-body">
                <div class="contenedorConMensajes">
                    <h2 class="card-title">Mostrar planeta " {{  $planeta->nombre }} "</h2>
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
                            <td> Población </td>
                            <td> Región </td>
                            <td> Nº especies</td>
                             <td>Especies </td>
                         </tr>
                        </thead>
                        <tbody >
                      
                        <tr class="show">
                            <td>{{  $planeta->nombre }}</td>
                            <td><i class="mdi mdi-human-handsup" style="margin-right:1px;"></i>- {{ $planeta->poblacion}}</td>
                            <td><i class=" mdi mdi-map-marker" style="margin-right:6px;"></i>{{ $planeta->region }}</td>
                            <td><i class="mdi mdi-content-duplicate"></i> - {{ count($especies) }}</td>
                            <td>
                            @if(count($especies) > 0)
                            <i class="mdi mdi-account-multiple-plus" style="margin-right:6px;"></i>
                             
                            @foreach($especies as $especie)
                            
                              |<a style=" margin-left:10px; margin-right:10px; color:lightblue; text-decoration:none" href="{{ url('especie/'. $especie->id) }}"> {{ $especie->nombre}} </a> 
                             
                            @endforeach
                            @else
                             <i class="mdi mdi-close-circle-outline" style="margin-right:6px;"></i>No especies
                            @endif
                            </td>
                        </tr>
                        
                   
                        </tbody>
                      </table>
                    </div>
                
                <div class="contenedorBotones" style="margin-top:24px;">
                 
                  <div>
                       <a  href="{{ url('planeta/'. $planeta->id. '/edit' ) }}"><button type="button" class="btn btn-warning btn-icon-text">
                            <i class="mdi mdi-reload btn-icon-prepend"></i> Editar </button></a>
                          
                              <a style="color:lightblue; text-decoration:none"href="javascript: void(0);" data-name="{{ $planeta->nombre }}" data-url="{{ url('planeta/' . $planeta->id) }}" data-toggle="modal" data-target="#modalDelete"> <button style="margin-left:14px;"type="button" class="btn btn-danger btn-icon-text">
                                    <i class="mdi mdi-alert btn-icon-prepend"></i> Eliminar </button> </a>
                               
                              
                            
                          
                  </div>                    
               
                     
           
     <a  href="{{url('planeta')}}" > <button type="button" class="btn btn-dark btn-icon-keyboard-return"><i class="mdi mdi-keyboard-tab btn-icon-append"></i> Volver </button></a>    
                 
                   
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
    