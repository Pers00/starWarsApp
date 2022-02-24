@section('nav')
           
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.html"><img alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
          
            
            <ul class="navbar-nav navbar-nav-right">
               @if(auth()->user()->rol == 'Admin')
              <li class="nav-item dropdown d-none d-lg-block">
                    <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown"  href="{{ url('usuario') }}">Gestionar la comunidad</a>
              </li>
              @endif
              @if(auth()->user()->rol == 'Jedi')
               <li class="nav-item dropdown d-none d-lg-block">
                    <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown"   href="{{ url('usuario') }}">Explora la comunidad</a>
              </li>
              @endif
              @if(auth()->user()->rol == 'Padawan')
               <li class="nav-item dropdown d-none d-lg-block">
                    <p style="margin-top:18px;" class="nav-link btn btn-warning create-new-button">No puedes acceder a la comunidad</p>
              </li>
              @endif
              
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                 
                        <i style="margin-top:4px"class="mdi mdi-account-multiple"></i>
                    
                    <p style="margin-left:8px; " class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::user()->name }}</p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Perfil</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" href="{{ url('usuarioEdit') }}">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-success"></i>
                      </div>
                    </div>
                    
                    <div class="preview-item-content">
                   <p class="preview-subject mb-1"> Ajustes</p> 
                    </div>
                   </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p style="margin-left:-14px; font-size:13px;"class="dropdown-item" class="preview-subject mb-1">Cerrar sesion</p>
                    </div>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                    </a>
                 
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        
@show