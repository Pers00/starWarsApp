@extends ('admin.basePersonaje')
    
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
                
                
      
       <!-- Delete todos los productos ventana modal-->
            <div class="modal" id="modalDelete1" tabindex="-1">
            	<div class="modal-dialog">
            		<div class="modal-content">
            			<div class="modal-header">
            				<h3 class="modal-title">Confirmas borrar todos los personajes</h3>
            			</div>
            			<div class="modal-body">
            				<p>¿Estas seguro de que quieres eliminar todos los personajes?</p>
            			</div>
            			<div class="modal-footer">
            				<button type="button" class="btn btn-secondary cancelBtn" data-dismiss="modal">Cancelar</button>
            				<form id="modalDeleteResourceForm1" action="" method="post">
            					@method('delete')
            					@csrf
            					<input type="submit" class="btn btn-danger cursor" value="Eliminar todos los personaje"/>
            				</form>
            			</div>
            		</div>
            	</div>
            </div>
          
        <div class="col-12 grid-margin">
        <div class="card">
                  <div class="card-body" style="padding-bottom:8px !important;padding-top:24px !important;">
            <div class="contenedorConMensajes">
                    <h2 style="margin-bottom:0!important;"class="card-title">Personajes</h2>
                    
                      @if (Session::has('message'))
                    <div class="alert alert-{{ session()->get('type') }}" style="margin-bottom:0!important;"  role="alert">
                  {{ session()->get('message') }}
                    </div>
                     @endif
                     
                </div>
            <div class="contenedorBotones" style="margin-bottom:22px!important; margin-top:26px!important;">
                         @if(count($especiesCount) >= 1)
                       <a  href="{{ url('personaje/create') }}" ><button type="button" class="btn btn-success btn-icon-text"> <i class="mdi mdi-file-check btn-icon-prepend"></i> Crear personaje </button></a>                
                         @else
                         <button type="button" class="btn btn-danger btn-icon-text">
                        <i class="mdi mdi-alert btn-icon-prepend"></i> No puede crear personajes, no hay especies </button>
                         @endif
                   @if(count($personajes) > 1)
                       <a  href="javascript: void(0);" data-url="{{ url('personaje/flush/all') }}" data-toggle="modal" data-target="#modalDelete1"> <button type="button" class="btn btn-danger btn-icon-text">
                        <i class="mdi mdi-alert btn-icon-prepend"></i> Eliminar todos los personajes </button></a>
                     @endif
                     
                   </div>
                    
                 
                  </div>
                
                </div>

            </div> 
          @foreach ($personajes as $personaje)    
       <div class="col-3 grid-margin">
        <div class="card">
                  <div class="card-body" style="text-align:center">
       
                    <h3 style="font-size:26px;">{{ $personaje->nombre }}</h3>
                  
                    
                  </div>
                  <div class="contenedorImagen">
                       @foreach ($personajesImagen as $personajeImagen)
                           @if($personajeImagen->idpersonaje == $personaje->id)
                           <img src="{{ asset('storage/'. $idusuario .'/imagenPersonajes/'. $personaje->id . '/' . $personajeImagen->nombreArchivo) }}"></img>
                            
                           @endif
                        @endforeach
                    </div>
                    
                      <div class="card-body" style="text-align:center">
                     <div class="info">
                        <span style="font-size:17px;">Especie:</span>
                          @foreach ($especies as $especie)
                               @if($especie->id == $personaje->idespecie)
                                <p><a style=" margin-left:10px; margin-right:10px; color:lightblue; text-decoration:none; font-size:17px;" href="{{ url('especie/'. $especie->id) }}"> {{ $especie->nombre}} </a> </p>
                                @endif
                         @endforeach
                    </div> 
                    <div class="info">
                        <span style="font-size:17px;">Epoca:</span>
                        <p style="font-size:17px;">{{ $personaje->epoca }}</p>
                    </div> 
                    <div class="negro"></div>
                  <div class="info">
                    <p style="font-size:17px;"><a style="color:lightblue; text-decoration:none" href="{{ url('personaje/'. $personaje->id) }}"> Mostrar </a> </p>
                    <p style="font-size:17px;"> <a style="color:lightblue; text-decoration:none"href="javascript: void(0);" data-name="{{ $personaje->nombre }}" data-url="{{ url('personaje/' . $personaje->id) }}" data-toggle="modal" data-target="#modalDelete">Eliminar </a></p> 
                  
                  </div>
                  </div>
                </div>
                 

            </div> 
        @endforeach
  
            
            
           
            
            
            
      
                  
    
    @endsection
   
     
    
    
   @section('js')
  
        <script src="{{ url('assets/jsNew/deleteElement.js') }}"></script>
        <script src="{{ url('assets/jsNew/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('assets/jsNew/deleteAll.js') }}"></script>

    @endsection
    