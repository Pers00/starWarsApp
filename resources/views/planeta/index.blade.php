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
                
                
      
       <!-- Delete todos los productos ventana modal-->
            <div class="modal" id="modalDelete1" tabindex="-1">
            	<div class="modal-dialog">
            		<div class="modal-content">
            			<div class="modal-header">
            				<h3 class="modal-title">Confirmas borrar todos los planetas</h3>
            			</div>
            			<div class="modal-body">
            				<p>¿Estas seguro de que quieres eliminar todos los planetas?</p>
            			</div>
            			<div class="modal-footer">
            				<button type="button" class="btn btn-secondary cancelBtn" data-dismiss="modal">Cancelar</button>
            				<form id="modalDeleteResourceForm1" action="" method="post">
            					@method('delete')
            					@csrf
            					<input type="submit" class="btn btn-danger cursor" value="Eliminar todos los planetas"/>
            				</form>
            			</div>
            		</div>
            	</div>
            </div>
        
        <form class="form-inline" action="{{ $rutaSearch ?? '' }}" method="get" style="margin-bottom:6px !important;">
                        <div class="form-group">
                          <i style="margin-right:-14px;"class="mdi mdi-magnify"></i>
                          <input class="ml-4 form-control" style="width:300px;!important"type="search" placeholder="Busqueda en la tabla planeta" aria-label="Search" name="search" value="{{ $appendData['search'] ?? '' }}">
                          @isset($appendData)
                              @foreach($appendData as $name => $value)
                                  @if($name != 'search')
                                      <input  type="hidden" name="{{ $name }}" value="{{ $value }}">
                                  @endif
                              @endforeach
                          @endisset
                          <button class="btn" type="submit"><i class="fe fe-search fe-16"></i></button>
                         
                          <a  href="{{ url('planeta') }}" > <button type="button" class="btn btn-info btn-icon-text">
                            <i class="mdi mdi-backup-restore btn-icon-prepend"></i> Reiniciar busqueda </button></a>
                         
                         
                            
                            
                        </div>
                        
        </form>
       
                
       <div class="card">
                  <div class="card-body">
            <div class="contenedorConMensajes">
                    <h2 class="card-title">Planetas</h2>
                      @if (Session::has('message'))
                    <div class="alert alert-{{ session()->get('type') }}"  role="alert">
                  {{ session()->get('message') }}
                    </div>
                     @endif
                </div>
       
                      <table class="table">
                     
                          <tr class="top">
                            
                            <td>
                              <a style="color:lightblue; text-decoration:none" href="{{ route('planeta.index', $ordernombreasc) }}"><i class="mdi mdi-arrow-down"></i></a> 
                            <span style="margin-right:4px; margin-left:4px">Nombre</span> 
                              <a style="color:lightblue; text-decoration:none" href="{{ route('planeta.index', $ordernombredesc) }}"><i class="mdi mdi-arrow-up"></i></a>
                            </td>
                            <td> 
                             <a style="color:lightblue; text-decoration:none" href="{{ route('planeta.index', $orderpoblacionasc) }}"><i class="mdi mdi-arrow-down"></i></a> 
                             <span style="margin-right:4px; margin-left:4px">Poblacion</span> 
                            <a style="color:lightblue; text-decoration:none" href="{{ route('planeta.index', $orderpoblacionasc) }}"><i class="mdi mdi-arrow-up"></i></a> 
                            </td>
                            <td> 
                           <a style="color:lightblue; text-decoration:none" href="{{ route('planeta.index', $orderregionasc) }}"><i class="mdi mdi-arrow-down"></i></a> 
                             <span style="margin-right:4px; margin-left:4px">Región</span> 
                            <a style="color:lightblue; text-decoration:none"href="{{ route('planeta.index', $orderregiondesc) }}"><i class="mdi mdi-arrow-up"></i></a> 
                            </td>
                            
                            <td> Mostrar</td>
                            <td> Eliminar </td>
                          </tr>
                     
                        <tbody>
                          @foreach ($planetas as $planeta)
                          <tr class="tr">
                            
                            <td>
                              {{ $planeta->nombre }}
                            </td>
                            <td>
                               
                            <i class="mdi mdi-human-handsup" style="margin-right:1px;"></i>- {{ $planeta->poblacion }}
                            </td>
                            <td> 
                                <i class=" mdi mdi-map-marker" style="margin-right:6px;"></i>{{ $planeta->region }}
                            </td>
                          
                            <td>
                              <a style="color:lightblue; text-decoration:none" href="{{ url('planeta/'. $planeta->id) }}"> Mostrar </a> 
                            </td>
                            <td> 
                               <a style="color:lightblue; text-decoration:none"href="javascript: void(0);" data-name="{{ $planeta->nombre }}" data-url="{{ url('planeta/' . $planeta->id) }}" data-toggle="modal" data-target="#modalDelete">Eliminar </a> 
                            </td>
                          </tr>
                          @endforeach
                         
                        </tbody>
                      </table>
                    
                  <div class="contenedorBotones" style="margin-top:24px;">
                       <a  href="{{ url('planeta/create') }}" ><button type="button" class="btn btn-success btn-icon-text"> <i class="mdi mdi-file-check btn-icon-prepend"></i> Crear planeta </button></a>                
                      {{ $planetas->onEachSide(1)->links() }} 
                   @if(count($planetas) > 0)
                       <a href="javascript: void(0);" data-url="{{ url('planeta/flush/all') }}" data-toggle="modal" data-target="#modalDelete1"> <button type="button" class="btn btn-danger btn-icon-text">
                        <i class="mdi mdi-alert btn-icon-prepend"></i> Eliminar todos los planetas </button></a>
                     @endif
                        
                   </div>
                  </div>
                
                </div>
                
             
 

<nav style="margin-top:30px!important;">
    <ul class="pagination" style="margin-left:0!important">
        @foreach ($rpps as $linkData)
            <li class="page-item @if($rpp == $linkData['rpp']) active @endif">
                <a style="color:lightblue; text-decoration:none" href="{{ route('planeta.index', $linkData) }}" class="page-link">{{ $linkData['rpp'] }}</a>
            </li>
        @endforeach
        <li class="page-item">
            <a href="#"style="color:lightblue; text-decoration:none" class="page-link">por pagina</a>
        </li>
    </ul>
</nav>

         
               
                        
                
                  
    
    @endsection
   
     
    
    
   @section('js')
  
        <script src="{{ url('assets/jsNew/deleteElement.js') }}"></script>
        <script src="{{ url('assets/jsNew/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('assets/jsNew/deleteAll.js') }}"></script>

    @endsection
    