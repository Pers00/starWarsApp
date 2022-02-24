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
                
                
      
       <!-- Delete todos los productos ventana modal-->
            <div class="modal" id="modalDelete1" tabindex="-1">
            	<div class="modal-dialog">
            		<div class="modal-content">
            			<div class="modal-header">
            				<h3 class="modal-title">Confirmas borrar todas las especies</h3>
            			</div>
            			<div class="modal-body">
            				<p>¿Estas seguro de que quieres eliminar todas las especies?</p>
            			</div>
            			<div class="modal-footer">
            				<button type="button" class="btn btn-secondary cancelBtn" data-dismiss="modal">Cancelar</button>
            				<form id="modalDeleteResourceForm1" action="" method="post">
            					@method('delete')
            					@csrf
            					<input type="submit" class="btn btn-danger cursor" value="Eliminar todas las especies"/>
            				</form>
            			</div>
            		</div>
            	</div>
            </div>
            
            

        
    
       <div class="card">
                  <div class="card-body">
            <div class="contenedorConMensajes">
                    <h2 class="card-title">Especies</h2>
                      @if (Session::has('message'))
                    <div class="alert alert-{{ session()->get('type') }}"  role="alert">
                  {{ session()->get('message') }}
                    </div>
                     @endif
                </div>
       

                      <table class="table">
                     
                          <tr class="top">
                            <td> 
                            Nº 
                            </td>
                            <td> 
                              Nombre 
                   
                            </td>
                            <td>
                            
                            Idioma 
                            
                            </td>
                            <td>
                            
                            Planeta de origen 
                          
                            </td>
                 
                            <td> Mostrar</td>
                            <td> Eliminar </td>
                          </tr>
                     
                        <tbody>
                          @foreach ($especies as $especie)
                          <tr class="tr">
                            <td class="py-1">
                              {{  $loop->iteration }}
                            </td>
                            <td>
                              {{ $especie->nombre }}
                            </td>
                            <td>
                               {{ $especie->idioma }}
                            </td>
                            <td> 
                               <i style="margin-right:6px;"class="mdi mdi-earth"></i>
                               @foreach ($planetas as $planeta)
                                
                               @if($planeta->id == $especie->idplaneta)
                                <a style=" margin-right:10px; color:lightblue; text-decoration:none" href="{{ url('planeta/'. $planeta->id) }}"> {{  $planeta->nombre }} </a>
                                @endif
                                
                                @endforeach
                            </td>
                          
                            <td>
                              <a style="color:lightblue; text-decoration:none" href="{{ url('especie/'. $especie->id) }}"> Mostrar </a> 
                            </td>
                            <td> 
                               <a style="color:lightblue; text-decoration:none"href="javascript: void(0);" data-name="{{ $especie->nombre }}" data-url="{{ url('especie/' . $especie->id) }}" data-toggle="modal" data-target="#modalDelete">Eliminar </a> 
                            </td>
                          </tr>
                          @endforeach
                         
                        </tbody>
                      </table>
                    
                  <div class="contenedorBotones" style="margin-top:24px;">
                        @if(count($planetasCount) >= 1)
                       <a  href="{{ url('especie/create') }}" ><button type="button" class="btn btn-success btn-icon-text"> <i class="mdi mdi-file-check btn-icon-prepend"></i> Crear especie </button></a>                
                         @else
                         <button type="button" class="btn btn-danger btn-icon-text">
                        <i class="mdi mdi-alert btn-icon-prepend"></i> No puede crear especies, no hay planetas </button>
                         @endif
                   @if(count($especies) > 1)
                       <a href="javascript: void(0);" data-url="{{ url('especie/flush/all') }}" data-toggle="modal" data-target="#modalDelete1"> <button type="button" class="btn btn-danger btn-icon-text">
                        <i class="mdi mdi-alert btn-icon-prepend"></i> Eliminar todos las especies </button></a>
                     @endif
                     
                   </div>
                  </div>
                 
                
                </div>
                
             
                        
                
                  
    
    @endsection
   
     
    
    
   @section('js')
  
        <script src="{{ url('assets/jsNew/deleteElement.js') }}"></script>
        <script src="{{ url('assets/jsNew/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('assets/jsNew/deleteAll.js') }}"></script>

    @endsection
    