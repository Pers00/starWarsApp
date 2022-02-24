@section('content')
<div class="alinear" >
    <a class="sidebar-brand brand-logo" style=" text-decoration:none; color:white; font-weight:500; margin-top:50px !important;" href="{{ url('/') }}">Star Wars App<img style=" padding-left:20px; width:90px; margin-right:0px;"src="{{ url('assets/images/estrella.png') }}" alt=""><img></a>
</div>
<div class="contenedor">
      <div class="botones">
          <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" style="text-decoration:none;">Inicio</a>
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
      
</div>
<img class="imagen"src="{{ url('assets/images/starwars.jpg') }}">sdddd</img>
@show