@section('sidebar')       
        
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
              <a class="sidebar-brand brand-logo" style="color:white; font-weight:500; text-decoration:none;" href="{{ url('/home') }}">Star Wars App<img style=" margin-left:6px; width:32px; margin-right:0px;"src="{{ url('assets/images/estrella.png') }}" alt=""></img></a>
              <a class="sidebar-brand brand-logo-mini" style="color:white; font-weight:500;" href="{{ url('/home') }}">SW</a>
            </div>
            <ul class="nav">
              <li class="nav-item profile">
                <div class="profile-desc">
                  <div class="profile-pic">
                    <div class="count-indicator">
                    <i style="margin-top:4px"class="mdi mdi-account-multiple"></i>
                   
                    </div>
                    <div class="profile-name">
                      <h5 class="mb-0 font-weight-normal">{{ Auth::user()->name }}</h5>
                      <span>{{ Auth::user()->rol }}</span>
                    </div>
                  </div>
                  <i class="mdi mdi-dots-vertical"></i>
                  
                
                  
               
                 
                
                   
             
                </div>
              </li>
              <li class="nav-item nav-category">
                <span class="nav-link">Navegación</span>
              </li>
              <li class="nav-item menu-items">
                <a class="nav-link" href="{{ url('/home') }}">
                  <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                  </span>
                  <span style="font-size:18px !important;"class="menu-title">Inicio</span>
                </a>
              </li>
              <li class="nav-item menu-items">
                <a class="nav-link" >
                  <span class="menu-icon">
                    <i class="mdi mdi-table-large"></i>
                  </span>
                  <span style="font-size:18px !important;" class="menu-title">Star Wars</span>
                  
                </a>
                <div id="ui-basic">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item" > <a style="font-size:15px !important; margin-left:4px;margin-top:4px;" class="nav-link" href="{{ url('personaje/') }}">Personajes</a></li>
                    <li class="nav-item" > <a style="font-size:15px !important;margin-left:4px; margin-top:4px;"class="nav-link" href="{{ url('especie/') }}">Especies</a></li>
                    <li class="nav-item"> <a style="font-size:15px !important;margin-left:4px; margin-top:4px;"class="nav-link" href="{{ url('planeta/') }}">Planetas</a></li>
                  </ul>
                </div>
              </li>
            
      
            </ul>
@show