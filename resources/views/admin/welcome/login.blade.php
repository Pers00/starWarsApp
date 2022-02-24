
<div class="alinear">
    <a class="sidebar-brand brand-logo" style="text-decoration:none; color:white; font-weight:500; margin-bottom:40px; margin-top:50px !important;" href="{{ url('/') }}">Star Wars App<img style=" padding-left:20px; width:90px; margin-right:0px;"src="{{ url('assets/images/estrella.png') }}" alt=""><img></a>
</div>
<div class="container" style="border:3px solid black">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size:34px; margin-top:34px; text-align:center;">Iniciar sesión</div>
  
                    @if(Session::has('register'))
                    <div class="alert alert-success" style="padding-top:20px padding-bottom:20px; margin:auto auto !important;"role="alert">
                     !Te has registrado correctamente! Para iniciar sesion debe verificar su correo
                    </div>
                      @endif
                      
                   
                <div class="card-body">
                  

                 
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" style="margin-left:75px"  class="col-md-4 col-form-label text-md-end">Correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" style="margin-left:-75px" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"style="margin-left:75px"   class="col-md-4 col-form-label text-md-end">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" style="margin-left:-75px" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Recuerdame
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Iniciar sesion
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Has olvidado la contraseña?
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

   <div class="contenedor1">
    
          <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}"  class="text-sm text-gray-700 dark:text-gray-500 underline" style="text-decoration:none;">Inicio</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" style="text-decoration:none;">Iniciar sesion</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline" style="text-decoration:none;">Registrarse</a>
                        @endif
                    @endauth
                </div>
           @endif
        </div>
  
      
</div>
