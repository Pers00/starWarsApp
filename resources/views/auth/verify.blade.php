@extends('admin.welcome')

@section('content')
<div class="alinear">
    <a class="sidebar-brand brand-logo" style="text-decoration:none; color:white; font-weight:500; margin-bottom:40px; margin-top:50px !important;" href="{{ url('/') }}">Star Wars App<img style=" padding-left:20px; width:90px; margin-right:0px;"src="{{ url('assets/images/estrella.png') }}" alt=""><img></a>
</div>
<div class="container" style="border:3px solid black">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="padding-bottom:30px;">
                <div class="card-header" style="font-size:34px; margin-top:34px; text-align:center;">Verificar tu correo electronico</div>
                

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Se ha enviado el link de verificacion a tu correo electronico
                        </div>
                    @endif
                    Se ha mandado correctamente el correo, compruebelo en {{ Auth::user()->email }}  <br>
                    Si no has recibido el email,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">pulse aqui para enviar otra peticion</button>.
                    </form>
                    
                </div>
            </div>
        
           <div style="margin-bottom:45px;"class="">
            <ul class="navbar-nav navbar-nav-right">
                
            <li class="nav-item dropdown">
               
                  <div class="navbar-profile" style="justify-content:center;display: flex;align-items: center; color:white;">
                 
                    <i style="padding-right:40px" class="mdi mdi-account-multiple"></i>
                    <p style=" color:white; margin-left:-30px; margin-right:30px;" class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::user()->name }}</p>
                    <p style=" color:white; margin-left:-30px; margin-right:30px;" class="mb-0 d-none d-sm-block navbar-profile-name"></p>
                   <div style="background-color:white; width:130px; height:1px; "></div>
                     <a style=" color:lightblue; margin-left:30px;" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="preview-subject mb-1">Cerrar sesion</a>
                  
                       
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </div>
                
      
              
                     
              </li>
            </ul>
            </div>
        
            
            
        </div>
    </div>
    
</div>

@endsection
