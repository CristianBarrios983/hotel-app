<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.includes.head')  <!-- Incluye el archivo head -->

    @livewireStyles <!-- Estilos de Livewire -->
</head>
<body data-bs-theme="dark">
    @include('layouts.includes.navbar')  <!-- Incluye el archivo navbar -->

    <div class="container">
        @yield('content')  <!-- El contenido dinámico de cada vista -->
    </div>

    @stack('modals')  <!-- Para modales de Livewire -->

    @include('layouts.includes.footer')  <!-- Incluye el archivo footer -->

    @livewireScripts  <!-- Scripts de Livewire -->
</body>
</html>
